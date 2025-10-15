<div class="min-h-screen bg-[#0d1117] text-[#f0f6fc] p-8 font-['Inter']">
    <h1 class="text-2xl font-bold mb-6 text-[#58a6ff]">Support Center Management</h1>

    <!-- Add Form -->
    <form method="POST" action="{{ route('admin.support.store') }}" class="bg-[#182430] rounded-xl p-6 max-w-2xl mx-auto">
        @csrf

        <div class="mb-4">
            <label class="block text-sm mb-2">Category Title</label>
            <input type="text" name="title" class="w-full bg-[#0C141C] border border-gray-700 rounded-lg p-2 focus:ring-2 focus:ring-[#58a6ff]" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm mb-2">Default WhatsApp Link</label>
            <input type="url" name="default_whatsapp_link" placeholder="https://wa.me/234XXXXXXXXXX" class="w-full bg-[#0C141C] border border-gray-700 rounded-lg p-2 focus:ring-2 focus:ring-[#58a6ff]">
        </div>

        <div class="mb-4">
            <label class="block text-sm mb-2">Sub-Questions</label>
            <div id="questions-wrapper" class="space-y-2">
                <input type="text" name="questions[]" class="w-full bg-[#0C141C] border border-gray-700 rounded-lg p-2 focus:ring-2 focus:ring-[#58a6ff]" placeholder="Enter a question">
            </div>

            <button type="button" id="add-question" class="mt-2 text-[#58a6ff] text-sm hover:underline">+ Add another question</button>
        </div>

        <button type="submit" class="w-full py-2 bg-gradient-to-r from-[#58a6ff] to-[#1f6feb] rounded-lg font-semibold hover:opacity-90">
            Save Support Category
        </button>
    </form>

    <!-- Display -->
    <div class="mt-10 max-w-3xl mx-auto">
        <h2 class="text-xl mb-4 font-semibold">Existing Support Categories</h2>
        @foreach($categories as $category)
            <div class="bg-[#182430] p-4 mb-4 rounded-xl">
                <h3 class="text-[#58a6ff] font-medium mb-2">{{ $category->title }}</h3>
                <ul class="list-disc pl-6 text-sm text-gray-300">
                    @foreach($category->questions as $q)
                        <li>{{ $q->question }}</li>
                    @endforeach
                </ul>
                <p class="text-xs mt-2 text-gray-400">WhatsApp: {{ $category->default_whatsapp_link ?? 'Not set' }}</p>
            </div>
        @endforeach
    </div>
</div>

<script>
    document.getElementById('add-question').addEventListener('click', function() {
        const wrapper = document.getElementById('questions-wrapper');
        const input = document.createElement('input');
        input.type = 'text';
        input.name = 'questions[]';
        input.className = 'w-full bg-[#0C141C] border border-gray-700 rounded-lg p-2 focus:ring-2 focus:ring-[#58a6ff]';
        input.placeholder = 'Enter a question';
        wrapper.appendChild(input);
    });
</script>
