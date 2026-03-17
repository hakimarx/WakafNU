<?php

namespace App\Livewire\Investor;

use Livewire\Component;

use Livewire\WithFileUploads;

class InvestmentSubmission extends Component
{
    use WithFileUploads;

    public $proposalId;
    public $waqfAssetId;
    public $title;
    public $description;
    public $businessPlanFile;
    public $investmentValue;
    public $scheme = 'BOT'; // BOT, Bagi Hasil, Sewa
    public $profitSharingNadzir;
    public $profitSharingLWP;

    protected function rules()
    {
        return [
            'waqfAssetId' => 'required|exists:waqf_assets,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'businessPlanFile' => ($this->proposalId ? 'nullable' : 'required') . '|file|mimes:pdf,doc,docx,txt|max:10240',
            'investmentValue' => 'required|numeric|min:1000000',
            'profitSharingNadzir' => 'required_if:scheme,Bagi Hasil|nullable|numeric|min:0|max:100',
            'profitSharingLWP' => 'required_if:scheme,Bagi Hasil|nullable|numeric|min:0|max:100',
        ];
    }

    public function edit($id)
    {
        $proposal = \App\Models\InvestmentProposal::where('investor_id', auth()->id())
            ->where('status', 'pending')
            ->findOrFail($id);

        $this->proposalId = $proposal->id;
        $this->waqfAssetId = $proposal->waqf_asset_id;
        $this->title = $proposal->title;
        $this->description = $proposal->business_plan_description;
        $this->investmentValue = $proposal->investment_value;
        $this->scheme = $proposal->scheme;
        $this->profitSharingNadzir = $proposal->profit_sharing_nadzir;
        $this->profitSharingLWP = $proposal->profit_sharing_lwp;
        $this->businessPlanFile = null;
    }

    public function delete($id)
    {
        $proposal = \App\Models\InvestmentProposal::where('investor_id', auth()->id())
            ->where('status', 'pending')
            ->findOrFail($id);
            
        $proposal->delete();
        session()->flash('success', 'Proposal berhasil dihapus.');
    }

    public function submit()
    {
        $this->validate();

        $path = $this->businessPlanFile
            ? $this->businessPlanFile->store('business_plans', 'public')
            : null;

        if ($this->proposalId) {
            $proposal = \App\Models\InvestmentProposal::where('investor_id', auth()->id())
                ->where('status', 'pending')
                ->findOrFail($this->proposalId);

            $proposal->update([
                'waqf_asset_id' => $this->waqfAssetId,
                'title' => $this->title,
                'business_plan_description' => $this->description,
                'business_plan_file_path' => $path ?: $proposal->business_plan_file_path,
                'scheme' => $this->scheme,
                'investment_value' => $this->investmentValue,
            ]);

            session()->flash('success', 'Proposal investasi berhasil diperbarui.');
        } else {
            \App\Models\InvestmentProposal::create([
                'investor_id' => auth()->id(),
                'waqf_asset_id' => $this->waqfAssetId,
                'title' => $this->title,
                'business_plan_description' => $this->description,
                'business_plan_file_path' => $path,
                'scheme' => $this->scheme,
                'investment_value' => $this->investmentValue,
                'profit_sharing_nadzir' => $this->profitSharingNadzir,
                'profit_sharing_lwp' => $this->profitSharingLWP,
                'status' => 'pending',
            ]);

            session()->flash('success', 'Proposal investasi berhasil dikirim. Tim LWP akan meninjau dokumen Anda.');
        }

        $this->resetForm();
    }

    public function cancelEdit()
    {
        $this->resetForm();
    }

    protected function resetForm()
    {
        $this->reset(['proposalId', 'title', 'description', 'businessPlanFile', 'investmentValue', 'waqfAssetId']);
        $this->scheme = 'BOT';
        $this->resetValidation();
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
