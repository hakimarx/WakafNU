<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Status Wakaf Uang</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-emerald-50 min-h-screen text-gray-900">
    <div class="max-w-3xl mx-auto px-4 py-12">
        <div class="bg-white rounded-[2rem] shadow-2xl border border-emerald-100 overflow-hidden">
            <div class="bg-emerald-800 px-8 py-8 text-white">
                <p class="text-xs font-black uppercase tracking-[0.2em] text-emerald-200">Status Wakaf Uang</p>
                <h1 class="text-3xl font-black mt-3">Terima kasih atas niat baik Anda</h1>
                <p class="mt-3 text-emerald-100">Status transaksi akan berubah otomatis setelah pembayaran Pakasir diverifikasi.</p>
            </div>

            <div class="p-8 space-y-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="rounded-2xl bg-emerald-50 p-5">
                        <p class="text-xs font-black uppercase tracking-widest text-emerald-700">Order ID</p>
                        <p class="text-lg font-black mt-2">{{ $donation->external_id }}</p>
                    </div>
                    <div class="rounded-2xl bg-emerald-50 p-5">
                        <p class="text-xs font-black uppercase tracking-widest text-emerald-700">Status</p>
                        <p class="text-lg font-black mt-2">
                            @if($donation->status === 'success')
                                <span class="text-emerald-700">BERHASIL</span>
                            @elseif($donation->status === 'failed')
                                <span class="text-red-600">GAGAL</span>
                            @else
                                <span class="text-amber-600">MENUNGGU PEMBAYARAN</span>
                            @endif
                        </p>
                    </div>
                    <div class="rounded-2xl bg-emerald-50 p-5">
                        <p class="text-xs font-black uppercase tracking-widest text-emerald-700">Nama Wakif</p>
                        <p class="text-lg font-black mt-2">{{ $donation->donor_name ?: 'Hamba Allah' }}</p>
                    </div>
                    <div class="rounded-2xl bg-emerald-50 p-5">
                        <p class="text-xs font-black uppercase tracking-widest text-emerald-700">Nominal</p>
                        <p class="text-lg font-black mt-2">Rp {{ number_format($donation->amount, 0, ',', '.') }}</p>
                    </div>
                </div>

                <div class="rounded-2xl border border-emerald-100 p-6">
                    <p class="text-xs font-black uppercase tracking-widest text-emerald-700">Program Wakaf</p>
                    <h2 class="text-2xl font-black mt-2">{{ $donation->campaign->title }}</h2>
                    <p class="text-gray-600 mt-3">{{ $donation->campaign->description }}</p>
                </div>

                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('campaign.detail', $donation->campaign_id) }}" class="inline-flex items-center justify-center bg-emerald-700 hover:bg-emerald-800 text-white font-bold px-6 py-3 rounded-xl transition">
                        Kembali ke Program
                    </a>
                    <a href="{{ route('donation.status', $donation->external_id) }}" class="inline-flex items-center justify-center bg-white border border-emerald-200 hover:bg-emerald-50 text-emerald-800 font-bold px-6 py-3 rounded-xl transition">
                        Muat Ulang Status
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
