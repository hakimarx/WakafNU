<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class WaqfAssetManager extends Component
{
    public $assetId;
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
        $this->resetForm();
        $this->isModalOpen = true;
    }

    public function edit($id)
    {
        $asset = \App\Models\WaqfAsset::findOrFail($id);

        $this->assetId = $asset->id;
        $this->name = $asset->name;
        $this->location = $asset->location;
        $this->area = $asset->area;
        $this->legality = $asset->legality;
        $this->isModalOpen = true;
    }

    public function save()
    {
        $this->validate();

        if ($this->assetId) {
            \App\Models\WaqfAsset::findOrFail($this->assetId)->update([
                'name' => $this->name,
                'location' => $this->location,
                'area' => $this->area,
                'legality' => $this->legality,
            ]);

            session()->flash('message', 'Asset updated successfully.');
        } else {
            \App\Models\WaqfAsset::create([
                'name' => $this->name,
                'location' => $this->location,
                'area' => $this->area,
                'legality' => $this->legality,
                'status' => 'available',
            ]);

            session()->flash('message', 'Asset created successfully.');
        }

        $this->resetForm();
        $this->isModalOpen = false;
    }

    public function delete($id)
    {
        \App\Models\WaqfAsset::findOrFail($id)->delete();
        session()->flash('message', 'Asset deleted successfully.');
    }

    public function closeModal()
    {
        $this->resetForm();
        $this->isModalOpen = false;
    }

    protected function resetForm()
    {
        $this->reset(['assetId', 'name', 'location', 'area', 'legality']);
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.admin.waqf-asset-manager', [
            'assets' => \App\Models\WaqfAsset::with('nadzir')->latest()->get()
        ]);
    }
}
