<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class NadzirVerification extends Component
{
    public function approve($id)
    {
        $cert = \App\Models\NadzirCertification::findOrFail($id);
        $cert->update(['status' => 'approved']);
        
        // Also ensure user role is set to nadzir (though it should be already if they applied)
        $cert->user->update(['role' => 'nadzir']);
        
        session()->flash('message', 'Nadzir verified successfully.');
    }

    public function reject($id)
    {
        $cert = \App\Models\NadzirCertification::findOrFail($id);
        $cert->update(['status' => 'rejected']);
        
        session()->flash('message', 'Nadzir application rejected.');
    }

    public function render()
    {
        return view('livewire.admin.nadzir-verification', [
            'pendingCertifications' => \App\Models\NadzirCertification::with('user')
                ->where('status', 'pending')
                ->latest()
                ->get()
        ]);
    }
}
