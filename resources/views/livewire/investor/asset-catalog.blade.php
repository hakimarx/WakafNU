<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    {{-- Header Section --}}
    <div class="mb-12 text-center">
        <h1 class="text-5xl font-black text-gray-900 tracking-tight mb-4">
            Katalog <span class="text-blue-600">Investasi Peradaban</span>
        </h1>
        <p class="text-xl text-gray-500 font-medium max-w-3xl mx-auto italic">
            "Wujudkan keberlanjutan bisnis sekaligus amal jariyah melalui pemanfaatan lahan produktif PWNU Jawa Timur."
        </p>
    </div>

    {{-- Filters --}}
    <div class="bg-white p-8 rounded-[2.5rem] shadow-xl border border-blue-50 mb-12 flex flex-wrap gap-6 items-end">
        <div class="flex-1 min-w-[250px]">
            <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3">Cari Peluang</label>
            <div class="relative">
                <input type="text" wire:model.live="search" placeholder="Cari lokasi atau jenis usaha..." 
                    class="w-full rounded-2xl border-gray-100 bg-gray-50 py-4 px-6 focus:ring-4 focus:ring-blue-100 focus:border-blue-400 transition shadow-inner">
                <svg class="w-6 h-6 text-gray-300 absolute right-4 top-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
        </div>

        <div class="w-full md:w-48">
            <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3">Kategori</label>
            <select wire:model.live="category" class="w-full rounded-2xl border-gray-100 bg-gray-50 py-4 px-6 focus:ring-4 focus:ring-blue-100 focus:border-blue-400 transition shadow-inner">
                <option value="">Semua</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat }}">{{ $cat }}</option>
                @endforeach
            </select>
        </div>

        <div class="w-full md:w-48">
            <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3">Kota/Kab</label>
            <select wire:model.live="city" class="w-full rounded-2xl border-gray-100 bg-gray-50 py-4 px-6 focus:ring-4 focus:ring-blue-100 focus:border-blue-400 transition shadow-inner">
                <option value="">Semua</option>
                @foreach($cities as $c)
                    <option value="{{ $c }}">{{ $c }}</option>
                @endforeach
            </select>
        </div>
    </div>

    {{-- Asset Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
        @forelse($assets as $asset)
            <div class="group bg-white rounded-[3rem] overflow-hidden border border-gray-100 shadow-lg hover:shadow-2xl transition duration-500 transform hover:-translate-y-2">
                {{-- Image/Thumbnail --}}
                <div class="relative h-64 bg-gray-200 overflow-hidden">
                    @if($asset->image_path)
                        <img src="{{ Storage::url($asset->image_path) }}" alt="{{ $asset->name }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-500 to-indigo-600">
                            <svg class="w-16 h-16 text-white/20" fill="currentColor" viewBox="0 0 24 24"><path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                    @endif
                    <div class="absolute top-6 left-6">
                        <span class="px-4 py-2 bg-white/90 backdrop-blur shadow-sm rounded-xl text-[10px] font-black uppercase tracking-widest text-blue-600">
                            {{ $asset->category ?? 'General' }}
                        </span>
                    </div>
                </div>

                {{-- Content --}}
                <div class="p-8">
                    <div class="flex items-center text-gray-400 text-[10px] font-bold uppercase tracking-widest mb-3">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        {{ $asset->city }}, {{ $asset->district }}
                    </div>
                    
                    <h3 class="text-2xl font-black text-gray-900 mb-3 leading-tight group-hover:text-blue-600 transition">
                        {{ $asset->name }}
                    </h3>

                    <p class="text-gray-500 text-sm mb-6 line-clamp-3 font-medium">
                        {{ $asset->description }}
                    </p>

                    {{-- Potential Uses Pills --}}
                    <div class="flex flex-wrap gap-2 mb-8">
                        @if($asset->potential_uses)
                            @foreach(array_slice($asset->potential_uses, 0, 3) as $use)
                                <span class="px-3 py-1 bg-green-50 text-green-700 text-[10px] font-black rounded-lg border border-green-100 uppercase italic">
                                    # {{ $use }}
                                </span>
                            @endforeach
                        @endif
                        <span class="px-3 py-1 bg-blue-50 text-blue-600 text-[10px] font-black rounded-lg border border-blue-100 uppercase italic">
                            {{ number_format($asset->area) }} m²
                        </span>
                    </div>

                    {{-- CTA --}}
                    <a href="{{ route('investor.submit', ['waqfAssetId' => $asset->id]) }}" 
                        class="block w-full text-center bg-gray-900 border-2 border-gray-900 text-white group-hover:bg-blue-600 group-hover:border-blue-600 font-black py-4 rounded-2xl transition duration-300 uppercase tracking-[0.2em] text-xs italic">
                        Ajukan Proposal
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full py-20 text-center">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 9.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-2xl font-black text-gray-900 mb-2">Belum Ada Peluang</h3>
                <p class="text-gray-400 font-medium">Aset yang Anda cari belum tersedia saat ini.</p>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="mt-12">
        {{ $assets->links() }}
    </div>
</div>
