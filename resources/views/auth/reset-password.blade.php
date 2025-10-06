<x-layout>
    <div class="font-['Roboto'] bg-[#0d1117] text-[#f0f6fc] flex flex-col items-center min-h-screen">
        <div class="w-4/5 mx-auto mt-8 flex flex-col items-center">
            <div class="bg-[#161b22] p-6 rounded-lg shadow-lg w-full mt-20">
                <h4 class="text-2xl text-center font-semibold mb-2">Reset your password</h4>
                <p class="text-base text-[#8b949e] text-center mb-8">
                    Choose a new password to access your account.
                </p>

                <form method="POST" action="{{ route('password.store') }}" class="flex flex-col items-center">
                    @csrf
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                    <div class="w-11/12 mb-4">
                        <input type="email" name="email" value="{{ old('email', $request->email) }}" placeholder="Email"
                            class="w-full px-5 py-3 border border-[#30363d] rounded-md bg-[#0d1117] text-[#f0f6fc] text-sm focus:outline-none focus:border-[#58a6ff]" />
                    </div>
                    <div class="w-11/12 mb-4">
                        <input type="password" name="password" placeholder="New password"
                            class="w-full px-5 py-3 border border-[#30363d] rounded-md bg-[#0d1117] text-[#f0f6fc] text-sm focus:outline-none focus:border-[#58a6ff]" />
                    </div>
                    <div class="w-11/12 mb-4">
                        <input type="password" name="password_confirmation" placeholder="Confirm password"
                            class="w-full px-5 py-3 border border-[#30363d] rounded-md bg-[#0d1117] text-[#f0f6fc] text-sm focus:outline-none focus:border-[#58a6ff]" />
                    </div>
                    <button type="submit"
                        class="w-11/12 py-3 bg-[#233249] text-[#f0f6fc] text-sm font-bold rounded-md cursor-pointer hover:bg-[#2c4963] transition">
                        Reset Password →
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-layout>
