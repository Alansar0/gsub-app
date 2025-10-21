{{-- https://chatgpt.com/s/t_68da6ef76d248191b2db417b430a3a76 --}}
<x-layouts.app>
    <div class=" w-full h-[70vh] bg-[#0d1117] text-[#f0f6fc] font-['Roboto'] min-h-screen m-0 p-0">
        <div class=" w-full flex justify-start mt-6 mb-4">
            <a href="{{ url()->previous() }}" class="text-[#58a6ff] hover:underline flex items-center">
                <i class="material-icons mr-1">arrow_back</i> Back
            </a>
        </div>
        <div class="w-full text-center mt-3  p-6">
            <span class="text-2xl font-bold text-[#58a6ff] mb-6">
                Notification
            </span>
        </div>
        <div id="notification-list">

            @foreach ($notifications as $notification)
                <a href="/notifications/{{ $notification->id }}"
                    class="flex items-center gap-3 p-4 border border-white/10 rounded-xl mb-3 bg-gradient-to-br from-[#182430] to-[#0C141C]">
                    <img src="{{ Vite::asset('resources/images/logo.png') }}"
                        class="w-10 h-10 rounded-full border border-white" />
                    <div>
                        <p class="text-sm font-semibold text-white">{{ $notification->data['title'] ?? 'Notification' }}
                        </p>
                        <p class="text-xs text-white">{{ $notification->data['message'] ?? '' }}</p>
                        <small class="text-gray-400">
                            {{ $notification->created_at->diffForHumans() }}
                            {{-- or format full date --}}
                            {{ $notification->created_at->format('M d, Y h:i A') }}
                        </small>
                    </div>
                </a>
            @endforeach
        </div>
        <div class="mt-4 p-6">
            {{ $notifications->links() }}
        </div>
    </div>
</x-layouts.app>
