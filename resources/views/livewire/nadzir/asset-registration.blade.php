<div class="space-y-6">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-xl font-bold text-emerald-800">Aset yang Anda Kelola</h3>
        <button wire:click="create" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-6 rounded-xl shadow-lg transition">
            + Daftar Aset Baru
        </button>
    </div>

    @if (session()->has('message'))
        <div class="p-4 bg-emerald-100 border-l-4 border-emerald-500 text-emerald-700 rounded-r-xl">
            {{ session('message') }}
        </div>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($managedAssets as $asset)
            <div class="bg-white rounded-3xl shadow-lg border border-emerald-50 overflow-hidden group hover:shadow-2xl transition duration-500 relative">
                <button wire:click="delete({{ $asset->id }})" class="absolute top-4 right-4 z-20 bg-red-500/10 hover:bg-red-500 text-red-500 hover:text-white p-2 rounded-full transition opacity-0 group-hover:opacity-100">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                </button>
                <div class="h-40 bg-emerald-800 flex items-center justify-center p-8 relative">
                    <svg class="h-16 w-16 text-emerald-100/20 absolute -right-4 -bottom-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H7a1 1 0 00-1 1v2a1 1 0 01-1 1H2a1 1 0 110-2V4zm2 2v10h2v-2a3 3 0 013-3h2a3 3 0 013 3v2h2V4H6v2z" clip-rule="evenodd"></path></svg>
                    <div class="text-center relative z-10">
                        <h4 class="text-white font-bold text-lg leading-tight uppercase tracking-widest">{{ $asset->name }}</h4>
                        <p class="text-emerald-300 text-xs font-medium">{{ $asset->location }}</p>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-[10px] font-black uppercase text-gray-400 tracking-widest">Legalitas</span>
                        <span class="text-xs font-bold text-emerald-700 bg-emerald-50 px-3 py-1 rounded-full">{{ $asset->legality }}</span>
                    </div>
                    <div class="flex justify-between items-center bg-gray-50 p-4 rounded-2xl">
                        <div>
                            <p class="text-[10px] uppercase font-black text-gray-400 tracking-widest">Luas</p>
                            <p class="text-lg font-black text-emerald-900">{{ number_format($asset->area) }} m²</p>
                        </div>
                        <div class="text-right">
                            <p class="text-[10px] uppercase font-black text-gray-400 tracking-widest">Status</p>
                            <p class="text-xs font-bold text-amber-600 italic uppercase">{{ $asset->status }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-20 text-center bg-gray-50 rounded-[3rem] border-2 border-dashed border-gray-200">
                <svg class="h-16 w-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                <p class="text-gray-400 font-bold italic">Belum ada aset yang ditugaskan kepada Anda.</p>
                <p class="text-xs text-gray-400 mt-2">Daftarkan aset baru menggunakan tombol di atas.</p>
            </div>
        @endforelse
    </div>

    <!-- Modal for Nadzir -->
    @if($isModalOpen)
    <div class="fixed inset-0 z-50 overflow-y-auto" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center">
            <div class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity" wire:click="$set('isModalOpen', false)"></div>
            <div class="inline-block align-middle bg-white rounded-3xl text-left overflow-hidden shadow-2xl transform transition-all sm:max-w-lg sm:w-full">
                <div class="bg-emerald-800 px-6 py-4">
                    <h3 class="text-lg font-bold text-white uppercase tracking-widest italic">Daftarkan Aset Kelolaan</h3>
                </div>
                <div class="p-8 space-y-4">
                    <div>
                        <label class="block text-gray-700 text-xs font-black uppercase mb-2">Nama Aset</label>
                        <input type="text" wire:model="name" class="w-full rounded-2xl border-gray-200 py-3 px-4 focus:ring-emerald-500 focus:border-emerald-500">
                        @error('name') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-gray-700 text-xs font-black uppercase mb-2">Lokasi</label>
                        <textarea wire:model="location" class="w-full rounded-2xl border-gray-200 py-3 px-4" rows="3"></textarea>
                        @error('location') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 text-xs font-black uppercase mb-2">Luas (m²)</label>
                            <input type="number" wire:model="area" class="w-full rounded-2xl border-gray-200 py-3 px-4">
                            @error('area') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-gray-700 text-xs font-black uppercase mb-2">Legalitas</label>
                            <input type="text" wire:model="legality" class="w-full rounded-2xl border-gray-200 py-3 px-4">
                            @error('legality') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-8 py-4 flex justify-end space-x-3 rounded-b-3xl">
                    <button wire:click="$set('isModalOpen', false)" class="text-gray-500 font-bold px-6 py-2 transition hover:text-gray-800">Batal</button>
                    <button wire:click="store" class="bg-emerald-600 hover:bg-emerald-700 text-white font-black px-8 py-3 rounded-xl shadow-lg transition transform hover:scale-105">Simpan Data</button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
