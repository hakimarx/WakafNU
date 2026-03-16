<?php

namespace App\Livewire;

use Livewire\Component;

class CampaignDetail extends Component
{
    public $campaign;

    public function mount($id)
    {
        $this->campaign = \App\Models\Campaign::with('waqfAsset')->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.campaign-detail')->layout('layouts.guest');
    }
}
