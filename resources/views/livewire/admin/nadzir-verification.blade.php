<div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md border border-emerald-100">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-emerald-800 dark:text-emerald-200">Verifikasi Nadzir Baru</h2>
        <div class="text-sm text-gray-500">Menunggu Persetujuan</div>
    </div>

    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-emerald-100 border-l-4 border-emerald-500 text-emerald-700">
            {{ session('message') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-emerald-50 dark:bg-emerald-900/20">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-emerald-800 dark:text-emerald-100 uppercase tracking-wider">Nama Nadzir</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-emerald-800 dark:text-emerald-100 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-emerald-800 dark:text-emerald-100 uppercase tracking-wider">Dokumen</th>
                    <th class="px-6 py-3 text-center text-xs font-semibold text-emerald-800 dark:text-emerald-100 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($pendingCertifications as $cert)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-bold text-gray-900 dark:text-white">{{ $cert->user->name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ $cert->user->email }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <div class="flex space-x-2">
                                <a href="#" class="text-emerald-600 hover:text-emerald-800 font-medium">Lihat KTP</a>
                                <span class="text-gray-300">|</span>
                                <a href="#" class="text-emerald-600 hover:text-emerald-800 font-medium">Sertifikat BWI</a>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                            <button wire:click="approve({{ $cert->id }})" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg mr-2 transition shadow-sm">Setujui</button>
                            <button wire:click="reject({{ $cert->id }})" class="bg-red-50 hover:bg-red-100 text-red-600 px-4 py-2 rounded-lg transition">Tolak</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-10 text-center text-gray-500 italic">
                            Belum ada pengajuan Nadzir baru.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
