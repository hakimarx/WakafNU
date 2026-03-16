<div class="bg-white rounded-[2rem] p-10 shadow-xl border border-emerald-50">
    <div class="mb-10">
        <h3 class="text-2xl font-black text-gray-900 leading-tight">Jejak Kebaikan Anda</h3>
        <p class="text-emerald-600 font-bold text-xs uppercase tracking-widest mt-1">Riwayat Wakaf Uang</p>
    </div>

    <div class="space-y-4">
        @forelse($donations as $donation)
            <div class="flex items-center justify-between p-6 bg-emerald-50/30 rounded-3xl border border-emerald-100 hover:bg-emerald-50 transition">
                <div class="flex items-center space-x-6">
                    <div class="w-14 h-14 bg-emerald-600 rounded-2xl flex items-center justify-center text-white font-black italic shadow-lg shadow-emerald-100">
                        {{ substr($donation->campaign->title ?? 'W', 0, 1) }}
                    </div>
                    <div>
                        <h4 class="font-black text-gray-900 leading-tight">{{ $donation->campaign->title ?? 'Wakaf Umum' }}</h4>
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">{{ $donation->created_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>
                <div class="text-right">
                    <div class="text-lg font-black text-emerald-800 italic">Rp {{ number_format($donation->amount) }}</div>
                    <span class="px-3 py-1 text-[10px] font-black rounded-full uppercase
                        {{ $donation->status === 'settlement' || $donation->status === 'success' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                        {{ $donation->status }}
                    </span>
                </div>
            </div>
        @empty
            <div class="py-12 text-center text-gray-400 italic">
                Belum ada riwayat donasi. Mari mulai berwakaf!
            </div>
        @endforelse
    </div>
</div>
