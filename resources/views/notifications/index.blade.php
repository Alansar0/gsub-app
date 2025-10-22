{{-- https://chatgpt.com/s/t_68da6ef76d248191b2db417b430a3a76 --}}
<x-layouts.app>
    <div class="min-h-screen bg-[#0d1117] text-[#f0f6fc] font-['Roboto'] flex flex-col">

        <!-- Back Button -->
        <div class="w-full flex justify-start mt-6 mb-4 px-4">
            <a href="{{ url()->previous() }}"
                class="text-[#58a6ff] hover:underline flex items-center transition-all duration-300 hover:opacity-80">
                <i class="material-icons mr-1">arrow_back</i> Back
            </a>
        </div>

        <!-- Header -->
        <div class="w-full text-center mt-2 px-6">
            <h1 class="text-2xl font-bold text-[#58a6ff] mb-6 tracking-wide">
                Notifications
            </h1>
        </div>

        <!-- Notification List -->
        <div id="notification-list" class="flex flex-col px-5 space-y-3">
            @forelse ($notifications as $notification)
                <a href="/notifications/{{ $notification->id }}"
                    class="flex items-center gap-3 p-4 border border-[#58a6ff]/20 rounded-xl bg-gradient-to-br from-[#182430] to-[#101820] shadow-[0_0_12px_rgba(88,166,255,0.15)] hover:shadow-[0_0_20px_rgba(88,166,255,0.3)] transition-all duration-300">

                    <img src="{{ Vite::asset('resources/images/logo.png') }}"
                        class="w-10 h-10 rounded-full border border-[#58a6ff]/40 shadow-[0_0_8px_rgba(88,166,255,0.3)]" />

                    <div class="flex flex-col">
                        <p class="text-sm font-semibold text-[#f0f6fc]">
                            {{ $notification->data['title'] ?? 'Notification' }}
                        </p>
                        <p class="text-xs text-gray-300 leading-snug">
                            {{ $notification->data['message'] ?? '' }}
                        </p>
                        <small class="text-[#58a6ff]/70 text-[11px] mt-1">
                            {{ $notification->created_at->diffForHumans() }} •
                            {{ $notification->created_at->format('M d, Y h:i A') }}
                        </small>
                    </div>
                </a>
            @empty
                <p class="text-center text-gray-400 mt-10 text-sm">
                    You have no notifications at the moment.
                </p>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-6 px-6 text-center">
            {{ $notifications->links() }}
        </div>
    </div>
</x-layouts.app>

