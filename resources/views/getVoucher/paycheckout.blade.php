<x-layouts.admin>
    <div class="bg-[#0B1120] min-h-screen flex flex-col items-center justify-center p-6">
        <div class=" w-full flex justify-start mt-6 mb-4">
            <a href="{{ url()->previous() }}" class="text-[#58a6ff] hover:underline flex items-center">
                <i class="material-icons mr-1">arrow_back</i> Back
            </a>
        </div>
        <!-- Payment Card -->
        <div class="bg-[#121A2F] rounded-2xl p-4 w-88 shadow-xl border border-[#1C2750] text-white">
            <h2 class="text-xl text-center font-bold mb-2 text-[#58a6ff]">Confirm Payment</h2>
            <p class="text-sm text-gray-400 mb-6">
                Please confirm your details before proceeding.
            </p>

            <!-- Details Box -->
            <div class="bg-[#3a75c4] rounded-xl p-4 mb-6">
                <div class="flex justify-between mb-1 text-sm text-[#121A2F]">
                    <span>Product</span>
                    <span class="font-medium text-[#121A2F]">MTN Data</span>
                </div>
                <div class="flex justify-between mb-1 text-sm text-[#121A2F]">
                    <span>Discount</span>
                    <span class="font-medium text-[#121A2F]">—</span>
                </div>
                <div class="flex justify-between mb-1 text-sm text-[#121A2F]">
                    <span>Number</span>
                    <span class="font-medium text-[#121A2F]">07044834946</span>
                </div>
                <div class="flex justify-between mt-3 text-[#121A2F] font-semibold">
                    <span>Total</span>
                    <span class="text-[#121A2F]">₦450</span>
                </div>
            </div>

            <!-- PIN Inputs -->
            <div class="flex justify-around mb-6">
                <input type="password" maxlength="1"
                    class="w-10 h-10 rounded-lg bg-[#0B1120] border border-[#1E2A55] text-center text-white focus:border-[#58a6ff] outline-none transition" />
                <input type="password" maxlength="1"
                    class="w-10 h-10 rounded-lg bg-[#0B1120] border border-[#1E2A55] text-center text-white focus:border-[#58a6ff] outline-none transition" />
                <input type="password" maxlength="1"
                    class="w-10 h-10 rounded-lg bg-[#0B1120] border border-[#1E2A55] text-center text-white focus:border-[#58a6ff] outline-none transition" />
                <input type="password" maxlength="1"
                    class="w-10 h-10 rounded-lg bg-[#0B1120] border border-[#1E2A55] text-center text-white focus:border-[#58a6ff] outline-none transition" />
            </div>

            <!-- Keypad -->
            <div class="grid grid-cols-3 gap-3">
                <button
                    class="bg-[#0B1120] rounded-xl py-3 text-xl font-semibold hover:bg-[#121A2F] hover:text-white transition">1</button>
                <button
                    class="bg-[#0B1120] rounded-xl py-3 text-xl font-semibold hover:bg-[#121A2F] hover:text-white transition">2</button>
                <button
                    class="bg-[#0B1120] rounded-xl py-3 text-xl font-semibold hover:bg-[#121A2F] hover:text-white transition">3</button>
                <button
                    class="bg-[#0B1120] rounded-xl py-3 text-xl font-semibold hover:bg-[#121A2F] hover:text-white transition">4</button>
                <button
                    class="bg-[#0B1120] rounded-xl py-3 text-xl font-semibold hover:bg-[#121A2F] hover:text-white transition">5</button>
                <button
                    class="bg-[#0B1120] rounded-xl py-3 text-xl font-semibold hover:bg-[#121A2F] hover:text-white transition">6</button>
                <button
                    class="bg-[#0B1120] rounded-xl py-3 text-xl font-semibold hover:bg-[#121A2F] hover:text-white transition">7</button>
                <button
                    class="bg-[#0B1120] rounded-xl py-3 text-xl font-semibold hover:bg-[#121A2F] hover:text-white transition">8</button>
                <button
                    class="bg-[#0B1120] rounded-xl py-3 text-xl font-semibold hover:bg-[#121A2F] hover:text-white transition">9</button>
                <button
                    class="bg-[#0B1120] rounded-xl py-3 text-lg text-[#58a6ff] font-semibold hover:bg-[#1E2A55] transition">Clear</button>
                <button
                    class="bg-[#0B1120] rounded-xl py-3 text-xl font-semibold hover:bg-[#121A2F] hover:text-white transition">0</button>
                <button
                    class="bg-[#0B1120] rounded-xl py-3 text-xl text-[#58a6ff] font-semibold hover:bg-[#1E2A55] transition">⌫</button>
            </div>

            <!-- Fingerprint -->
            <div class="flex justify-center mt-6">
                <div
                    class="w-12 h-12 rounded-full border border-[#58a6ff] flex items-center justify-center hover:bg-[#0F1B33] transition">
                    <i class="material-icons text-[#58a6ff]">fingerprint</i>
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>
