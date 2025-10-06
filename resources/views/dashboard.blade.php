<x-layout>

    {{-- phone number:08012345678
    password:StrongPassword123!
    email:admin@example.com --}}

    {{-- phone number:08012345679
    password:password123!
    email:ahmad@gmail.com --}}


    <!-- Header -->
    <div class="w-full bg-[#101E2B] rounded-b-2xl p-2 sticky top-0 z-50 shadow-[0_0_15px_rgba(0,200,180,0.4)] flex flex-col">
        <div>
            <p class="mt-8 text-sm text-white/80">Hello,</p>
            <h1 class="text-xl font-semibold text-[#00E6C3] -mt-1">John Doe</h1>
        </div>
        <!-- Admin Panel Button -->
        @if (auth()->user()->role === 'admin')
        <div class="flex justify-center absolute top-8 left-10 transform translate-x-1/2 -translate-y-1/2">
            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-[#233249] text-white text-sm font-semibold rounded-md shadow hover:bg-[#2c4963] transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Admin Panel
            </a>
        </div>
        @endif
        <div>
            <button class="absolute top-12 right-8 bg-transparent border-none text-white text-xl cursor-pointer flex items-center">
                <span class="material-icons">notifications</span>
                <span class="absolute -top-2 -right-2 bg-red-600 rounded-full text-xs font-bold w-4 h-4 flex items-center justify-center">3</span>
            </button>
        </div>
    </div>

    <!-- Wallet Card -->
    <div class="mx-5 my-5 bg-gradient-to-br from-[#182430] to-[#0C141C] rounded-2xl p-8 text-white shadow-[0_0_15px_rgba(0,200,180,0.4)] flex justify-between">
        <div>
            <span class="text-lg text-white/70">Wallet Balance</span>
            <div class="text-2xl font-bold mt-1">₦50,000.00</div>
        </div>
        <div>
            <span class="text-lg text-white/70 flex items-center gap-1">Palmpay <i class="material-icons text-base text-[5px]">content_copy</i></span>
            <div class="mt-1 text-lg text-cyan-400">1234567890</div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-2 gap-3 mx-5 my-5">
        <div class="bg-white/3 border border-cyan-900/90 p-2 rounded-2xl text-center transition hover:bg-cyan-200/10 cursor-pointer">
            <div class="bg-[#1A1F26] border border-white/20 rounded-xl inline-block py-3 px-4.5 text-2xl text-cyan-300">
                <i class="fas fa-wallet text-4xl"></i>
            </div>
            <span class="block mt-2 text-sm">Fund Wallet</span>
        </div>
        <div class="bg-white/3 border border-cyan-900/90 p-2 rounded-2xl text-center transition hover:bg-cyan-200/10 cursor-pointer">
            <div class="bg-[#1A1F26] border border-white/20 rounded-xl inline-block py-3 px-4.5 text-2xl text-cyan-300">
                <i class="fas fa-ticket-alt text-4xl"></i>
            </div>
            <span class="block mt-2 text-sm">Get Vouchers</span>
        </div>
    </div>

    <!-- Voucher Cards Carousel -->
    <div class="max-w-md mx-5 my-5 mt-4">
        <div id="voucher-carousel" class="overflow-hidden">
            <div class="flex transition-transform duration-700" style="transform: translateX(0%)" id="voucher-track">
                <!-- Card 1 -->
                <div class="min-w-full px-2">
                    <div class="rounded-2xl bg-white/3 border border-white/15 p-2 shadow-[0_0_15px_rgba(0,200,180,0.4)]">
                        <div class="flex justify-between text-xs text-white/70">
                            <span>System: Wi‑Fi</span>
                            <span><i class="material-icons">wifi</i></span>
                        </div>
                        <div class="mt-3">
                            <div>Get a <span class="text-cyan-300 font-semibold">ABC123</span></div>
                            <div class="text-sm text-white/70">Voucher for ₦2,000</div>
                            <span><i class="material-icons text-[30px] text-cyan-400 !text-[70px] align-middle -mt-18 ml-45 z-10">portable_wifi_off</i></span>
                            <div class="mt-2 h-px bg-white/15"></div>
                        </div>
                        <div class="mt-2 text-xs text-white/60">Expires in 3 days</div>
                    </div>
                </div>
                <!-- Card 2 -->
                <div class="min-w-full px-2">
                    <div class="rounded-2xl bg-white/3 border border-white/15 p-2 shadow-[0_0_15px_rgba(1,200,180,0.4)]">
                        <div class="flex justify-between text-xs text-white/70">
                            <span>System: Data</span>
                            <span><i class="material-icons">data_usage</i></span>
                        </div>
                        <div class="mt-3">
                            <div>Get a <span class="text-cyan-300 font-semibold">XYZ789</span></div>
                            <div class="text-sm text-white/70">Voucher for ₦5,000</div>
                            <span><i class="material-icons text-[30px] text-cyan-400 !text-[70px] align-middle border-radius: 20px; -mt-18 ml-45 z-10">signal_cellular_alt</i></span>
                            <div class="mt-2 h-px bg-white/15"></div>
                        </div>
                        <div class="mt-2 text-xs text-white/60">Expires in 7 days</div>
                    </div>
                </div>
                <!-- Card 3 -->
                <div class="min-w-full px-2">
                    <div class="rounded-2xl bg-white/3 border border-white/15 p-2 shadow-[1_1_15px_rgba(0,200,180,0.4)]">
                        <div class="flex justify-between text-xs text-white/70">
                            <span>System: Airtime</span>
                            <span><i class="material-icons">phone_iphone</i></span>
                        </div>
                        <div class="mt-3">
                            <div>Get a <span class="text-cyan-300 font-semibold">LMN456</span></div>
                            <div class="text-sm text-white/70">Voucher for ₦1,000</div>
                            <span><i class="material-icons text-cyan-400 align-middle !text-[70px] border-radius: 20px; -mt-18 ml-45 z-10">phone_android</i></span>
                            <div class="mt-2 h-px bg-white/15"></div>
                        </div>
                        <div class="mt-2 text-xs text-white/60">Expires in 1 day</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Carousel Controls removed for auto-slide only -->
    </div>

    <script>
        const track = document.getElementById('voucher-track');
        let current = 0;
        const total = 3;
        function updateCarousel() {
            track.style.transform = `translateX(-${current * 100}%)`;
        }
        // Auto-slide every 3 seconds
        setInterval(() => {
            current = (current + 1) % total;
            updateCarousel();
        }, 3000);
    </script>

    <!-- Recent Transactions Section -->
    <div class="mx-5 my-5">
        <div class="flex justify-between items-center mb-3">
            <h2 class="text-lg text-[#00E6C3] m-0">Recent Transactions</h2>
            <a href="#" class="text-sm text-cyan-300 no-underline">View All</a>
        </div>
        <div class="bg-gradient-to-br from-[#182430] to-[#0C141C] border border-white/15 rounded-xl p-4 mb-3 shadow-[0_0_12px_rgba(0,200,180,0.4)] flex justify-between items-center">
            <div class="flex flex-col">
                <strong class="text-base text-white">John Doe</strong>
                <span class="text-xs text-white/60">Send Money</span>
            </div>
            <div class="text-right text-base font-bold text-red-400">
                -$96
                <small class="block text-xs text-white/50">20.01.2025</small>
            </div>
        </div>
        <div class="bg-gradient-to-br from-[#182430] to-[#0C141C] border border-white/15 rounded-xl p-4 mb-3 shadow-[0_0_12px_rgba(0,200,180,0.4)] flex justify-between items-center">
            <div class="flex flex-col">
                <strong class="text-base text-white">Bryan Pikato</strong>
                <span class="text-xs text-white/60">Requested Money</span>
            </div>
            <div class="text-right text-base font-bold text-green-400">
                +$190
                <small class="block text-xs text-white/50">18.01.2025</small>
            </div>
        </div>
        <div class="bg-gradient-to-br from-[#182430] to-[#0C141C] border border-white/15 rounded-xl p-4 mb-3 shadow-[0_0_12px_rgba(0,200,180,0.4)] flex justify-between items-center">
            <div class="flex flex-col">
                <strong class="text-base text-white">Dribbble</strong>
                <span class="text-xs text-white/60">Merchant Payment</span>
            </div>
            <div class="text-right text-base font-bold text-red-400">
                -$29.99
                <small class="block text-xs text-white/50">01.01.2025</small>
            </div>
        </div>
    </div>

    <!-- Bottom Navbar -->
    <div class="fixed bottom-5 left-2 right-2 bg-[#101E2B] rounded-2xl flex justify-around items-center py-2 shadow-[0_0_15px_rgba(0,200,180,0.4)] z-50">
        <div class="flex w-full justify-around">
            <!-- Active item -->
            <a href="{{route('dashboard')}}"  class="bg-[#00FFD1] text-[#101E2B] rounded-[40px] p-1.5 cursor-pointer">
                <i class="material-icons !text-[40px]">home</i>
            </a>
            <!-- Inactive items -->
            <a href="{{route('profile')}}"  class="text-white hover:bg-[#00FFD1] hover:text-[#101E2B] rounded-[40px] p-1.5 cursor-pointer">
                <i class="material-icons !text-[40px]">history</i>
            </a>
            <a href="{{route('profile')}}"  class="text-white hover:bg-[#00FFD1] hover:text-[#101E2B] rounded-[40px] p-1.5 cursor-pointer">
                <i class="material-icons !text-[40px]">support_agent</i>
            </a>
            <a href="{{route('profile')}}" class="text-white hover:bg-[#00FFD1] hover:text-[#101E2B] rounded-[40px] p-1.5 cursor-pointer">
                <i class="material-icons !text-[40px]">person</i>
            </a>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const navItems = document.querySelectorAll(".nav-item");
            navItems.forEach(item => {
                item.addEventListener("click", () => {
                    // Remove active class from all
                    navItems.forEach(i => {
                        i.classList.remove("bg-[#00FFD1]", "text-[#101E2B]");
                        i.classList.add("text-white");
                    });
                    // Add active class to clicked one
                    item.classList.remove("text-white");
                    item.classList.add("bg-[#00FFD1]", "text-[#101E2B]");
                });
            });
        });
    </script>
</x-layout>
