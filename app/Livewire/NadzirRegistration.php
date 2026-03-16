<?php

namespace App\Livewire;

use Livewire\Component;

use Livewire\WithFileUploads;

class NadzirRegistration extends Component
{
    use WithFileUploads;

    public $ktp;
    public $certificate;

    protected $rules = [
        'ktp' => 'required|image|max:2048',
        'certificate' => 'required|file|mimes:pdf|max:5120',
    ];

    public function submit()
    {
        $this->validate();

        $ktpPath = $this->ktp->store('kyc/ktp', 'public');
        $certPath = $this->certificate->store('kyc/certificates', 'public');

        \App\Models\NadzirCertification::create([
            'user_id' => auth()->id(),
            'ktp_path' => $ktpPath,
            'certificate_path' => $certPath,
            'status' => 'pending',
        ]);

        session()->flash('success', 'Pendaftaran Nadzir berhasil dikirim. Menunggu verifikasi admin.');
    }

    public function render()
    {
        $hasApplied = \App\Models\NadzirCertification::where('user_id', auth()->id())->first();

        return view('livewire.nadzir-registration', compact('hasApplied'))->layout('layouts.app');
    }
}
