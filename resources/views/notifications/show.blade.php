<x-layouts.app>
    <div class="min-h-screen bg-[#0d1117] text-[#f0f6fc] font-['Roboto'] p-4">

        <!-- Back Button -->
        <div class="w-full flex justify-start mt-6 mb-4">
            <a href="{{ url()->previous() }}"
                class="text-[#58a6ff] hover:underline flex items-center transition-all duration-300 hover:opacity-80">
                <i class="material-icons mr-1">arrow_back</i> Back
            </a>
        </div>

        <!-- Notification Card -->
        <div class="bg-gradient-to-br from-[#182430] to-[#101820] rounded-2xl shadow-[0_0_15px_rgba(88,166,255,0.2)] p-6 border border-[#58a6ff]/20 transition-all duration-300 hover:shadow-[0_0_25px_rgba(88,166,255,0.3)]">

            <!-- Header -->
            <div class="flex items-center gap-3 mb-4">
                <img src="{{ Vite::asset('resources/images/logo.png') }}"
                     class="w-14 h-14 rounded-full border border-[#58a6ff]/40 shadow-[0_0_8px_rgba(88,166,255,0.3)]" />
                <div>
                    <p class="text-lg font-semibold text-[#f0f6fc]">
                        {{ $notification->data['title'] ?? 'New Notification' }}
                    </p>
                    <p class="text-xs text-[#58a6ff]/80 tracking-wide">
                        {{ $notification->data['subtitle'] ?? 'FAHAX Web3 Notification' }}
                    </p>
                </div>
            </div>

            <!-- Message Body -->
            <div class="text-sm leading-relaxed text-gray-300 mb-6 border-t border-[#58a6ff]/10 pt-4">
                {{ $notification->data['message'] ?? 'No additional message provided.' }}
            </div>

            <!-- Footer Actions -->
            <div class="flex justify-between items-center">
                <span class="text-xs text-[#58a6ff]/70">
                    {{ $notification->created_at->diffForHumans() }} •
                    {{ $notification->created_at->format('M d, Y h:i A') }}
                </span>

                @if(!$notification->read_at)
                    <form action="{{ route('notifications.markAsRead', $notification->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button class="bg-[#233249] hover:bg-[#2c4963] text-[#f0f6fc] px-4 py-2 rounded-md text-sm transition-all duration-300 hover:shadow-[0_0_10px_rgba(88,166,255,0.3)]">
                            Mark as Read
                        </button>
                    </form>
                @else
                    <span class="text-green-400 text-sm flex items-center gap-1">
                        ✅ Read
                    </span>
                @endif
            </div>
        </div>

    </div>
</x-layouts.app>
