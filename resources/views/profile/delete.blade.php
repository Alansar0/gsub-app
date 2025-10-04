<x-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">
        <div class="bg-white rounded-lg shadow-lg max-w-sm w-full p-6">

            <!-- Warning Icon -->
            <div class="flex justify-center mb-4">
                <div class="bg-red-100 w-14 h-14 flex items-center justify-center rounded-full">
                    <i class="material-icons text-red-500 text-3xl">warning</i>
                </div>
            </div>

            <!-- Title -->
            <h2 class="text-xl font-semibold text-gray-800 text-center mb-2">Delete Account</h2>

            <!-- Message -->
            <p class="text-gray-600 text-center text-sm mb-6">
                You're going to delete your account. Are you sure?
            </p>

            <!-- Buttons -->
            <div class="flex justify-between gap-3">
                <a href="{{ route('profile0.index') }}"
                   class="flex-1 px-4 py-2 bg-teal-600 text-white text-sm font-medium
                          rounded-md text-center hover:bg-teal-700 transition">
                    No, Keep it
                </a>

                <form action="{{ route('profile.delete') }}" method="POST" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="w-full px-4 py-2 bg-red-600 text-white text-sm font-medium
                               rounded-md hover:bg-red-700 transition">
                        Yes, Delete it!
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-layout>
