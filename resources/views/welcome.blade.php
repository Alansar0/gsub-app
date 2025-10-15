<x-layouts.app>
 <div class="flex flex-col items-center min-h-screen">
         <!-- Top Background with Logo -->
    <div class="w-full h-[70vh] flex flex-col justify-center items-center text-white -mt-[30%] rounded-b-xl relative"
        style="background: url('{{ Vite::asset('resources/images/wellcomepagebg0.png') }}') no-repeat center center / cover;">
        <img src="{{ Vite::asset('resources/images/logo.png') }}" alt="Cool Data Plug Logo"
            class="w-40 h-40 -mt-[2%] relative z-10">
        <h2 class="absolute top-[60%] text-3xl font-bold tracking-wide z-20">Gconnect</h2>
    </div>

    <!-- Card Section -->
    <div class="bg-white w-[90%] -mt-20 rounded-2xl p-5 text-center shadow-md relative z-20 m-auto">
        <h3 class="text-lg font-semibold text-[#111] mb-2">Welcome to Gconnect</h3>
        <p class="text-sm text-[#555] mb-5">Discover unlimited internet access and enjoy wifii voucher-card.</p>

        <button onclick="window.location.href='{{ route('login') }}'"
            class="w-full py-3 mb-3 rounded-lg text-white font-bold text-base cursor-pointer bg-gradient-to-r from-[#101E2B] to-[#45494d]">
            Login
        </button>
        <button onclick="window.location.href='{{ route('register') }}'"
            class="w-full py-3 mb-3 rounded-lg font-bold text-base cursor-pointer border-2 border-[#aeafb0] text-[#101E2B] bg-transparent">
            Register
        </button>
        <!-- Social Media -->
        <div class="mt-4">
            <p class="text-sm text-[#333] mb-3">Explore us with</p>
            <div class="flex justify-center gap-4">
                <!-- NEW: Telegram -->
                <a href="#"
                    class="flex justify-center items-center w-11 h-11 rounded-lg bg-[#229ED9] text-white text-xl"><i
                        class="fa-brands fa-telegram"></i></a>
                <a href="#"
                    class="flex justify-center items-center w-11 h-11 rounded-lg bg-[#25D366] text-white text-xl"><i
                        class="fab fa-whatsapp"></i></a>
                <a href="#"
                    class="flex justify-center items-center w-11 h-11 rounded-lg bg-[#1877F2] text-white text-xl"><i
                        class="fab fa-facebook-f"></i></a>
                <!-- NEW: X (Twitter) -->
                <a href="#"
                    class="flex justify-center items-center w-11 h-11 rounded-lg bg-black text-white text-xl"><i
                        class="fa-brands fa-x-twitter"></i></a>
            </div>
        </div>

    </div>
 </div>
   </x-layouts.app>
