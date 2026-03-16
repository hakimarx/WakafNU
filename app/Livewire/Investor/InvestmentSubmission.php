<?php

namespace App\Livewire\Investor;

use Livewire\Component;

use Livewire\WithFileUploads;

class InvestmentSubmission extends Component
{
    use WithFileUploads;

    public $waqfAssetId;
    public $title;
    public $description;
    public $businessPlanFile;
    public $investmentValue;
    public $scheme = 'BOT'; // Build Operate Transfer

    protected $rules = [
        'waqfAssetId' => 'required|exists:waqf_assets,id',
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'businessPlanFile' => 'required|file|mimes:pdf,doc,docx,txt|max:10240',
        'investmentValue' => 'required|numeric|min:1000000',
    ];

    public function delete($id)
    {
        $proposal = \App\Models\InvestmentProposal::where('investor_id', auth()->id())
            ->findOrFail($id);
            
        $proposal->delete();
        session()->flash('success', 'Proposal berhasil dihapus.');
    }

    public function submit()
    {
        $this->validate();

        $path = $this->businessPlanFile->store('business_plans', 'public');

        \App\Models\InvestmentProposal::create([
            'investor_id' => auth()->id(),
            'waqf_asset_id' => $this->waqfAssetId,
            'title' => $this->title,
            'business_plan_description' => $this->description,
            'business_plan_file_path' => $path,
            'scheme' => $this->scheme,
            'investment_value' => $this->investmentValue,
            'status' => 'pending',
        ]);

        session()->flash('success', 'Proposal investasi berhasil dikirim. Tim LWP akan meninjau dokumen Anda.');
        $this->reset(['title', 'description', 'businessPlanFile', 'investmentValue', 'waqfAssetId']);
    }

    public function render()
    {
        return view('livewire.investor.investment-submission', [
            'assets' => \App\Models\WaqfAsset::where('status', 'available')->get(),
            'myProposals' => \App\Models\InvestmentProposal::with('waqfAsset')
                ->where('investor_id', auth()->id())
                ->latest()
                ->get()
        ]);
    }
}
