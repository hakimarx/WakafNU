<div class="max-w-4xl mx-auto p-10 bg-white rounded-[3rem] shadow-2xl border border-blue-50">
    <div class="flex items-center space-x-6 mb-12">
        <div class="w-16 h-16 bg-blue-600 rounded-3xl flex items-center justify-center shadow-lg shadow-blue-200">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
        </div>
        <div>
            <h2 class="text-3xl font-black text-gray-900 tracking-tight">Portal Investasi BOT</h2>
            <p class="text-blue-600 font-bold uppercase tracking-widest text-xs mt-1">Submit Rencana Bisnis & Kerjasama</p>
        </div>
    </div>

    @if (session()->has('success'))
        <div class="mb-8 p-6 bg-blue-50 border-l-8 border-blue-500 rounded-2xl text-blue-800 font-medium">
            {{ session('success') }}
        </div>
    @endif

    @if($proposalId)
        <div class="mb-8 p-6 bg-amber-50 border-l-8 border-amber-500 rounded-2xl text-amber-900 font-medium flex items-center justify-between gap-4">
            <span>Mode edit aktif. Anda sedang memperbarui proposal yang masih berstatus pending.</span>
            <button type="button" wire:click="cancelEdit" class="shrink-0 text-sm font-black uppercase tracking-wider text-amber-700 hover:text-black">Batal Edit</button>
        </div>
    @endif

    <form wire:submit.prevent="submit" class="space-y-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <label class="block text-sm font-black text-gray-700 mb-3 uppercase tracking-wider">Pilih Aset Wakaf</label>
                <select wire:model="waqfAssetId" class="w-full rounded-2xl border-gray-100 bg-gray-50 py-4 px-6 focus:ring-4 focus:ring-blue-100 focus:border-blue-400 transition shadow-inner">
                    <option value="">{{ $assets->isEmpty() ? '-- Belum Ada Aset Wakaf Tersedia --' : '-- Pilih Lokasi Aset --' }}</option>
                    @foreach($assets as $asset)
                        <option value="{{ $asset->id }}">{{ $asset->name }} ({{ $asset->location }})</option>
                    @endforeach
                </select>
                @error('waqfAssetId') <span class="text-xs text-red-500 font-bold mt-2 inline-block">{{ $message }}</span> @enderror
                @if($assets->isEmpty())
                    <p class="text-xs text-amber-700 font-semibold mt-2">
                        Belum ada aset berstatus tersedia. Minta admin atau nadzir menambahkan aset wakaf terlebih dulu, atau tunggu sinkronisasi database production selesai.
                    </p>
                @endif
            </div>

            <div>
                <label class="block text-sm font-black text-gray-700 mb-3 uppercase tracking-wider">Judul Proposal Investasi</label>
                <input type="text" wire:model="title" placeholder="cth: Pembangunan Hotel Syariah ABC" class="w-full rounded-2xl border-gray-100 bg-gray-50 py-4 px-6 focus:ring-4 focus:ring-blue-100 focus:border-blue-400 transition shadow-inner">
                @error('title') <span class="text-xs text-red-500 font-bold mt-2 inline-block">{{ $message }}</span> @enderror
            </div>
        </div>

        <div>
            <label class="block text-sm font-black text-gray-700 mb-3 uppercase tracking-wider">Ringkasan Business Plan</label>
            <textarea wire:model="description" rows="5" placeholder="Jelaskan secara singkat skema kerjasama dan manfaat bagi umat..." class="w-full rounded-2xl border-gray-100 bg-gray-50 py-4 px-6 focus:ring-4 focus:ring-blue-100 focus:border-blue-400 transition shadow-inner"></textarea>
            @error('description') <span class="text-xs text-red-500 font-bold mt-2 inline-block">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <label class="block text-sm font-black text-gray-700 mb-3 uppercase tracking-wider">Nilai Investasi (Rp)</label>
                <input type="number" wire:model="investmentValue" class="w-full rounded-2xl border-gray-100 bg-gray-50 py-4 px-6 focus:ring-4 focus:ring-blue-100 focus:border-blue-400 transition shadow-inner" placeholder="0">
                @error('investmentValue') <span class="text-xs text-red-500 font-bold mt-2 inline-block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-black text-gray-700 mb-3 uppercase tracking-wider">Skema Kerjasama</label>
                <select wire:model="scheme" class="w-full rounded-2xl border-gray-100 bg-gray-50 py-4 px-6 focus:ring-4 focus:ring-blue-100 focus:border-blue-400 transition shadow-inner">
                    <option value="BOT">BOT</option>
                    <option value="Mudharabah">Mudharabah</option>
                    <option value="Musyarakah">Musyarakah</option>
                    <option value="Sewa">Sewa</option>
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-black text-gray-700 mb-3 uppercase tracking-wider">Upload Dokumen (PDF/DOC)</label>
                <div class="relative group">
                    <input type="file" wire:model="businessPlanFile" class="w-full opacity-0 absolute inset-0 z-10 cursor-pointer">
                    <div class="w-full rounded-2xl border-2 border-dashed border-blue-200 bg-blue-50/50 py-4 px-6 flex items-center justify-center text-blue-600 font-bold group-hover:bg-blue-100 transition">
                        @if($businessPlanFile)
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path></svg>
                            File Terpilih
                        @else
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                            Klik untuk Upload
                        @endif
                    </div>
                </div>
                @error('businessPlanFile') <span class="text-xs text-red-500 font-bold mt-2 inline-block">{{ $message }}</span> @enderror
                @if($proposalId)
                    <p class="text-xs text-gray-400 font-medium mt-2">Kosongkan file jika dokumen lama tetap dipakai.</p>
                @endif
            </div>
        </div>

        <div class="pt-6 border-t border-gray-100">
            <button type="submit" wire:loading.attr="disabled" class="w-full bg-blue-600 hover:bg-black text-white font-black py-5 rounded-2xl shadow-xl shadow-blue-100 transition transform hover:-translate-y-1 active:scale-95 disabled:opacity-50 flex items-center justify-center space-x-3 italic uppercase tracking-[0.2em]">
                <span wire:loading.remove>{{ $proposalId ? 'Perbarui Proposal Investasi' : 'Submit Proposal Investasi' }}</span>
                <span wire:loading>Processing Proposal...</span>
            </button>
        </div>
    </form>

    <div class="mt-20">
        <h3 class="text-2xl font-black text-gray-900 mb-8 flex items-center">
            <span class="w-8 h-8 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center mr-3 text-sm">#</span>
            Riwayat Proposal Anda
        </h3>

        <div class="overflow-hidden rounded-3xl border border-gray-100 shadow-sm transition hover:shadow-md">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-blue-50/50">
                    <tr>
                        <th class="px-8 py-4 text-left text-xs font-black text-blue-900 uppercase tracking-widest">Judul & Aset</th>
                        <th class="px-8 py-4 text-left text-xs font-black text-blue-900 uppercase tracking-widest">Nilai Investasi</th>
                        <th class="px-8 py-4 text-left text-xs font-black text-blue-900 uppercase tracking-widest">Status</th>
                        <th class="px-8 py-4 text-center text-xs font-black text-blue-900 uppercase tracking-widest">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse($myProposals as $prop)
                        <tr class="hover:bg-blue-50/20 transition">
                            <td class="px-8 py-6">
                                <div class="text-sm font-bold text-gray-900">{{ $prop->title }}</div>
                                <div class="text-xs text-blue-600 font-medium">{{ $prop->waqfAsset->name }}</div>
                            </td>
                            <td class="px-8 py-6 whitespace-nowrap">
                                <span class="text-sm font-black text-gray-700">Rp {{ number_format($prop->investment_value) }}</span>
                                <span class="text-[10px] block text-gray-400 font-bold">Skema: {{ $prop->scheme }}</span>
                            </td>
                            <td class="px-8 py-6 whitespace-nowrap">
                                <span class="px-3 py-1 inline-flex text-[10px] leading-5 font-black rounded-full 
                                    {{ $prop->status === 'pending' ? 'bg-amber-100 text-amber-800' : '' }}
                                    {{ $prop->status === 'approved' ? 'bg-emerald-100 text-emerald-800' : '' }}
                                    {{ $prop->status === 'rejected' ? 'bg-red-100 text-red-800' : '' }}">
                                    {{ strtoupper($prop->status) }}
                                </span>
                            </td>
                            <td class="px-8 py-6 whitespace-nowrap text-center text-sm font-medium">
                                @if($prop->status === 'pending')
                                    <button wire:click="edit({{ $prop->id }})" class="text-blue-600 hover:text-blue-900 font-black italic uppercase tracking-tighter mr-4">Edit</button>
                                @endif
                                <button wire:click="delete({{ $prop->id }})" class="text-red-600 hover:text-red-900 font-black italic uppercase tracking-tighter">Hapus</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-8 py-12 text-center text-gray-400 italic font-medium">
                                Belum ada proposal yang diajukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
