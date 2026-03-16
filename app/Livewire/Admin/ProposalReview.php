<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class ProposalReview extends Component
{
    public function approve($id)
    {
        $proposal = \App\Models\InvestmentProposal::findOrFail($id);
        $proposal->update(['status' => 'approved']);
        
        // Also update the asset status to 'assigned' to prevent other submissions if desired
        // $proposal->waqfAsset->update(['status' => 'assigned']);
        
        session()->flash('proposal_message', 'Proposal disetujui.');
    }

    public function reject($id)
    {
        $proposal = \App\Models\InvestmentProposal::findOrFail($id);
        $proposal->update(['status' => 'rejected']);
        
        session()->flash('proposal_message', 'Proposal ditolak.');
    }

    public function render()
    {
        return view('livewire.admin.proposal-review', [
            'pendingProposals' => \App\Models\InvestmentProposal::with(['investor', 'waqfAsset'])
                ->where('status', 'pending')
                ->latest()
                ->get()
        ]);
    }
}
