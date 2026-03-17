<div class="min-h-screen bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-emerald-800 text-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center shadow-inner">
                        <span class="text-emerald-800 font-bold text-xl">LWP</span>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold tracking-tight">WAKAF PWNU JATIM</h1>
                        <p class="text-xs text-emerald-200">Lembaga Wakaf & Pertanahan</p>
                    </div>
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-6">
                        <a href="#hero" class="hover:text-amber-400 px-3 py-2 rounded-md text-sm font-medium transition duration-300">Beranda</a>
                        <a href="#katalog" class="hover:text-amber-400 px-3 py-2 rounded-md text-sm font-medium transition duration-300">Katalog Aset</a>
                        <a href="#program" class="hover:text-amber-400 px-3 py-2 rounded-md text-sm font-medium transition duration-300">Program Wakaf</a>
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="bg-amber-500 hover:bg-amber-600 text-emerald-900 px-5 py-2.5 rounded-full text-sm font-bold shadow-lg transition duration-300">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="hover:text-amber-400 px-3 py-2 text-sm font-medium">Masuk</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="bg-amber-500 hover:bg-amber-600 text-emerald-900 px-5 py-2.5 rounded-full text-sm font-bold shadow-lg transition duration-300">Daftar</a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header id="hero" class="relative bg-emerald-900 overflow-hidden">
        <div class="absolute inset-0 opacity-20">
            <div class="absolute inset-0" style="background-image: url('https://www.transparenttextures.com/patterns/islamic-art.png');"></div>
        </div>
        <div class="max-w-7xl mx-auto py-24 px-4 sm:px-6 lg:px-8 relative z-10 flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 text-left space-y-8 animate-fade-in">
                <h2 class="text-4xl md:text-6xl font-extrabold text-white leading-tight">
                    Abadikan Kebaikan dengan <span class="text-amber-400 italic">Wakaf Produktif</span>
                </h2>
                <p class="text-xl text-emerald-100 max-w-lg">
                    Kelola dan kembangkan aset umat untuk kemaslahatan bersama. Transparan, Profesional, dan Syar'i bersama LWP PWNU Jatim.
                </p>
                <div class="flex space-x-4">
                    <a href="#katalog" class="bg-emerald-600 hover:bg-emerald-500 text-white px-8 py-4 rounded-xl font-bold text-lg shadow-2xl transition transform hover:-translate-y-1">Mulai Berwakaf</a>
                    <a href="#" class="bg-white/10 backdrop-blur-md border border-white/20 hover:bg-white/20 text-white px-8 py-4 rounded-xl font-bold text-lg transition">Pelajari BOT</a>
                </div>
            </div>
            <div class="md:w-1/2 mt-12 md:mt-0 flex justify-center">
                <div class="relative group">
                    <div class="absolute -inset-1 bg-gradient-to-r from-amber-400 to-emerald-500 rounded-2xl blur opacity-25 group-hover:opacity-100 transition duration-1000 group-hover:duration-200"></div>
                    <img src="https://images.unsplash.com/photo-1596464716127-f2a82984de30?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Mosque" class="relative rounded-2xl shadow-2xl w-full max-w-md object-cover h-[400px]">
                </div>
            </div>
        </div>
    </header>

    <!-- Stats Section -->
    <section class="max-w-7xl mx-auto -mt-16 px-4 sm:px-6 lg:px-8 relative z-20">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="bg-white p-8 rounded-2xl shadow-xl flex flex-col items-center text-center border-b-4 border-emerald-600 transition hover:scale-105">
                <span class="text-4xl mb-2 text-emerald-700 font-black">{{ $total_assets }}</span>
                <span class="text-gray-500 font-medium uppercase tracking-widest text-xs">Total Aset Tanah</span>
            </div>
            <div class="bg-white p-8 rounded-2xl shadow-xl flex flex-col items-center text-center border-b-4 border-amber-500 transition hover:scale-105">
                <span class="text-4xl mb-2 text-amber-600 font-black">Rp {{ number_format($total_wakaf_uang, 0, ',', '.') }}</span>
                <span class="text-gray-500 font-medium uppercase tracking-widest text-xs">Wakaf Uang Terkumpul</span>
            </div>
            <div class="bg-white p-8 rounded-2xl shadow-xl flex flex-col items-center text-center border-b-4 border-emerald-600 transition hover:scale-105">
                <span class="text-4xl mb-2 text-emerald-700 font-black">120+</span>
                <span class="text-gray-500 font-medium uppercase tracking-widest text-xs">Nadzir Terverifikasi</span>
            </div>
            <div class="bg-white p-8 rounded-2xl shadow-xl flex flex-col items-center text-center border-b-4 border-amber-500 transition hover:scale-105">
                <span class="text-4xl mb-2 text-amber-600 font-black">3000+</span>
                <span class="text-gray-500 font-medium uppercase tracking-widest text-xs">Wakif Aktif</span>
            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-[2rem] border border-emerald-100 shadow-xl p-8 md:p-10">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-8">
                <div>
                    <h3 class="text-emerald-800 text-sm font-bold uppercase tracking-widest mb-2">Alur Wakaf Uang</h3>
                    <h2 class="text-3xl font-extrabold text-gray-900">Dibuat sederhana untuk masyarakat umum</h2>
                    <p class="text-gray-500 mt-3 max-w-2xl">Mengikuti pola kampanye publik seperti platform wakaf uang modern: pilih program, isi nominal, bayar via QRIS, dan pantau status wakaf Anda.</p>
                </div>
                <a href="#program" class="inline-flex items-center justify-center bg-emerald-800 hover:bg-emerald-900 text-white font-bold px-6 py-3 rounded-xl shadow-lg transition">
                    Lihat Program Wakaf
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-10">
                <div class="rounded-2xl bg-emerald-50 p-5 border border-emerald-100">
                    <p class="text-xs font-black uppercase tracking-widest text-emerald-700">1</p>
                    <h4 class="text-lg font-black text-gray-900 mt-2">Pilih Program</h4>
                    <p class="text-sm text-gray-600 mt-2">Masyarakat memilih kampanye wakaf produktif yang ingin didukung.</p>
                </div>
                <div class="rounded-2xl bg-emerald-50 p-5 border border-emerald-100">
                    <p class="text-xs font-black uppercase tracking-widest text-emerald-700">2</p>
                    <h4 class="text-lg font-black text-gray-900 mt-2">Isi Nominal</h4>
                    <p class="text-sm text-gray-600 mt-2">Masukkan nama wakif dan nominal wakaf uang tanpa proses login yang rumit.</p>
                </div>
                <div class="rounded-2xl bg-emerald-50 p-5 border border-emerald-100">
                    <p class="text-xs font-black uppercase tracking-widest text-emerald-700">3</p>
                    <h4 class="text-lg font-black text-gray-900 mt-2">Bayar via Pakasir</h4>
                    <p class="text-sm text-gray-600 mt-2">Wakif diarahkan ke halaman pembayaran QRIS Pakasir untuk menyelesaikan transaksi.</p>
                </div>
                <div class="rounded-2xl bg-emerald-50 p-5 border border-emerald-100">
                    <p class="text-xs font-black uppercase tracking-widest text-emerald-700">4</p>
                    <h4 class="text-lg font-black text-gray-900 mt-2">Status Terbarui</h4>
                    <p class="text-sm text-gray-600 mt-2">Saat pembayaran selesai, status wakaf dan progres kampanye diperbarui otomatis.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Catalog Section -->
    <section id="katalog" class="max-w-7xl mx-auto py-24 px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-end mb-12">
            <div>
                <h3 class="text-emerald-800 text-sm font-bold uppercase tracking-widest mb-2">Katalog Aset</h3>
                <h2 class="text-3xl font-extrabold text-gray-900">Tanah Wakaf Strategis</h2>
            </div>
            <a href="#" class="text-emerald-700 font-bold hover:text-emerald-500 transition">Lihat Semua &rarr;</a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($assets as $asset)
            <div class="bg-white rounded-3xl shadow-lg overflow-hidden group hover:shadow-2xl transition duration-500">
                <div class="relative h-64 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1582407947304-fd86f028f716?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="{{ $asset->name }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                    <div class="absolute top-4 left-4">
                        @if($asset->status === 'commercialized')
                            <span class="bg-amber-500 text-white px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-tight shadow-md">Produktif</span>
                        @elseif($asset->status === 'assigned')
                            <span class="bg-blue-600 text-white px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-tight shadow-md">Dikelola</span>
                        @else
                            <span class="bg-emerald-600 text-white px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-tight shadow-md">Tersedia</span>
                        @endif
                    </div>
                    @if($asset->commodity)
                    <div class="absolute bottom-4 right-4">
                        <span class="bg-white/90 backdrop-blur-sm text-emerald-800 px-3 py-1 rounded-full text-xs font-bold shadow">🌿 {{ $asset->commodity }}</span>
                    </div>
                    @endif
                </div>
                <div class="p-8">
                    <h4 class="text-xl font-extrabold text-gray-900 mb-2 truncate">{{ $asset->name }}</h4>
                    <div class="flex items-center text-gray-500 text-sm mb-3">
                        <svg class="h-5 w-5 mr-1 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        {{ $asset->location }}
                    </div>

                    @if($asset->original_area && $asset->original_area != $asset->area)
                    <div class="bg-emerald-50 border border-emerald-100 rounded-xl p-3 mb-3">
                        <p class="text-xs text-emerald-700 font-semibold">📐 Transformasi Lahan</p>
                        <p class="text-sm text-gray-700 mt-1">
                            <span class="line-through text-gray-400">{{ number_format($asset->original_area, 0) }} m²</span>
                            <span class="mx-1">→</span>
                            <span class="font-bold text-emerald-800">{{ number_format($asset->area, 0) }} m²</span>
                        </p>
                        @if($asset->area_source)
                        <p class="text-xs text-gray-500 mt-1">{{ $asset->area_source }}</p>
                        @endif
                    </div>
                    @endif

                    @if($asset->annual_revenue)
                    <div class="bg-amber-50 border border-amber-100 rounded-xl p-3 mb-3">
                        <p class="text-xs text-amber-700 font-semibold">💰 Pendapatan Tahunan</p>
                        <p class="text-lg font-black text-amber-700">Rp {{ number_format($asset->annual_revenue, 0, ',', '.') }}</p>
                        @if($asset->productive_years)
                        <p class="text-xs text-gray-500">Produktif selama {{ $asset->productive_years }} tahun</p>
                        @endif
                    </div>
                    @endif

                    <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                        <div>
                            <p class="text-gray-400 text-xs uppercase font-bold tracking-widest">Luas Tanah</p>
                            <p class="text-emerald-800 font-black text-lg">{{ number_format($asset->area, 0) }} m²</p>
                        </div>
                        <a href="#" class="bg-gray-100 hover:bg-amber-500 hover:text-white text-gray-700 w-12 h-12 rounded-2xl flex items-center justify-center transition duration-300">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- Program Wakaf (Crowdfunding) Section -->
    <section id="program" class="bg-emerald-50 py-24 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h3 class="text-emerald-800 text-sm font-bold uppercase tracking-widest mb-2">Program Wakaf Aktif</h3>
                <h2 class="text-3xl font-extrabold text-gray-900">Ubah Niat Jadi Aksi Nyata</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach($campaigns as $campaign)
                <div class="bg-white rounded-[2rem] shadow-xl overflow-hidden border border-emerald-100 flex flex-col">
                    <div class="h-48 relative">
                        <img src="https://images.unsplash.com/photo-1532629345422-7515f3d16bb6?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="{{ $campaign->title }}" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <div class="absolute bottom-4 left-6">
                            <span class="text-white text-xs font-bold uppercase tracking-widest bg-amber-500 px-3 py-1 rounded-full">Crowdfunding</span>
                        </div>
                    </div>
                    <div class="p-8 flex-1 flex flex-col">
                        <h4 class="text-xl font-bold text-gray-900 mb-4">{{ $campaign->title }}</h4>
                        <p class="text-gray-500 text-sm line-clamp-2 mb-6">{{ $campaign->description }}</p>
                        
                        <div class="mt-auto">
                            <div class="flex justify-between items-end mb-2">
                                <span class="text-emerald-700 font-black">Rp {{ number_format($campaign->current_amount) }}</span>
                                <span class="text-gray-400 text-xs text-right">Target: Rp {{ number_format($campaign->goal_amount) }}</span>
                            </div>
                            <div class="w-full bg-gray-100 rounded-full h-2">
                                <div class="bg-emerald-500 h-2 rounded-full" style="width: {{ min(100, ($campaign->current_amount / $campaign->goal_amount) * 100) }}%"></div>
                            </div>
                            <a href="{{ route('campaign.detail', $campaign->id) }}" class="mt-6 block text-center bg-emerald-800 hover:bg-emerald-900 text-white font-bold py-3 rounded-xl transition shadow-lg transform hover:-translate-y-1">
                                Berwakaf Sekarang
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-4 gap-12">
            <div class="space-y-6 md:col-span-2">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-emerald-600 rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold">L</span>
                    </div>
                    <h3 class="text-2xl font-black">LWP PWNU JATIM</h3>
                </div>
                <p class="text-gray-400 max-w-md leading-relaxed">
                    Meningkatkan martabat umat melalui pengelolaan wakaf yang profesional, amanah, dan berkesinambungan bagi kesejahteraan di Jawa Timur.
                </p>
            </div>
            <div>
                <h4 class="text-lg font-bold mb-8 text-amber-400">Hubungi Kami</h4>
                <ul class="space-y-4 text-gray-400">
                    <li class="flex items-start">
                        <span class="mr-3">📍</span>
                        Jl. Masjid Al Akbar Timur No.9, Surabaya
                    </li>
                    <li class="flex items-start">
                        <span class="mr-3">📞</span>
                        (031) 8295055
                    </li>
                </ul>
            </div>
            <div>
                <h4 class="text-lg font-bold mb-8 text-amber-400">Ikuti Kami</h4>
                <div class="flex space-x-4">
                    <a href="https://www.facebook.com/lwpnujatim" target="_blank" class="w-12 h-12 bg-gray-800 rounded-xl flex items-center justify-center hover:bg-emerald-600 transition shadow-lg group">
                        <svg class="w-6 h-6 text-gray-400 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg>
                    </a>
                    <a href="https://www.instagram.com/pwlwpnujatim/" target="_blank" class="w-12 h-12 bg-gray-800 rounded-xl flex items-center justify-center hover:bg-pink-600 transition shadow-lg group">
                        <svg class="w-6 h-6 text-gray-400 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.791-4-4s1.791-4 4-4 4 1.791 4 4-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </a>
                    <a href="https://www.youtube.com/@lwpnujatim3460" target="_blank" class="w-12 h-12 bg-gray-800 rounded-xl flex items-center justify-center hover:bg-red-600 transition shadow-lg group">
                        <svg class="w-6 h-6 text-gray-400 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                    </a>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-20 pt-8 border-t border-gray-800 text-center text-gray-500 text-sm">
            <p>&copy; 2026 LWP PWNU Jawa Timur. All Rights Reserved.</p>
        </div>
    </footer>
</div>
