<?php

namespace App\Livewire\Nadzir;

use Livewire\Component;

class AssetRegistration extends Component
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
        $asset = \App\Models\WaqfAsset::where('nadzir_id', auth()->id())->findOrFail($id);

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
            \App\Models\WaqfAsset::where('nadzir_id', auth()->id())
                ->findOrFail($this->assetId)
                ->update([
                    'name' => $this->name,
                    'location' => $this->location,
                    'area' => $this->area,
                    'legality' => $this->legality,
                ]);

            session()->flash('message', 'Data aset berhasil diperbarui.');
        } else {
            \App\Models\WaqfAsset::create([
                'name' => $this->name,
                'location' => $this->location,
                'area' => $this->area,
                'legality' => $this->legality,
                'status' => 'assigned',
                'nadzir_id' => auth()->id(),
            ]);

            session()->flash('message', 'Aset baru berhasil didaftarkan.');
        }

        $this->resetForm();
        $this->isModalOpen = false;
    }

    public function delete($id)
    {
        \App\Models\WaqfAsset::where('nadzir_id', auth()->id())->findOrFail($id)->delete();
        session()->flash('message', 'Aset berhasil dihapus.');
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
        return view('livewire.nadzir.asset-registration', [
            'managedAssets' => \App\Models\WaqfAsset::where('nadzir_id', auth()->id())->latest()->get()
        ]);
    }
}
