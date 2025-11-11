<x-layouts.app>
    <div class="bg-[#0d0d0f] text-white min-h-screen font-sans py-2 px-4">
        <div class=" w-full flex justify-start mt-6 mb-4">
            <a href="{{ url()->previous() }}" class="text-[#58a6ff] hover:underline flex items-center">
                <i class="material-icons mr-1">arrow_back</i> Back
            </a>
        </div>
        <!-- Header -->
        <div class="text-center mt-6 mb-6">
            <div class="flex justify-center mb-4">
                <img src="https://cdn-icons-png.flaticon.com/512/2331/2331942.png" alt="Help Icon" class="w-20 h-20">
            </div>
            <h1 class="text-2xl font-bold text-[#58a6ff] mb-2">Get Your Voucher</h1>
            <p class="text-gray-300 text-sm leading-relaxed max-w-sm mx-auto">
                Purchase a data or Wi-Fi voucher easily and get your access code instantly.
                Stay connected — anytime, anywhere.
            </p>
        </div>

        <!-- Flash Sales Section -->
        <h2 class="text-white font-semibold text-lg mb-2">
            Flash Sales <span class="text-gray-400 text-sm">ℹ️</span>
        </h2>

        <!-- Flash Sales Carousel -->
        <div class="relative max-w-md mx-auto overflow-hidden rounded-2xl mb-8">
            <div id="flash-track" class="flex transition-transform duration-700 ease-in-out">
                <!-- Flash Card 1 -->
                <div class="min-w-full p-3">
                    <div class="bg-[#1b1b1f] rounded-2xl border border-gray-700 p-4">
                        <div class="flex justify-between items-center mb-1">
                            <p class="font-semibold text-white">1GB / 1 DAY</p>
                            <span class="bg-gray-600 text-xs px-2 py-1 rounded-md">Sold Out</span>
                        </div>
                        <div class="text-gray-400 text-sm line-through">₦500</div>
                        <div class="text-[#58a6ff] text-sm">₦10 | 98% OFF</div>
                        <div class="h-1 bg-[#58a6ff] mt-3 rounded-full"></div>
                    </div>
                </div>

                <!-- Flash Card 2 -->
                <div class="min-w-full p-3">
                    <div class="bg-[#1b1b1f] rounded-2xl border border-gray-700 p-4">
                        <div class="flex justify-between items-center mb-1">
                            <p class="font-semibold text-white">2GB / 3 DAYS</p>
                            <span class="bg-green-600 text-xs px-2 py-1 rounded-md">Active</span>
                        </div>
                        <div class="text-gray-400 text-sm line-through">₦1000</div>
                        <div class="text-[#58a6ff] text-sm">₦20 | 97% OFF</div>
                        <div class="h-1 bg-[#58a6ff] mt-3 rounded-full"></div>
                    </div>
                </div>

                <!-- Flash Card 3 -->
                <div class="min-w-full p-3">
                    <div class="bg-[#1b1b1f] rounded-2xl border border-gray-700 p-4">
                        <div class="flex justify-between items-center mb-1">
                            <p class="font-semibold text-white">500MB / 6 HRS</p>
                            <span class="bg-[#58a6ff]/40 text-xs px-2 py-1 rounded-md">Hot 🔥</span>
                        </div>
                        <div class="text-gray-400 text-sm line-through">₦300</div>
                        <div class="text-[#58a6ff] text-sm">₦5 | 99% OFF</div>
                        <div class="h-1 bg-[#58a6ff] mt-3 rounded-full"></div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            const flashTrack = document.getElementById('flash-track');
            let flashIndex = 0;
            const flashTotal = 3;

            function updateFlashCarousel() {
                flashTrack.style.transform = `translateX(-${flashIndex * 100}%)`;
            }

            setInterval(() => {
                flashIndex = (flashIndex + 1) % flashTotal;
                updateFlashCarousel();
            }, 3000);
        </script>

        <!-- Data Plans Grid -->
        <div class="grid grid-cols-3 gap-3">
            @for ($i = 0; $i < 9; $i++)
                <div class="bg-[#1b1b1f] rounded-xl p-4 flex flex-col text-center border border-gray-700 h-full">
                    {{-- <p class="text-white font-bold text-lg">150<span class="text-sm font-normal">MB</span></p> --}}
                    <p class="font-semibold text-white">1VCH/6HRS</p>
                    <p class="text-gray-300 text-sm mb-4">₦200</p>

                    <a href="{{ route('getVocher.paycheckout') }}"
                        class="mt-auto flex justify-between items-center border border-[#58a6ff] rounded-lg px-4 py-2 text-lg text-[#58a6ff] font-medium hover:bg-[#58a6ff]/10 transition-all">
                        <span>Get</span>
                        <i class="material-icons">chevron_right</i>
                    </a>
                </div>
            @endfor
        </div>

    </div>
</x-layouts.app>
