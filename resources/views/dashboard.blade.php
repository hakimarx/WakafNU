<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            @if(auth()->user()->isAdmin())
                <!-- Admin Dashboard Section -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <livewire:admin.nadzir-verification />
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md border border-emerald-100 italic text-gray-400">
                        Statistik Cepat (Coming Soon)
                    </div>
                </div>
                <livewire:admin.waqf-asset-manager />
                <livewire:admin.proposal-review />
            @elseif(auth()->user()->isNadzir())
                <!-- Nadzir Dashboard Section -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <h2 class="text-xl font-bold text-emerald-800 mb-4">Aset yang Anda Kelola</h2>
                    <livewire:nadzir.asset-registration />
                </div>
            @elseif(auth()->user()->isInvestor())
                <!-- Investor Dashboard Section -->
                <div class="space-y-8">
                    <div class="bg-gradient-to-r from-blue-900 to-emerald-900 p-10 rounded-[3rem] text-white shadow-2xl">
                        <h2 class="text-3xl font-black mb-2 tracking-tight">Selamat Datang, Investor</h2>
                        <p class="text-blue-200">Terima kasih telah berkontribusi dalam memajukan ekonomi umat melalui wakaf produktif.</p>
                    </div>
                    <livewire:investor.investment-submission />
                </div>
            @else
                <div class="space-y-8">
                    <div class="bg-gradient-to-r from-emerald-800 to-emerald-600 p-10 rounded-[3rem] text-white shadow-2xl">
                        <h2 class="text-3xl font-black mb-2 tracking-tight">Assalamu'alaikum, {{ auth()->user()->name }}</h2>
                        <p class="text-emerald-100">Semoga hari Anda diberkahi dengan segala kebaikan.</p>
                        <a href="{{ route('nadzir.register') }}" class="mt-6 inline-block bg-amber-500 hover:bg-white text-emerald-900 px-6 py-2 rounded-xl text-sm font-black transition">Daftar Jadi Nadzir &rarr;</a>
                    </div>
                    <livewire:donation-history />
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
