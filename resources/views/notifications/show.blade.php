


<x-layouts.app>
    <div class="min-h-screen bg-[#0d1117] text-[#f0f6fc] font-['Roboto'] p-4">

        <!-- Back Button -->
        <div class=" w-full flex justify-start mt-6 mb-4">
            <a href="{{ url()->previous() }}" class="text-[#58a6ff] hover:underline flex items-center">
                <i class="material-icons mr-1">arrow_back</i> Back
            </a>
        </div>

        <!-- Notification Card -->
        <div class="bg-gradient-to-br from-[#182430] to-[#0C141C] rounded-2xl shadow-lg p-6">
            <!-- Header -->
            <div class="flex items-center gap-3 mb-4">
                <img src="{{ Vite::asset('resources/images/logo.png') }}"
                     class="w-14 h-14 rounded-full border border-white" />
                <div>
                    <p class="text-lg font-semibold">
                        {{ $notification->data['title'] ?? 'New Notification' }}
                    </p>
                    <p class="text-xs text-gray-400">
                        {{ $notification->data['subtitle'] ?? 'FAHAX Web3 Notification' }}
                    </p>
                </div>
            </div>

            <!-- Message Body -->
            <div class="text-sm leading-relaxed text-gray-300 mb-6">
                {{ $notification->data['message'] ?? 'No additional message provided.' }}
            </div>

            <!-- Footer Actions -->
            <div class="flex justify-between items-center">
                <span class="text-xs text-gray-500">
                    {{ $notification->created_at->diffForHumans() }}
                </span>

                @if(!$notification->read_at)
                    <form action="{{ route('notifications.markAsRead', $notification->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button class="bg-[#233249] hover:bg-[#2c4963] text-white px-4 py-2 rounded-md text-sm">
                            Mark as Read
                        </button>
                    </form>
                @else
                    <span class="text-green-400 text-sm">✅ Read</span>
                @endif
            </div>
        </div>

    </div>
</x-layouts.app>

