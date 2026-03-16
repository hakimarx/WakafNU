<?php

namespace App\Livewire;

use Livewire\Component;

class DonationHistory extends Component
{
    public function render()
    {
        return view('livewire.donation-history', [
            'donations' => \App\Models\Donation::with('campaign')
                ->where('user_id', auth()->id())
                ->latest()
                ->get()
        ]);
    }
}
