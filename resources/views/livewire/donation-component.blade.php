<div class="bg-emerald-50 p-6 rounded-2xl border border-emerald-100 shadow-sm">
    <h3 class="text-xl font-bold text-emerald-900 mb-4">Donasi Sekarang</h3>
    
    @if(session()->has('error'))
        <div class="mb-4 text-red-600 text-sm font-medium">
            {{ session('error') }}
        </div>
    @endif

    <div class="space-y-4">
        <div>
            <label class="block text-sm font-bold text-emerald-800 mb-1">Nama Donatur</label>
            <input type="text" wire:model="donorName" class="w-full rounded-xl border-emerald-200 focus:ring-emerald-500 focus:border-emerald-500" placeholder="Hamba Allah">
            @error('donorName') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-bold text-emerald-800 mb-1">Jumlah Donasi (Rp)</label>
            <input type="number" wire:model="amount" class="w-full rounded-xl border-emerald-200 focus:ring-emerald-500 focus:border-emerald-500" placeholder="Min. 10,000">
            @error('amount') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
        </div>

        <button wire:click="donate" wire:loading.attr="disabled" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 rounded-xl shadow-lg transition transform active:scale-95 disabled:opacity-50">
            <span wire:loading.remove>Lanjut ke Pembayaran</span>
            <span wire:loading>Memproses...</span>
        </button>
    </div>

    <!-- Pakasir Script -->
    <script>
        window.addEventListener('redirect-to-payment', event => {
            // Redirect ke halaman pembayaran Pakasir
            window.location.href = event.detail.url;
        });
    </script>
</div>
