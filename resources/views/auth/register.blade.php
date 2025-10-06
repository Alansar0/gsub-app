<x-layout>

    <div class="bg-[#0d1117] text-[#f0f6fc] font-['Roboto'] min-h-screen flex flex-col items-center p-4">
        <!-- Logo -->
        <div class="absolute top-4 left-6 flex items-center gap-2 font-bold text-lg">
            <img src="{{ Vite::asset('resources/images/logo.png') }}" alt="Welcome Image" class="w-8 h-8">
            <span class="text-white -ml-3">connect</span>
        </div>

        <!-- Right Section -->
        <div class="w-full max-w-md bg-[#161b22] py-6 px-6 mt-16 shadow-lg rounded-lg">
            <form method="POST" action="{{route('register')}}" class="space-y-4">
                @csrf
                <!-- Full Name & Email -->
                <div class="flex flex-col space-y-3">
                    <input type="text" name="full_name" id="full_name" :value="full_name"  value="{{ old('full_name') }}" placeholder="Full Name"
                        class="w-full px-3 py-2 border border-[#30363d] rounded-md bg-[#0d1117] text-sm text-[#f0f6fc] focus:outline-none focus:ring-1 focus:ring-[#58a6ff]" />
                    @error('full_name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    <input type="text" name="email" id="email" :value="email"  value="{{ old('email') }}" placeholder="Email Address"
                        class="w-full px-3 py-2 border border-[#30363d] rounded-md bg-[#0d1117] text-sm text-[#f0f6fc] focus:outline-none focus:ring-1 focus:ring-[#58a6ff]" />
                </div>
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
                <!-- Phone -->
                <input type="tel" :value="phone_number"  value="{{ old('phone_number') }}" placeholder="Phone_number" name="phone_number" id="phone_number"
                    class="w-full px-3 py-2 border border-[#30363d] rounded-md bg-[#0d1117] text-sm text-[#f0f6fc] focus:outline-none focus:ring-1 focus:ring-[#58a6ff]" />
                @error('phone_number')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
                <!-- Password -->
                <input type="password" :value="password"  value="{{ old('password') }}" placeholder="Password" name="password" id="password"
                    class="w-full px-3 py-2 border border-[#30363d] rounded-md bg-[#0d1117] text-sm text-[#f0f6fc] focus:outline-none focus:ring-1 focus:ring-[#58a6ff]" />
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
                <!-- Confirm Password -->
                <input type="password" :value="password"  value="{{ old('password') }}" placeholder="Confirm Password" name="password_confirmation"
                    id="password_confirmation"
                    class="w-full px-3 py-2 border border-[#30363d] rounded-md bg-[#0d1117] text-sm text-[#f0f6fc] focus:outline-none focus:ring-1 focus:ring-[#58a6ff]" />
                @error('password_confirmation')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror

                <!-- Location -->
                <select name="location" id="location" required
                    class="w-full px-3 py-2 border border-[#30363d] rounded-md bg-[#0d1117] text-sm text-[#f0f6fc] focus:outline-none focus:ring-1 focus:ring-[#58a6ff]">
                    <option value="" disabled selected>Select Location</option>
                    <option value="kano">Bachirawa</option>
                    <option value="lagos">R/lemo</option>
                    <option value="abuja">Kurna</option>
                    <option value="kaduna">K/ruwa</option>
                </select>
                @error('location')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror

                <!-- Button -->
                <button type="submit"
                    class="w-full py-3 bg-[#233249] text-[#f0f6fc] font-bold text-sm rounded-md hover:bg-[#2c4963] transition">
                    Continue →
                </button>

                <!-- Footer -->
                <div class="text-center text-xs mt-3">
                    Already have an account?
                    <a href="{{route('login')}}" class="text-[#58a6ff] hover:underline">Sign in</a>
                </div>
            </form>
        </div>

    </div>
</x-layout>
