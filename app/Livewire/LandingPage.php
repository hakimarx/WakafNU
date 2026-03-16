<?php

namespace App\Livewire;

use Livewire\Component;

class LandingPage extends Component
{
    public function render()
    {
        return view('livewire.landing-page', [
            'assets' => \App\Models\WaqfAsset::latest()->take(6)->get(),
            'campaigns' => \App\Models\Campaign::where('status', 'active')->latest()->take(3)->get(),
            'total_assets' => \App\Models\WaqfAsset::count(),
            'total_wakaf_uang' => \App\Models\Campaign::sum('current_amount'),
        ])->layout('layouts.guest');
    }
}
