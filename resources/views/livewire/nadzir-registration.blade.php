<div class="py-12">
    <div class="max-w-3xl mx-auto px-6">
        <div class="bg-white rounded-[2rem] shadow-2xl overflow-hidden border border-emerald-50">
            <div class="bg-emerald-800 p-8 text-white">
                <h2 class="text-3xl font-black mb-2 tracking-tight">Pendaftaran Nadzir</h2>
                <p class="text-emerald-100 italic">Jadilah bagian dari pengelola aset umat yang amanah.</p>
            </div>

            @if($hasApplied)
                <div class="p-12 text-center">
                    <div class="w-24 h-24 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Permohonan Terkirim</h3>
                    <p class="text-gray-500">Status saat ini: <span class="font-black uppercase text-emerald-600">{{ $hasApplied->status }}</span></p>
                    <p class="mt-4 text-sm text-gray-400">Tim Admin LWP PWNU Jatim akan meninjau dokumen Anda dalam 1-3 hari kerja.</p>
                </div>
            @else
                <form wire:submit.prevent="submit" class="p-10 space-y-8">
                    @if (session()->has('success'))
                        <div class="p-4 bg-emerald-100 text-emerald-800 rounded-xl font-bold italic">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-black text-emerald-900 mb-3 uppercase tracking-widest">Foto KTP (.jpg/.png)</label>
                            <div class="relative group">
                                <input type="file" wire:model="ktp" class="w-full opacity-0 absolute inset-0 z-10 cursor-pointer">
                                <div class="w-full rounded-2xl border-2 border-dashed border-emerald-200 bg-emerald-50/50 py-6 px-6 flex items-center justify-center text-emerald-700 font-bold group-hover:bg-emerald-100 transition">
                                    @if($ktp)
                                        <span class="text-emerald-600">KTP Terupload</span>
                                    @else
                                        <span>Pilih File KTP</span>
                                    @endif
                                </div>
                            </div>
                            @error('ktp') <span class="text-xs text-red-500 font-bold mt-2 inline-block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-black text-emerald-900 mb-3 uppercase tracking-widest">Sertifikat Nadzir BWI (.pdf)</label>
                            <div class="relative group">
                                <input type="file" wire:model="certificate" class="w-full opacity-0 absolute inset-0 z-10 cursor-pointer">
                                <div class="w-full rounded-2xl border-2 border-dashed border-emerald-200 bg-emerald-50/50 py-6 px-6 flex items-center justify-center text-emerald-700 font-bold group-hover:bg-emerald-100 transition">
                                    @if($certificate)
                                        <span class="text-emerald-600">Dokumen PDF Terupload</span>
                                    @else
                                        <span>Pilih Sertifikat BWI</span>
                                    @endif
                                </div>
                            </div>
                            @error('certificate') <span class="text-xs text-red-500 font-bold mt-2 inline-block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="pt-6">
                        <button type="submit" wire:loading.attr="disabled" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-black py-4 rounded-2xl shadow-xl transition transform active:scale-95 disabled:opacity-50">
                            Ajukan Verifikasi
                        </button>
                    </div>
                </form>
            @endif
        </div>
    </div>
</div>
