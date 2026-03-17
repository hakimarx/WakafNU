<?php

namespace App\Livewire\Investor;

use App\Models\WaqfAsset;
use Livewire\Component;
use Livewire\WithPagination;

class AssetCatalog extends Component
{
    use WithPagination;

    public $search = '';
    public $category = '';
    public $city = '';

    protected $queryString = ['search', 'category', 'city'];

    public function updated($propertyName)
    {
        $this->resetPage();
    }

    public function render()
    {
        $assets = WaqfAsset::where('status', 'available')
            ->when($this->search, function($query) {
                $query->where(function($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('description', 'like', '%' . $this->search . '%')
                      ->orWhere('location', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->category, function($query) {
                $query->where('category', $this->category);
            })
            ->when($this->city, function($query) {
                $query->where('city', $this->city);
            })
            ->latest()
            ->paginate(6);

        $categories = WaqfAsset::select('category')->whereNotNull('category')->distinct()->pluck('category');
        $cities = WaqfAsset::select('city')->whereNotNull('city')->distinct()->pluck('city');

        return view('livewire.investor.asset-catalog', [
            'assets' => $assets,
            'categories' => $categories,
            'cities' => $cities
        ]);
    }
}
