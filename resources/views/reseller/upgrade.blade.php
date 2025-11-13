<x-layouts.app>
    <div class="bg-[#0d0d0f] text-white min-h-screen font-sans py-6 px-4">
        <!-- Back -->
        <div class="flex justify-start mb-4">
            <a href="{{ url()->previous() }}" class="text-[#58a6ff] hover:underline flex items-center">
                <i class="material-icons mr-1">arrow_back</i> Back
            </a>
        </div>

        <div class="max-w-md mx-auto bg-[#1b1b1f] border border-gray-700 rounded-2xl p-6 shadow-lg">
            <h1 class="text-2xl font-bold text-[#58a6ff] mb-4 text-center">
                Upgrade to Hotspot Reseller
            </h1>

            <p class="text-gray-400 text-sm mb-6 text-center">
                Become a local ISP and connect your MikroTik router to sell data vouchers.
            </p>

            <form method="POST" action="{{ route('reseller.self.upgrade') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm text-gray-400 mb-1">Hotspot / ISP Name</label>
                    <input type="text" name="name" class="w-full bg-[#0d0d0f] border border-gray-700 rounded-lg px-3 py-2 text-white focus:ring-2 focus:ring-[#58a6ff]" required placeholder="e.g., SmartNet WiFi">
                </div>

                <div>
                    <label class="block text-sm text-gray-400 mb-1">Router Host (IP or Domain)</label>
                    <input type="text" name="host" class="w-full bg-[#0d0d0f] border border-gray-700 rounded-lg px-3 py-2 text-white" required placeholder="e.g., 10.0.0.1">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-sm text-gray-400 mb-1">Port</label>
                        <input type="number" name="port" class="w-full bg-[#0d0d0f] border border-gray-700 rounded-lg px-3 py-2 text-white" required placeholder="8728">
                    </div>
                    <div>
                        <label class="block text-sm text-gray-400 mb-1">Username</label>
                        <input type="text" name="username" class="w-full bg-[#0d0d0f] border border-gray-700 rounded-lg px-3 py-2 text-white" required placeholder="api_user">
                    </div>
                </div>

                <div>
                    <label class="block text-sm text-gray-400 mb-1">Password</label>
                    <input type="password" name="password" class="w-full bg-[#0d0d0f] border border-gray-700 rounded-lg px-3 py-2 text-white" required>
                </div>

                <button type="submit" class="w-full bg-[#58a6ff] hover:bg-[#4793e0] text-white font-semibold rounded-lg py-3 transition">
                    Upgrade & Connect
                </button>
            </form>
        </div>
    </div>
</x-layouts.app>
