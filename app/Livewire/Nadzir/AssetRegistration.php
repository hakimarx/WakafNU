<?php

namespace App\Livewire\Nadzir;

use Livewire\Component;

class AssetRegistration extends Component
{
    public $name, $location, $area, $legality;
    public $isModalOpen = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'location' => 'required|string',
        'area' => 'required|numeric',
        'legality' => 'required|string',
    ];

    public function create()
    {
        $this->reset(['name', 'location', 'area', 'legality']);
        $this->isModalOpen = true;
    }

    public function store()
    {
        $this->validate();

        \App\Models\WaqfAsset::create([
            'name' => $this->name,
            'location' => $this->location,
            'area' => $this->area,
            'legality' => $this->legality,
            'status' => 'assigned',
            'nadzir_id' => auth()->id(),
        ]);

        $this->isModalOpen = false;
        session()->flash('message', 'Aset baru berhasil didaftarkan.');
    }

    public function delete($id)
    {
        \App\Models\WaqfAsset::where('nadzir_id', auth()->id())->findOrFail($id)->delete();
        session()->flash('message', 'Aset berhasil dihapus.');
    }

    public function render()
    {
        return view('livewire.nadzir.asset-registration', [
            'managedAssets' => \App\Models\WaqfAsset::where('nadzir_id', auth()->id())->latest()->get()
        ]);
    }
}
