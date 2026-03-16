<div class="space-y-6">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($managedAssets as $asset)
            <div class="bg-white rounded-3xl shadow-lg border border-emerald-50 overflow-hidden group hover:shadow-2xl transition duration-500">
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
                <p class="text-xs text-gray-400 mt-2">Hubungi Admin LWP untuk penugasan pengelolaan aset.</p>
            </div>
        @endforelse
    </div>
</div>
