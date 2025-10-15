<x-layouts.app>
    <div class="font-['Roboto'] bg-[#0d1117] text-[#f0f6fc] flex flex-col items-center min-h-screen">
        <div class="w-4/5 mx-auto mt-8 flex flex-col items-center">
            <!-- Logo -->
            <div class="flex items-center gap-2 font-bold text-lg absolute top-8 left-6 text-white">
                <img src="{{ Vite::asset('resources/images/logo.png') }}" alt="Welcome Image" class="w-10 h-10">
                <span>connect</span>
            </div>

            <!-- Login Card -->
            <div class="bg-[#161b22] px-6 py-8 rounded-lg shadow-lg w-full mt-20">
                <h4 class="text-2xl text-center font-semibold mb-2">Welcome back</h4>
                <p class="text-base text-[#8b949e] text-center mb-8">
                    Login to continue enjoying our seamless services
                </p>

                <form method="POST" action="{{ route('login') }}" class="flex flex-col items-center">
                    @csrf

                    <!-- Phone number -->
                    <div class="w-11/12 mb-4">
                        <input type="tel" name="login" id="login" placeholder="Phone number" value="{{ old('login') }}"
                            class="w-full px-5 py-3 border border-[#30363d] rounded-md bg-[#0d1117] text-[#f0f6fc] text-sm focus:outline-none focus:border-[#58a6ff]" />

                        @error('login')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="w-11/12 mb-4 relative">
                        <input type="password" name="password" id="password" placeholder="Password" value="{{ old('password') }}"
                            class="w-full px-5 py-3 border border-[#30363d] rounded-md bg-[#0d1117] text-[#f0f6fc] text-sm focus:outline-none focus:border-[#58a6ff]" />

                        <!-- 👁️ Toggle Icon -->
                        <span id="togglePassword"
                            class="material-icons absolute right-4 top-3.5 text-[#8b949e] cursor-pointer select-none text-lg">
                            visibility_off
                        </span>

                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-11/12 text-right mb-4">
                        <a href="{{ route('password.request') }}" class="text-[#58a6ff] text-xs hover:underline">
                            Forgot password?
                        </a>
                    </div>


                    <!-- Error Message -->
                    @if (session('error'))
                        <p class="text-red-500 text-sm text-center mb-3">
                            {{ session('error') }}
                        </p>
                    @endif

                    <!-- Button -->
                    <button type="submit"
                        class="w-11/12 py-3 bg-[#233249] text-[#f0f6fc] text-sm font-bold rounded-md cursor-pointer hover:bg-[#2c4963] transition">
                        Continue →
                    </button>

                    <!-- Footer -->
                    <div class="text-center text-xs mt-4">
                        Don’t have an account?
                        <a href="{{ route('register') }}" class="text-[#58a6ff] hover:underline">Sign up</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Toggle Password Visibility 👁️
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        togglePassword.addEventListener('click', () => {
            const isPassword = passwordInput.type === 'password';
            passwordInput.type = isPassword ? 'text' : 'password';
            togglePassword.textContent = isPassword ? 'visibility' : 'visibility_off';
        });
    </script>
</x-layouts.app>
