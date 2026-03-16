<div class="bg-white rounded-[2.5rem] p-10 shadow-xl border border-blue-50">
    <div class="flex items-center justify-between mb-10">
        <div>
            <h3 class="text-2xl font-black text-gray-900 leading-tight">Review Proposal Investasi</h3>
            <p class="text-blue-600 font-bold text-xs uppercase tracking-widest mt-1">Menunggu Keputusan LWP</p>
        </div>
        <div class="bg-blue-50 px-4 py-2 rounded-2xl text-blue-700 font-black text-sm">
            {{ $pendingProposals->count() }} Pending
        </div>
    </div>

    @if (session()->has('proposal_message'))
        <div class="mb-6 p-4 bg-emerald-100 text-emerald-800 rounded-2xl font-bold">
            {{ session('proposal_message') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-100">
            <thead>
                <tr class="text-left text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">
                    <th class="pb-6 px-4">Investor & Aset</th>
                    <th class="pb-6 px-4">Nilai & Skema</th>
                    <th class="pb-6 px-4 text-center">Dokumen</th>
                    <th class="pb-6 px-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($pendingProposals as $proposal)
                <tr class="group hover:bg-gray-50/50 transition">
                    <td class="py-6 px-4">
                        <div class="text-sm font-black text-gray-900">{{ $proposal->investor->name }}</div>
                        <div class="text-xs text-blue-600 font-bold uppercase tracking-tighter">{{ $proposal->waqfAsset->name }}</div>
                    </td>
                    <td class="py-6 px-4">
                        <div class="text-sm font-bold text-gray-700 italic">Rp {{ number_format($proposal->investment_value) }}</div>
                        <div class="text-[10px] text-gray-400 font-black uppercase tracking-widest">{{ $proposal->scheme }}</div>
                    </td>
                    <td class="py-6 px-4 text-center">
                        <a href="{{ Storage::url($proposal->business_plan_file_path) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-blue-50 text-blue-700 rounded-xl text-xs font-black hover:bg-blue-600 hover:text-white transition">
                            VIEW PDF
                        </a>
                    </td>
                    <td class="py-6 px-4 text-right space-x-2">
                        <button wire:click="reject({{ $proposal->id }})" class="bg-red-50 text-red-600 px-4 py-2 rounded-xl text-[10px] font-black uppercase hover:bg-red-600 hover:text-white transition group-hover:shadow-lg">Reject</button>
                        <button wire:click="approve({{ $proposal->id }})" class="bg-emerald-600 text-white px-5 py-2 rounded-xl text-[10px] font-black uppercase hover:bg-black transition group-hover:shadow-lg">Approve</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="py-12 text-center text-gray-400 italic font-medium">
                        Tidak ada proposal pending saat ini.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
