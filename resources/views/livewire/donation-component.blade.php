<div class="bg-emerald-50 p-6 rounded-2xl border border-emerald-100 shadow-sm">
    <h3 class="text-xl font-bold text-emerald-900 mb-2">Wakaf Uang Sekarang</h3>
    <p class="text-sm text-emerald-700 mb-4">Masyarakat umum dapat berwakaf tanpa login. Setelah klik lanjut, Anda akan diarahkan ke pembayaran Pakasir.</p>
    
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
            <div class="grid grid-cols-2 gap-2 mt-3">
                @foreach($quickAmounts as $quickAmount)
                    <button type="button" wire:click="fillAmount({{ $quickAmount }})" class="rounded-xl border border-emerald-200 bg-white px-3 py-2 text-sm font-semibold text-emerald-700 hover:bg-emerald-100 transition">
                        Rp {{ number_format($quickAmount, 0, ',', '.') }}
                    </button>
                @endforeach
            </div>
        </div>

        <button wire:click="donate" wire:loading.attr="disabled" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 rounded-xl shadow-lg transition transform active:scale-95 disabled:opacity-50">
            <span wire:loading.remove>Lanjut Bayar Wakaf</span>
            <span wire:loading>Memproses...</span>
        </button>

        <div class="rounded-2xl bg-white/80 border border-emerald-100 p-4 text-sm text-gray-600">
            <p class="font-bold text-emerald-900 mb-2">Alur Wakaf Uang</p>
            <ol class="space-y-1 list-decimal list-inside">
                <li>Isi nama dan nominal wakaf.</li>
                <li>Klik tombol pembayaran.</li>
                <li>Bayar melalui QRIS Pakasir.</li>
                <li>Status wakaf akan otomatis diperbarui setelah pembayaran berhasil.</li>
            </ol>
        </div>
    </div>

    <script>
        window.addEventListener('redirect-to-payment', event => {
            window.location.href = event.detail.url;
        });
    </script>
</div>
