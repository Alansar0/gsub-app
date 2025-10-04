<x-layout>
    <div class="min-h-screen bg-[#0d1117] text-[#f0f6fc] font-['Roboto'] p-4">

        <!-- Back Button -->
        <div class="flex items-center gap-2 mb-6">
            <a href="#" class="flex items-center text-[#58a6ff] hover:underline">
                <i class="material-icons">arrow_back</i>
                <span class="ml-1">Back</span>
            </a>
        </div>

        <!-- Notification Card -->
        <div class="bg-gradient-to-br from-[#182430] to-[#0C141C] rounded-2xl shadow-lg p-6">
            <!-- Header -->
            <div class="flex items-center gap-3 mb-4">
                <img src="{{ Vite::asset('resources/images/logo.png') }}"
                     class="w-14 h-14 rounded-full border border-white" />
                <div>
                    <p class="text-lg font-semibold">Everyday English French Spanish</p>
                    <p class="text-xs text-gray-400">Conversation and Fun - Joel</p>
                </div>
            </div>

            <!-- Message Body -->
            <div class="text-sm leading-relaxed text-gray-300 mb-6">
                🎉 You have been invited to join the "Everyday English French Spanish" group.
                Join us to practice languages, share knowledge, and have fun with the community!
            </div>

            <!-- Footer Actions -->
            <div class="flex justify-between items-center">
                <span class="text-xs text-gray-500">2 hours ago</span>
                <button class="bg-[#233249] hover:bg-[#2c4963] text-white px-4 py-2 rounded-md text-sm">
                    Mark as Read
                </button>
            </div>
        </div>

    </div>
</x-layout>
