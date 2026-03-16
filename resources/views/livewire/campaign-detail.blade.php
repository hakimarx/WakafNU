<div class="bg-white">
    <!-- Breadcrumb or Simple Nav -->
    <div class="bg-emerald-900 py-12 px-6">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-4xl font-extrabold text-white mb-2">{{ $campaign->title }}</h1>
            <p class="text-emerald-200 text-lg">Program Wakaf Produktif LWP PWNU Jatim</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Left Info -->
            <div class="lg:col-span-2 space-y-8">
                <div class="rounded-3xl overflow-hidden shadow-2xl bg-gray-100 aspect-video">
                    <!-- Placeholder image with generate_image logic later -->
                    <img src="https://images.unsplash.com/photo-1574629810360-7efbbe195018?auto=format&fit=crop&q=80&w=1200" alt="{{ $campaign->title }}" class="w-full h-full object-cover">
                </div>

                <div class="prose prose-emerald lg:prose-xl max-w-none">
                    <h2 class="text-2xl font-bold text-emerald-900 border-b-2 border-emerald-100 pb-2">Deskripsi Program</h2>
                    <p class="text-gray-600 leading-relaxed">{{ $campaign->description }}</p>
                    
                    <h2 class="text-2xl font-bold text-emerald-900 mt-8 border-b-2 border-emerald-100 pb-2">Detail Aset</h2>
                    <div class="grid grid-cols-2 gap-4 mt-4">
                        <div class="bg-emerald-50 p-4 rounded-xl">
                            <span class="text-xs text-emerald-600 font-bold uppercase">Lokasi</span>
                            <p class="font-bold text-emerald-900">{{ $campaign->waqfAsset->location }}</p>
                        </div>
                        <div class="bg-emerald-50 p-4 rounded-xl">
                            <span class="text-xs text-emerald-600 font-bold uppercase">Luas Aset</span>
                            <p class="font-bold text-emerald-900">{{ number_format($campaign->waqfAsset->area) }} m²</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Sidebar (Donation Form) -->
            <div class="space-y-6">
                <div class="bg-white p-8 rounded-3xl shadow-2xl border border-emerald-50 sticky top-8">
                    <div class="mb-6">
                        <div class="flex justify-between items-end mb-2">
                            <span class="text-3xl font-black text-emerald-600">Rp {{ number_format($campaign->current_amount) }}</span>
                            <span class="text-sm text-gray-400">G: Rp {{ number_format($campaign->goal_amount) }}</span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-3">
                            <div class="bg-emerald-500 h-3 rounded-full transition-all duration-1000" style="width: {{ min(100, ($campaign->current_amount / $campaign->goal_amount) * 100) }}%"></div>
                        </div>
                        <p class="text-xs text-gray-500 mt-3 font-medium">Terkumpul dari target pembangunan ruko.</p>
                    </div>

                    <livewire:donation-component :campaign-id="$campaign->id" />

                    <div class="mt-8 pt-6 border-t border-gray-100">
                        <div class="flex items-center space-x-3">
                            <div class="bg-amber-100 p-2 rounded-full">
                                <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-gray-900">Pembayaran Aman</h4>
                                <p class="text-xs text-gray-500 italic">Dikelola langsung oleh LWP PWNU Jatim melalui Pakasir untuk wakaf uang publik.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
