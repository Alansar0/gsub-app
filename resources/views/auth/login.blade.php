

    <x-layout>
    <div class="font-['Roboto'] bg-[#0d1117] text-[#f0f6fc] flex flex-col items-center min-h-screen">
        <div class="w-4/5 mx-auto mt-8 flex flex-col items-center">
            <!-- Logo -->
            <div class="flex items-center gap-2 font-bold text-lg absolute top-8 left-6 text-white">
                <img src="{{ Vite::asset('resources/images/logo.png') }}" alt="Welcome Image" class="w-10 h-10">
                <span>connect</span>
            </div>

            <!-- Right Section -->
            <div class="bg-[#161b22] p-6 rounded-lg shadow-lg w-full mt-20">
                <h4 class="text-2xl text-center font-semibold mb-2">Welcome back</h4>
                <p class="text-base text-[#8b949e] text-center mb-8">Login to continue enjoying our seamless services</p>

                <form  method="POST" action="{{route('login')}}" class="flex flex-col items-center">
                    @csrf
                    <!-- Phone number -->
                    <div class="w-11/12 mb-4">
                        <input type="tel" name="login" id="login" placeholder="Phone number"
                            class="w-full px-5 py-3 border border-[#30363d] rounded-md bg-[#0d1117] text-[#f0f6fc] text-sm focus:outline-none focus:border-[#58a6ff]" />
                    </div>
                    @error('login')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    <!-- Password -->
                    <div class="w-11/12 mb-4">
                        <input type="password" name="password" id="password" placeholder="Password"
                            class="w-full px-5 py-3 border border-[#30363d] rounded-md bg-[#0d1117] text-[#f0f6fc] text-sm focus:outline-none focus:border-[#58a6ff]" />
                    </div>
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror

                    <!-- Button -->
                    <button type="submit"
                        class="w-11/12 py-3 bg-[#233249] text-[#f0f6fc] text-sm font-bold rounded-md cursor-pointer hover:bg-[#2c4963] transition">
                        Continue →
                    </button>

                    <!-- Footer -->
                    <div class="text-center text-xs mt-4">
                        Don’t have an account? <a href="#" class="text-[#58a6ff] hover:underline">Sign up</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </x-layout>
