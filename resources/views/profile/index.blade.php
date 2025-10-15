
    <x-layouts.app>
            <div class=" bg-[#0d1117] text-[#e6edf3] font-sans flex flex-col w-full h-[100vh]">
                <div class="bg-[#161b22] rounded-xl shadow-lg w-[95%] h-[82vh] p-4 sm:p-6 md:p-8 mt-10 mx-auto">

                    <!-- Header -->
                    <h2 class="text-lg font-semibold mb-6 text-left text-[#58a6ff]">User Details</h2>

                    <!-- Profile Details -->
                    <div class="flex flex-col h-[60vh]">

                        <!-- Profile Picture -->
                        <div class="mx-auto mb-4 text-center">
                            <img src="{{ Vite::asset('resources/images/logo.png') }}" alt="Profile Picture"
                                class="w-17 h-17 rounded-full object-cover border-2 border-[#58a6ff]">
                        </div>

                        <!-- Details List -->
                        <div class="w-full ">
                            <div class="flex justify-between py-4 px-2 border-b border-[#30363d] text-sm">
                                <span class="text-[#8b949e] font-medium">Full Name</span>
                                <span>{{Auth::user()->full_name}}</span>
                            </div>
                            <div class="flex justify-between py-4 px-2 border-b border-[#30363d] text-sm">
                                <span class="text-[#8b949e] font-medium">Email</span>
                                <span>{{Auth::user()->email}}</span>
                            </div>
                            <div class="flex justify-between py-4 px-2 border-b border-[#30363d] text-sm">
                                <span class="text-[#8b949e] font-medium">Phone Number</span>
                                <span>{{Auth::user()->phone_number}}</span>
                            </div>
                             <div class="flex justify-between py-4 px-2 border-b border-[#30363d] text-sm">
                                <span class="text-[#8b949e] font-medium">User Type</span>
                                <span>{{Auth::user()->role}}</span>
                            </div>
                            <div class="flex justify-between py-4 px-2 border-b border-[#30363d] text-sm">
                                <span class="text-[#8b949e] font-medium">Location</span>
                                <span>{{Auth::user()->location}}</span>
                            </div>
                            <div class="flex justify-between py-4 px-2 border-b border-[#30363d] text-sm">
                                <span class="text-[#8b949e] font-medium">Date Joined</span>
                                <span>{{ Auth::user()->created_at->format('D M d Y H:i:s') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex justify-start mt-4">
                        {{-- <button
                            class="flex-1 text-center bg-[#238636] text-white rounded-lg py-2 text-sm mx-1 hover:bg-[#2ea043] transition">
                            <i class="fas fa-edit"></i> Edit
                        </button> --}}
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>

                        <button onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            class="flex-1 text-center bg-[#da3633] text-white rounded-lg py-2 text-sm mx-1 hover:bg-[#f85149] transition">
                            <i class="fas fa-power-off"></i> Log Out
                        </button>
                    </div>
                </div>
            </div>



    </x-layouts.app>
