<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function callback(Request $request)
    {
        // Handle Pakasir Callback
        $orderId = $request->input('order_id');
        $status = $request->input('status'); // 'success' or 'completed'
        
        // Log callback for debugging
        \Log::info('Pakasir Callback:', $request->all());

        $donation = \App\Models\Donation::where('external_id', $orderId)->first();

        if (!$donation) {
            return response()->json(['message' => 'Donation not found'], 404);
        }

        // Jika status success atau sudah dibayar
        if (in_array($status, ['success', 'completed']) || $request->has('paid_at')) {
            if ($donation->status !== 'success') {
                $donation->update(['status' => 'success']);
                
                // Update Campaign current_amount
                $campaign = $donation->campaign;
                if ($campaign) {
                    $campaign->increment('current_amount', $donation->amount);
                }
            }
        } elseif (in_array($status, ['failed', 'expired', 'canceled'])) {
            $donation->update(['status' => 'failed']);
        }

        return response()->json(['message' => 'Notification processed']);
    }
}
