<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function callback(Request $request)
    {
        \Midtrans\Config::$serverKey = config('services.midtrans.server_key');
        \Midtrans\Config::$isProduction = config('services.midtrans.is_production');

        $notification = new \Midtrans\Notification();

        $donation = \App\Models\Donation::where('external_id', $notification->order_id)->first();

        if (!$donation) {
            return response()->json(['message' => 'Donation not found'], 404);
        }

        $transactionStatus = $notification->transaction_status;
        $type = $notification->payment_type;
        $orderId = $notification->order_id;
        $fraud = $notification->fraud_status;

        if ($transactionStatus == 'capture') {
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    $donation->update(['status' => 'pending']);
                } else {
                    $donation->update(['status' => 'success']);
                }
            }
        } elseif ($transactionStatus == 'settlement') {
            $donation->update(['status' => 'success']);
            
            // Update Campaign current_amount
            $campaign = $donation->campaign;
            $campaign->increment('current_amount', $donation->amount);
            
        } elseif ($transactionStatus == 'pending') {
            $donation->update(['status' => 'pending']);
        } elseif ($transactionStatus == 'deny' || $transactionStatus == 'expire' || $transactionStatus == 'cancel') {
            $donation->update(['status' => 'failed']);
        }

        return response()->json(['message' => 'Notification processed']);
    }
}
