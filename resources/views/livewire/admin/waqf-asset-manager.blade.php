<div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md border border-emerald-100">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-emerald-800 dark:text-emerald-200">Manajemen Aset Wakaf</h2>
        <button wire:click="create" class="bg-amber-500 hover:bg-amber-600 text-emerald-900 font-bold py-2 px-6 rounded-xl shadow-lg transition transform hover:-translate-y-0.5">
            + Tambah Aset
        </button>
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
                    <th class="px-6 py-3 text-left text-xs font-semibold text-emerald-800 dark:text-emerald-100 uppercase tracking-wider">Aset</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-emerald-800 dark:text-emerald-100 uppercase tracking-wider">Lokasi</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-emerald-800 dark:text-emerald-100 uppercase tracking-wider">Luas (m²)</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-emerald-800 dark:text-emerald-100 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-center text-xs font-semibold text-emerald-800 dark:text-emerald-100 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @foreach($assets as $asset)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-bold text-gray-900 dark:text-white">{{ $asset->name }}</div>
                            <div class="text-xs text-gray-400 font-medium">LGL: {{ $asset->legality }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-500 dark:text-gray-400 line-clamp-1">{{ $asset->location }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-black text-emerald-700 dark:text-emerald-400">{{ number_format($asset->area) }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full {{ $asset->status === 'available' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                                {{ strtoupper($asset->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                            <button class="text-emerald-600 hover:text-emerald-900 mr-3">Edit</button>
                            <button wire:click="delete({{ $asset->id }})" class="text-red-600 hover:text-red-900">Hapus</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal manually implemented for TALL Stack vibe -->
    @if($isModalOpen)
    <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" wire:click="$set('isModalOpen', false)"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-middle bg-white rounded-3xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-emerald-800 px-6 py-4 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-white uppercase tracking-widest">Tambah Aset Baru</h3>
                    <button wire:click="$set('isModalOpen', false)" class="text-white hover:text-amber-400">&times;</button>
                </div>
                <div class="bg-white px-8 pt-6 pb-8 space-y-4">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Nama Aset</label>
                        <input type="text" wire:model="name" class="shadow-sm border-gray-200 rounded-xl w-full py-3 px-4 text-gray-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition">
                        @error('name') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Lokasi Strategis</label>
                        <textarea wire:model="location" class="shadow-sm border-gray-200 rounded-xl w-full py-3 px-4 text-gray-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition" rows="3"></textarea>
                        @error('location') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Luas (m²)</label>
                            <input type="number" wire:model="area" class="shadow-sm border-gray-200 rounded-xl w-full py-3 px-4 text-gray-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition">
                            @error('area') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Legalitas</label>
                            <input type="text" wire:model="legality" placeholder="cth: Sertifikat Wakaf" class="shadow-sm border-gray-200 rounded-xl w-full py-3 px-4 text-gray-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition">
                            @error('legality') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-8 py-4 flex justify-end space-x-3 rounded-b-3xl">
                    <button wire:click="$set('isModalOpen', false)" class="text-gray-500 font-bold px-6 py-2 transition hover:text-gray-800">Batal</button>
                    <button wire:click="store" class="bg-emerald-600 hover:bg-emerald-700 text-white font-black px-8 py-3 rounded-xl shadow-lg transition transform hover:scale-105">Simpan Aset</button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
