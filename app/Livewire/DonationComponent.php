<?php

namespace App\Livewire;

use Livewire\Component;

class DonationComponent extends Component
{
    public $campaignId;
    public $amount;
    public $donorName;
    public $snapToken;

    public function mount($campaignId)
    {
        $this->campaignId = $campaignId;
    }

    public function donate()
    {
        $this->validate([
            'amount' => 'required|numeric|min:10000',
            'donorName' => 'required|string|max:255',
        ]);

        $campaign = \App\Models\Campaign::findOrFail($this->campaignId);
        $orderId = 'WKF-' . time() . '-' . rand(100, 999);

        $donation = \App\Models\Donation::create([
            'external_id' => $orderId,
            'campaign_id' => $this->campaignId,
            'user_id' => auth()->id(),
            'donor_name' => $this->donorName,
            'amount' => $this->amount,
            'status' => 'pending',
        ]);

        // Midtrans Config
        \Midtrans\Config::$serverKey = config('services.midtrans.server_key');
        \Midtrans\Config::$isProduction = config('services.midtrans.is_production');
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => (int) $this->amount,
            ],
            'customer_details' => [
                'first_name' => $this->donorName,
                'email' => auth()->user()->email ?? 'guest@example.com',
            ],
            'item_details' => [
                [
                    'id' => $campaign->id,
                    'price' => (int) $this->amount,
                    'quantity' => 1,
                    'name' => 'Wakaf: ' . $campaign->title,
                ]
            ],
        ];

        try {
            $this->snapToken = \Midtrans\Snap::getSnapToken($params);
            $donation->update(['snap_token' => $this->snapToken]);
            
            $this->dispatch('display-snap', token: $this->snapToken);
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal menghubungkan ke sistem pembayaran: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.donation-component');
    }
}
