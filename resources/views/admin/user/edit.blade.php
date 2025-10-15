<x-layouts.admin>
    <div class="min-h-screen bg-[#0d1117] text-[#f0f6fc] flex items-center justify-center px-4 py-8 font-['Inter']">
          <div class=" flex justify-start absolute top-6 left-6">
            <a href="{{ route('admin.dashboard') }}"><i class="material-icons">arrow_back</i></a>
        </div>
        <div class="w-full max-w-md bg-[#161b22] rounded-2xl shadow-lg p-6 border border-[#21262d]">


            <!-- Header -->
            <div class="flex items-center justify-center mb-6">
                <h2 class="text-xl font-semibold text-[#58a6ff]">✏️ Edit User Details</h2>
            </div>

            <!-- Success / Error Messages -->
            @if(session('success'))
                <div class="bg-green-600 text-white p-3 rounded-lg mb-3 text-center">{{ session('success') }}</div>
            @elseif(session('error'))
                <div class="bg-red-600 text-white p-3 rounded-lg mb-3 text-center">{{ session('error') }}</div>
            @endif

            <!-- Form -->
            <form action="{{ route('User.update', $user->id) }}" method="POST" class="space-y-5">
                @csrf
                @method('PATCH')

                <!-- Full Name -->
                <div>
                    <label for="full_name" class="block text-sm font-medium text-[#c9d1d9]">Full Name</label>
                    <input type="text" id="full_name" name="full_name" placeholder="Enter full name"
                        value="{{ old('full_name', $user->full_name ?? '') }}"
                        class="mt-1 block w-full rounded-md bg-[#0d1117] border border-[#30363d] text-[#f0f6fc]
                               focus:border-[#238636] focus:ring-2 focus:ring-[#238636] sm:text-sm p-2" />
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-[#c9d1d9]">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="Enter email address"
                        value="{{ old('email', $user->email ?? '') }}"
                        class="mt-1 block w-full rounded-md bg-[#0d1117] border border-[#30363d] text-[#f0f6fc]
                               focus:border-[#238636] focus:ring-2 focus:ring-[#238636] sm:text-sm p-2" />
                </div>

                <!-- Phone Number -->
                <div>
                    <label for="phone_number" class="block text-sm font-medium text-[#c9d1d9]">Phone Number</label>
                    <input type="tel" id="phone_number" name="phone_number" placeholder="000-000-0000"
                        value="{{ old('phone_number', $user->phone_number ?? '') }}"
                        class="mt-1 block w-full rounded-md bg-[#0d1117] border border-[#30363d] text-[#f0f6fc]
                               focus:border-[#238636] focus:ring-2 focus:ring-[#238636] sm:text-sm p-2" />
                </div>

                <!-- User Type (Readonly) -->
                <div>
                    <label for="role" class="block text-sm font-medium text-[#c9d1d9]">User Type</label>
                    <input type="text" id="role" name="role" value="{{ $user->role ?? '' }}" readonly
                        class="mt-1 block w-full rounded-md bg-[#161b22] border border-[#30363d] text-gray-400
                               sm:text-sm p-2" />
                </div>

                <!-- Buttons -->
                <div class="flex items-center justify-between pt-4">
                    <button type="submit"
                        class="px-4 py-2 bg-[#238636] hover:bg-[#2ea043] text-white rounded-md text-sm font-medium
                               transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-[#2ea043] focus:ring-offset-2 focus:ring-offset-[#0d1117]">
                        💾 Save Changes
                    </button>

                    <a href="{{ route('viewUser') }}"
                        class="px-4 py-2 bg-[#30363d] hover:bg-[#484f58] text-[#f0f6fc] rounded-md text-sm font-medium
                               transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-[#484f58] focus:ring-offset-2 focus:ring-offset-[#0d1117]">
                        ❌ Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-layouts.admin>
