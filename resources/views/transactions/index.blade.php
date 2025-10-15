<x-layouts.app>
    <div class="p-6 text-white">
        <h1 class="text-2xl font-semibold mb-4 text-[#00E6C3]">Transaction History</h1>

        @if ($transactions->isEmpty())
            <p class="text-white/70">No transactions yet.</p>
        @else
            <div class="space-y-3">
                @foreach ($transactions as $transaction)
                    <div
                        class="bg-gradient-to-br from-[#182430] to-[#0C141C] border border-white/15 rounded-xl p-4 flex justify-between items-center shadow-[0_0_12px_rgba(0,200,180,0.4)]">
                        <div class="flex flex-col">
                            <strong class="text-base text-white">{{ $transaction->type }}</strong>
                            <span class="text-xs text-white/60">{{ $transaction->created_at->format('d M, Y') }}</span>
                        </div>
                        {{-- @php
                            $type = $transaction->type;
                        @endphp --}}
                        <div
                            class="text-right text-base font-bold  text-white/50 ">
                            ₦{{ number_format($transaction->amount, 2) }}
                            <small class="block text-xs {{ $transaction->status == 'completed' ? 'text-green-400' : 'text-red-400' }}  capitalize">{{ $transaction->status }}</small>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-layouts.app>
