<?php

namespace App\Livewire;

use Illuminate\Support\Str;
use Livewire\Component;

class DonationComponent extends Component
{
    public $campaignId;
    public $amount;
    public $donorName;
    public $snapToken;
    public array $quickAmounts = [50000, 100000, 250000, 500000];

    public function mount($campaignId)
    {
        $this->campaignId = $campaignId;
    }

    public function fillAmount($amount)
    {
        $this->amount = $amount;
    }

    public function donate()
    {
        $this->validate([
            'amount' => 'required|numeric|min:10000',
            'donorName' => 'required|string|max:255',
        ]);

        \App\Models\Campaign::findOrFail($this->campaignId);
        $orderId = 'WKF-' . now()->format('YmdHis') . '-' . Str::upper(Str::random(6));

        $donation = \App\Models\Donation::create([
            'external_id' => $orderId,
            'campaign_id' => $this->campaignId,
            'user_id' => auth()->id(),
            'donor_name' => $this->donorName,
            'amount' => $this->amount,
            'status' => 'pending',
        ]);

        $slug = config('services.pakasir.project_slug');
        $paymentUrl = "https://app.pakasir.com/pay/{$slug}/" . (int) $this->amount . '?' . http_build_query([
            'order_id' => $orderId,
            'redirect' => route('donation.status', ['externalId' => $orderId]),
            'qris_only' => config('services.pakasir.qris_only') ? 1 : 0,
        ]);

        try {
            $donation->update(['snap_token' => $paymentUrl]);
            
            $this->dispatch('redirect-to-payment', url: $paymentUrl);
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal menghubungkan ke sistem pembayaran: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.donation-component');
    }
}
