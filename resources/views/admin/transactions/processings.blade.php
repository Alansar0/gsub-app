<x-layouts.admin>
    <div class="p-6 min-h-screen bg-[#0B1620] text-white space-y-10">

        <div class=" w-full flex justify-start mt-6 mb-4">
            <a href="{{ url()->previous() }}" class="text-[#58a6ff] hover:underline flex items-center">
                <i class="material-icons mr-1">arrow_back</i> Back
            </a>
        </div>

        {{-- PROCESSING ORDERS --}}
        <div class="bg-[#101E2B] rounded-2xl mt-15 shadow-[0_0_20px_rgba(0,255,209,0.1)] p-6 border border-[#00FFD1]/20">
            <h2 class="text-lg font-semibold mb-4 text-[#00FFD1]">Processing Orders</h2>

            <button
                class="bg-[#00FFD1] text-[#101E2B] px-5 py-2 rounded-xl font-medium mb-5 shadow-[0_0_10px_#00FFD1] hover:opacity-80 transition">
                Mark All Processing as Successful
            </button>

            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left rounded-xl overflow-hidden border border-[#00FFD1]/10">
                    <thead class="bg-[#142434] text-[#00FFD1] uppercase font-semibold">
                        <tr>
                            <th class="px-4 py-3">Action</th>
                            <th class="px-4 py-3">Reseller No</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Product</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($processings as $txn)
                            <tr class="border-b border-[#00FFD1]/10 hover:bg-[#182b3c] transition">
                                <td class="px-4 py-3 flex gap-3">
                                    <button
                                        class="bg-[#0B1620] text-[#00FFD1] px-4 py-1.5 rounded-lg border border-[#00FFD1]/40 shadow hover:bg-[#00FFD1] hover:text-[#0B1620] transition">Refund</button>
                                    <button
                                        class="bg-[#00FFD1] text-[#101E2B] px-4 py-1.5 rounded-lg shadow-[0_0_10px_#00FFD1] hover:opacity-80 transition">Success</button>
                                </td>
                                <td class="px-4 py-3 text-gray-300">{{ $txn->user->phone ?? 'N/A' }}</td>
                                <td class="px-4 py-3 capitalize text-[#FFC107]">{{ $txn->status }}</td>
                                <td class="px-4 py-3 text-gray-400">{{ $txn->description }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-6 text-gray-500">No processing orders</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-layouts.admin>
