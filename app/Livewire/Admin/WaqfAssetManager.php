<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class WaqfAssetManager extends Component
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
            'status' => 'available',
        ]);

        $this->isModalOpen = false;
        session()->flash('message', 'Asset created successfully.');
    }

    public function delete($id)
    {
        \App\Models\WaqfAsset::find($id)->delete();
        session()->flash('message', 'Asset deleted successfully.');
    }

    public function render()
    {
        return view('livewire.admin.waqf-asset-manager', [
            'assets' => \App\Models\WaqfAsset::with('nadzir')->latest()->get()
        ]);
    }
}
