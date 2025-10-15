<x-layouts.app>
    <div class="font-['Roboto'] bg-[#0d1117] text-[#f0f6fc] flex flex-col items-center min-h-screen">
        <div class="w-4/5 mx-auto mt-8 flex flex-col items-center">
            <div class="bg-[#161b22] p-6 rounded-lg shadow-lg w-full mt-20">
                <h4 class="text-2xl text-center font-semibold mb-2">Forgot your password?</h4>
                <p class="text-base text-[#8b949e] text-center mb-8">
                    Enter your email to receive a password reset link.
                </p>

                @if (session('status'))
                    <div class="text-green-400 text-center text-sm mb-4">{{ session('status') }}</div>
                @endif

                <form method="POST" action="{{ route('password.email') }}" class="flex flex-col items-center">
                    @csrf
                    <div class="w-11/12 mb-4">
                        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}"
                            class="w-full px-5 py-3 border border-[#30363d] rounded-md bg-[#0d1117] text-[#f0f6fc] text-sm focus:outline-none focus:border-[#58a6ff]" />
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit"
                        class="w-11/12 py-3 bg-[#233249] text-[#f0f6fc] text-sm font-bold rounded-md cursor-pointer hover:bg-[#2c4963] transition">
                        Send Reset Link →
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
