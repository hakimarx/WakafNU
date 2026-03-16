<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function callback(Request $request)
    {
        $orderId = $request->input('order_id');
        $status = $request->input('status');
        $transactionStatus = $request->input('transaction_status');
        $normalizedStatus = $status ?: $transactionStatus;
        
        Log::info('Payment callback received', $request->all());

        $donation = \App\Models\Donation::where('external_id', $orderId)->first();

        if (!$donation) {
            return response()->json(['message' => 'Donation not found'], 404);
        }

        $expectedAmount = (int) round($donation->amount);
        $reportedAmount = $request->input('amount');

        if ($reportedAmount !== null && (int) $reportedAmount !== $expectedAmount) {
            Log::warning('Payment callback amount mismatch', [
                'order_id' => $orderId,
                'expected' => $expectedAmount,
                'reported' => $reportedAmount,
            ]);

            return response()->json(['message' => 'Amount mismatch'], 422);
        }

        if (config('services.pakasir.api_key') && config('services.pakasir.project_slug')) {
            $verification = Http::timeout(10)
                ->acceptJson()
                ->get('https://app.pakasir.com/api/transactiondetail', [
                    'project' => config('services.pakasir.project_slug'),
                    'api_key' => config('services.pakasir.api_key'),
                    'amount' => $expectedAmount,
                    'order_id' => $orderId,
                ]);

            if ($verification->successful() && $verification->json('transaction')) {
                $normalizedStatus = $verification->json('transaction.status', $normalizedStatus);
                $verifiedAmount = (int) $verification->json('transaction.amount', $expectedAmount);

                if ($verifiedAmount !== $expectedAmount) {
                    Log::warning('Verified payment amount mismatch', [
                        'order_id' => $orderId,
                        'expected' => $expectedAmount,
                        'verified' => $verifiedAmount,
                    ]);

                    return response()->json(['message' => 'Verified amount mismatch'], 422);
                }
            } else {
                Log::warning('Unable to verify payment with Pakasir', [
                    'order_id' => $orderId,
                    'response' => $verification->json(),
                ]);
            }
        }

        if (in_array($normalizedStatus, ['success', 'completed', 'settlement', 'capture']) || $request->has('paid_at') || $request->has('completed_at')) {
            if ($donation->status !== 'success') {
                $donation->update(['status' => 'success']);
                
                $campaign = $donation->campaign;
                if ($campaign) {
                    $campaign->increment('current_amount', $donation->amount);
                }
            }
        } elseif (in_array($normalizedStatus, ['failed', 'expired', 'canceled', 'cancel', 'deny'])) {
            $donation->update(['status' => 'failed']);
        }

        return response()->json(['message' => 'Notification processed']);
    }
}
