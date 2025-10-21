
<x-layouts.admin>
    <div class="max-w-lg mx-auto bg-[#101E2B] text-white p-6 rounded-2xl shadow-[0_0_15px_rgba(0,255,209,0.4)] mt-10 border border-[#00FFD1]/30">

          <div class=" w-full flex justify-start mt-6 mb-4">
            <a href="{{ url()->previous() }}" class="text-[#58a6ff] hover:underline flex items-center">
                <i class="material-icons mr-1">arrow_back</i> Back
            </a>
        </div>
        <div class="w-full text-center -mt-1 p-4">
            <span class="text-2xl font-bold text-[#58a6ff] mb-6">
                🔐 Update User Password
            </span>
        </div>


        @if(session('success'))
            <div class="bg-[#00FFD1] text-[#101E2B] p-3 rounded mb-3 font-semibold text-center">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="bg-red-500 text-white p-3 rounded mb-3 font-semibold text-center">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('update.change.Password') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block mb-1 text-sm font-medium text-[#00FFD1]">Email or Phone Number</label>
                <input
                    type="text"
                    name="identifier"
                    class="w-full p-2.5 rounded-lg bg-[#0C1621] border border-[#00FFD1]/40 focus:ring-2 focus:ring-[#00FFD1] outline-none text-white placeholder-gray-400"
                    placeholder="Enter email or phone number"
                    required
                >
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-[#00FFD1]">New Password</label>
                <input
                    type="password"
                    name="new_password"
                    class="w-full p-2.5 rounded-lg bg-[#0C1621] border border-[#00FFD1]/40 focus:ring-2 focus:ring-[#00FFD1] outline-none text-white placeholder-gray-400"
                    placeholder="Enter new password"
                    required
                >
            </div>

            <button
                type="submit"
                class="w-full bg-[#00FFD1] hover:bg-[#00e0b8] text-[#101E2B] font-semibold p-2.5 rounded-xl transition-all duration-300 shadow-[0_0_10px_rgba(0,255,209,0.5)]"
            >
                Update Password
            </button>
        </form>
    </div>
</x-layouts.admin>
