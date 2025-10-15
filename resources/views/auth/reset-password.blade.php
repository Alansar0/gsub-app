<x-layouts.app>
    <div class="font-['Roboto'] bg-[#0d1117] text-[#f0f6fc] flex flex-col items-center min-h-screen">
        <div class="w-4/5 mx-auto mt-8 flex flex-col items-center">
            <div class="bg-[#161b22] p-6 rounded-lg shadow-lg w-full mt-20 relative">
                <h4 class="text-2xl text-center font-semibold mb-2">Reset your password</h4>
                <p class="text-base text-[#8b949e] text-center mb-8">
                    Choose a new password to access your account.
                </p>

                <form method="POST" action="{{ route('password.update') }}" class="flex flex-col items-center space-y-4">
                    @csrf
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <!-- Email -->
                    <div class="w-11/12">
                        <input type="email" name="email" value="{{ old('email', $request->email) }}" placeholder="Email"
                            class="w-full px-5 py-3 border border-[#30363d] rounded-md bg-[#0d1117] text-[#f0f6fc] text-sm focus:outline-none focus:ring-1 focus:ring-[#58a6ff]" />
                    </div>

                    <!-- New Password -->
                    <div class="w-11/12 relative">
                        <input type="password" name="password" id="password"
                            placeholder="New password"
                            class="w-full px-5 py-3 border border-[#30363d] rounded-md bg-[#0d1117] text-[#f0f6fc] text-sm focus:outline-none focus:ring-1 focus:ring-[#58a6ff]" />
                        <span id="togglePassword"
                            class="material-icons absolute right-4 top-3.5 text-[#8b949e] cursor-pointer select-none text-lg">
                            visibility_off
                        </span>
                    </div>

                    <!-- Confirm Password -->
                    <div class="w-11/12 relative">
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            placeholder="Confirm password"
                            class="w-full px-5 py-3 border border-[#30363d] rounded-md bg-[#0d1117] text-[#f0f6fc] text-sm focus:outline-none focus:ring-1 focus:ring-[#58a6ff]" />
                        <span id="togglePasswordConfirm"
                            class="material-icons absolute right-4 top-3.5 text-[#8b949e] cursor-pointer select-none text-lg">
                            visibility_off
                        </span>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-11/12 py-3 bg-[#233249] text-[#f0f6fc] text-sm font-bold rounded-md hover:bg-[#2c4963] transition">
                        Reset Password →
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Toggle Password Visibility 👁️ for both fields
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const togglePasswordConfirm = document.getElementById('togglePasswordConfirm');
        const confirmPasswordInput = document.getElementById('password_confirmation');

        togglePassword.addEventListener('click', () => {
            const isPassword = passwordInput.type === 'password';
            passwordInput.type = isPassword ? 'text' : 'password';
            togglePassword.textContent = isPassword ? 'visibility' : 'visibility_off';
        });

        togglePasswordConfirm.addEventListener('click', () => {
            const isPassword = confirmPasswordInput.type === 'password';
            confirmPasswordInput.type = isPassword ? 'text' : 'password';
            togglePasswordConfirm.textContent = isPassword ? 'visibility' : 'visibility_off';
        });
    </script>
</x-layouts.app>
