<x-layout>
    <div class="min-h-screen bg-gray-100 flex items-center justify-center px-4 py-8">
        <div class="w-full max-w-md bg-white rounded-xl shadow-md p-6">

            <!-- Header -->
            <div class="flex items-center justify-between mb-6">
                <a href="{{ route('profile.index') }}"
                   class="text-gray-500 hover:text-gray-700 transition">
                    <i class="material-icons">arrow_back</i>
                </a>
                <h2 class="text-lg font-semibold text-gray-800">Edit Profile</h2>
            </div>

            <!-- Form -->
            <form action="{{ route('profile.edit') }}" method="POST" class="space-y-5">
                @csrf
                @method('PATCH')

                <!-- Full Name -->
                <div>
                    <label for="full_name" class="block text-sm font-medium text-gray-700">Full Name</label>
                    <input type="text" id="full_name" name="full_name" placeholder="Enter your full name"
                        value="{{ old('full_name', Auth::user()->full_name ?? '') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                               focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email address"
                        value="{{ old('email', Auth::user()->email ?? '') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                               focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                </div>

                <!-- Phone Number -->
                <div>
                    <label for="phone_number" class="block text-sm font-medium text-gray-700">Phone Number</label>
                    <input type="tel" id="phone_number" name="phone_number" placeholder="000-000-0000"
                        value="{{ old('phone_number', Auth::user()->phone_number ?? '') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                               focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                </div>

                <!-- User Type (Readonly) -->
                <div>
                    <label for="user_type" class="block text-sm font-medium text-gray-700">User Type</label>
                    <input type="text" id="user_type" name="user_type" value="Student" readonly
                        class="mt-1 block w-full rounded-md border-gray-200 bg-gray-100
                               shadow-sm text-gray-600 sm:text-sm" />
                </div>


                <!-- Buttons -->
                <div class="flex items-center justify-between pt-4">
                    <button type="submit"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-md text-sm font-medium
                               hover:bg-indigo-700 focus:outline-none focus:ring-2
                               focus:ring-offset-2 focus:ring-indigo-500">
                        Save Changes
                    </button>

                    <a href="{{ route('profile.index') }}"
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md text-sm font-medium
                               hover:bg-gray-300 focus:outline-none focus:ring-2
                               focus:ring-offset-2 focus:ring-gray-400">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-layout>
