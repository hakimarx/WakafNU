<?php

namespace App\Livewire\Nadzir;

use Livewire\Component;

class AssetRegistration extends Component
{
    public function render()
    {
        return view('livewire.nadzir.asset-registration', [
            'managedAssets' => \App\Models\WaqfAsset::where('nadzir_id', auth()->id())->get()
        ]);
    }
}
