<x-layouts.admin>
    <div class="bg-[#101E2B] min-h-screen text-white p-6 rounded-2xl shadow-lg">

          <div class=" w-full flex justify-start mt-6">
            <a href="{{ route('admin.dashboard') }}"><i class="material-icons">arrow_back</i></a>
        </div>
        <div class="w-full text-start -mt-1 p-4">
            <span class="text-2xl font-bold text-[#58a6ff] mb-6">
                👥 All Users
            </span>
        </div>

        {{-- <h1 class="text-2xl font-bold mb-6 text-[#00FFD1]">👥 All Users</h1> --}}

        <!-- Search Form -->
        <form method="GET" action="{{ route('viewUser') }}" class="flex mb-6">
            <input type="text" name="search" placeholder="Search by Email or Phone" value="{{ request('search') }}"
                class="flex-1 p-3 rounded-l-lg bg-[#0C1621] border border-[#00FFD1]/40 text-white placeholder-gray-400 focus:ring-2 focus:ring-[#00FFD1] outline-none">
            <button type="submit"
                class="bg-[#00FFD1] text-[#101E2B] px-5 rounded-r-lg font-semibold hover:bg-[#00e0b8]">
                Search
            </button>
        </form>

        <!-- Flash Messages -->
        @if (session('success'))
            <div class="bg-[#00FFD1] text-[#101E2B] p-3 rounded mb-3 font-semibold">{{ session('success') }}</div>
        @elseif(session('error'))
            <div class="bg-red-500 text-white p-3 rounded mb-3 font-semibold">{{ session('error') }}</div>
        @endif

        <!-- Users Table -->
        <div class="overflow-x-auto bg-[#0C1621] rounded-xl border border-[#00FFD1]/20 shadow-lg">
            <table class="w-full border-collapse">
                <thead class="bg-[#00FFD1]/10 text-[#00FFD1]">
                    <tr>
                        <th class="py-3 px-4 text-left">#</th>
                        <th class="py-3 px-4 text-left">Full Name</th>
                        <th class="py-3 px-4 text-left">Email</th>
                        <th class="py-3 px-4 text-left">Phone</th>
                        <th class="py-3 px-4 text-left">Role</th>
                        <th class="py-3 px-4 text-left">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $index => $user)
                        <tr class="border-b border-[#00FFD1]/10 hover:bg-[#00FFD1]/5 transition">
                            <td class="py-3 px-4">{{ $loop->iteration }}</td>
                            <td class="py-3 px-4">{{ $user->full_name }}</td>
                            <td class="py-3 px-4">{{ $user->email }}</td>
                            <td class="py-3 px-4">{{ $user->phone_number }}</td>
                            <td class="py-3 px-4 capitalize">{{ $user->role }}</td>
                            <td class="py-3 px-4 flex space-x-2">
                                <a href="{{ route('User.edit', $user->id) }}"
                                    class="bg-[#00FFD1] text-[#101E2B] px-3 py-1 rounded-lg font-semibold hover:bg-[#00e0b8] transition">
                                    Edit
                                </a>

                                <!-- Delete Button -->
                                <button type="button"
                                    onclick="openDeleteModal('{{ $user->id }}', '{{ $user->full_name }}')"
                                    class="bg-red-500 text-white px-3 py-1 rounded-lg font-semibold hover:bg-red-600 transition">
                                    Delete
                                </button>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-gray-400">No users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>


    <!-- Delete Confirmation Modal -->
<div id="deleteModal" class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50">
    <div class="bg-[#0C1621] border border-[#00FFD1]/30 rounded-2xl p-6 shadow-2xl w-[90%] max-w-md text-center text-white">
        <h2 class="text-xl font-bold mb-2 text-[#00FFD1]">⚠️ Confirm Delete</h2>
        <p id="deleteMessage" class="text-gray-300 mb-6">Are you sure you want to delete this user?</p>

        <div class="flex justify-center gap-4">
            <button
                onclick="closeDeleteModal()"
                class="bg-gray-600 hover:bg-gray-500 px-4 py-2 rounded-lg font-semibold">
                Cancel
            </button>

            <form id="deleteForm" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded-lg font-semibold text-white">
                    Yes, Delete
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    function openDeleteModal(userId, userName) {
        const modal = document.getElementById('deleteModal');
        const message = document.getElementById('deleteMessage');
        const form = document.getElementById('deleteForm');

        message.textContent = `Are you sure you want to delete "${userName}"?`;
        form.action = `{{ url('admin/users/viewUser') }}/${userId}`;
        modal.classList.remove('hidden');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }
</script>

</x-layouts.admin>
