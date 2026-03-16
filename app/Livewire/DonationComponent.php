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

        // Pakasir Redirection
        $slug = config('services.pakasir.project_slug');
        $email = auth()->user()->email ?? 'guest@example.com';
        
        $paymentUrl = "https://app.pakasir.com/p/{$slug}?" . http_build_query([
            'order_id' => $orderId,
            'amount' => (int) $this->amount,
            'customer_name' => $this->donorName,
            'customer_email' => $email,
            'redirect_url' => route('donation.history'), // URL setelah bayar
        ]);

        try {
            $donation->update(['snap_token' => $paymentUrl]); // Menyimpan URL ke kolom yang sama agar tidak mengubah migrasi
            
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
