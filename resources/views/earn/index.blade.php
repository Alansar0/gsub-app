<x-layouts.app>
    <div class="min-h-screen bg-[#0d1117] text-[#f0f6fc] flex flex-col items-center justify-start font-['Roboto']">

        <!-- Back Button -->
        <div class="w-full flex justify-start mt-6 mb-4 px-6">
            <a href="{{ url()->previous() }}" class="text-[#58a6ff] hover:underline flex items-center">
                <i class="material-icons mr-1">arrow_back</i> Back
            </a>
        </div>

        <!-- Header Section -->
        <div
            class="relative w-full h-64 bg-cover bg-[center_top_9rem] rounded-b-3xl shadow-lg bg-[url('../images/mosque-bg-night.png')]">
            <div>
                <div class="absolute bottom-0 left-0 right-0 flex justify-center">
                    <div
                        class="bg-[#182430] border border-[#58a6ff]/20 shadow-xl rounded-2xl px-5 py-4 w-11/12 max-w-md ">

                        <div
                            class="bg-gradient-to-br from-[#182430] to-[#0C141C] rounded-2xl p-5 shadow-md text-[#f0f6fc]">
                            <!-- Header -->
                            <div class="flex justify-between items-center mb-4">
                                <h2 class="text-lg font-semibold text-[#58a6ff]">Rewards</h2>
                                <button class="text-[#58a6ff] hover:text-[#f0f6fc] transition">
                                    <i class="fas fa-ellipsis-h text-lg"></i>
                                </button>
                            </div>

                            <!-- Body -->
                            <div class="flex justify-between items-center">
                                <!-- Cashback -->
                                <div class="flex flex-col items-start">
                                    <p class="text-sm text-gray-400 flex items-center gap-1">
                                        Cashback
                                        <i class="fas fa-question-circle text-xs text-gray-500"></i>
                                    </p>
                                    <div class="flex items-center gap-2 mt-1">
                                        <div class="bg-yellow-500/20 p-1.5 rounded-full">
                                            <i class="fas fa-coins text-yellow-400"></i>
                                        </div>
                                        <p class="font-semibold text-base text-[#f0f6fc]">₦ {{ number_format($cashback, 2) }}</p>
                                        <i class="fas fa-chevron-right text-gray-500 text-sm"></i>
                                    </div>
                                </div>

                                <!-- Voucher -->
                                <div class="flex flex-col items-end">
                                    <p class="text-sm text-gray-400">Voucher</p>
                                    <div class="flex items-center gap-2 mt-1">
                                        <div
                                            class="bg-[#58a6ff]/20 p-1.5 rounded-md  dark:text-[#00FFD1] text-[#58a6ff]">
                                            <x-voucher> </x-voucher>
                                        </div>
                                        <p class="font-semibold text-base text-[#f0f6fc]">{{ $vouchers }}</p>
                                        <i class="fas fa-chevron-right text-gray-500 text-sm"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-center  absolute left-0 right-0  z-10">
                            <button onclick="window.location.href='{{ route('earn.makaranta.index') }}'"
                                class="bg-[#58a6ff] text-[#0d1117] px-8 py-2 rounded-xl shadow-md hover:bg-[#1f6feb] transition">
                                Earn More Vochers →
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Spacer -->
        <div class="h-16"></div>

        <!-- Options Section -->
        <div class="grid grid-cols-2 gap-4 px-6 mt-2 w-full max-w-md">
            <a href="{{ route('earn.morningAzkar') }}"
                class="bg-[#182430] border border-[#58a6ff]/20 rounded-xl p-4 text-center hover:shadow-md hover:shadow-[#58a6ff]/10 transition">
                <i class="fa-regular fa-sun text-[#58a6ff] text-2xl mb-2"></i>
                <p class="font-medium text-[#f0f6fc]">Morning Dhikr</p>
            </a>
            <a href="{{ route('earn.eveningAzkar') }}"
                class="bg-[#182430] border border-[#58a6ff]/20 rounded-xl p-4 text-center hover:shadow-md hover:shadow-[#58a6ff]/10 transition">
                <i class="fa-regular fa-moon text-[#58a6ff] text-2xl mb-2"></i>
                <p class="font-medium text-[#f0f6fc]">Evening Dhikr</p>
            </a>
            <a href="{{ route('earn.makaranta.index') }}"
                class="bg-[#182430] border border-[#58a6ff]/20 rounded-xl p-4 text-center hover:shadow-md hover:shadow-[#58a6ff]/10 transition">
                <i class="fas fa-book-open text-[#58a6ff] mb-2 text-4xl"></i>
                <p class="font-medium text-[#f0f6fc]">Makaranta</p>
            </a>
            <a href="{{ route('earn.friday', ['shafi' => 1]) }}"
                class="bg-[#182430] border border-[#58a6ff]/20 rounded-xl p-4 text-center hover:shadow-md hover:shadow-[#58a6ff]/10 transition">
                <i class="fas fa-mosque text-3xl text-[#58a6ff]  mb-2"></i>
                <p class="font-medium text-[#f0f6fc]">Friday Gifts</p>
            </a>
        </div>

        <!-- Hadith Section -->
        <div class="bg-[#182430] border border-[#58a6ff]/20 shadow-md rounded-2xl p-4 mt-6 mx-4 max-w-md">
            <h3 class="text-[#58a6ff] font-semibold mb-2">Hadith of the Day</h3>
            <p class="text-gray-300 text-sm leading-relaxed">
                The Prophet Muhammad ﷺ said: “Whoever says <span class="italic text-[#58a6ff]">Subhan Allah wa
                    bihamdihi</span> a hundred times a day,
                will be forgiven all his sins even if they were as much as the foam of the sea.”
            </p>
            <div class="flex justify-center mt-3">
                <button class="text-[#58a6ff] text-sm font-medium hover:underline">Refresh 🔄</button>
            </div>
        </div>
</x-layouts.app>
