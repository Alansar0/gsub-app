<x-layouts.app>
    <div class="min-h-screen bg-[#0d1117] text-[#f0f6fc] font-['Roboto'] p-6">



        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-semibold text-[#58a6ff] tracking-wide flex items-center gap-2">
                Transaction History
            </h1>
        </div>

        <!-- Transaction List -->
        @if ($transactions->isEmpty())
            <div class="text-center py-10">
                <p class="text-gray-400 text-sm">No transactions yet.</p>
            </div>
        @else
            <div class="space-y-4">
                @foreach ($transactions as $transaction)
                    <div
                        class="bg-gradient-to-br from-[#182430] to-[#0C141C] border border-white/10 rounded-2xl p-5 flex justify-between items-center shadow-[0_0_15px_rgba(0,230,195,0.35)] hover:shadow-[0_0_20px_rgba(0,230,195,0.6)] transition-all duration-300">

                        <div class="flex flex-col">
                            <strong class="text-base text-[#f0f6fc] font-medium">{{ $transaction->type }}</strong>
                            <span class="text-xs text-gray-400">{{ $transaction->created_at->format('d M, Y h:i A') }}</span>
                        </div>

                        <div class="text-right">
                            <span class="text-base font-semibold  {{ $transaction->type == 'credit' ? 'text-green-400' : 'text-red-400' }}">
                                ₦{{ number_format($transaction->amount, 2) }}
                            </span>
                            <small class="block text-xs mt-1 text-[#f0f6fc]   capitalize">
                                {{ $transaction->status }}
                            </small>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-layouts.app>
