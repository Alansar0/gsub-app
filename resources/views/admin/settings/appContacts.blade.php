<x-layouts.app>

    <div class="min-h-screen bg-[#0f172a] text-white p-6">

        <div class=" w-full flex justify-start mt-6 mb-4">
            <a href="{{ url()->previous() }}" class="text-[#58a6ff] hover:underline flex items-center">
                <i class="material-icons mr-1">arrow_back</i> Back
            </a>
        </div>

        <h1 class="text-2xl font-bold mb-6 text-[#58a6ff]">Support Topics & Contact Setup</h1>

        {{-- Add / Edit Topic --}}
        <div class="bg-[#1e293b] p-6 rounded-xl shadow mb-8">
            <h2 class="text-lg font-semibold mb-3 text-[#58a6ff]">Add Support Topic</h2>

            <form action="{{ route('admin.settings.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block mb-1">Topic Title</label>
                    <input type="text" name="title"
                        class="w-full p-2 rounded bg-[#0f172a] border border-gray-600 text-white" required>
                </div>

                <div>
                    <label class="block mb-1">WhatsApp Contact Link</label>
                    <input type="text" name="whatsapp_link" placeholder="https://wa.me/234XXXXXXXXXX"
                        class="w-full p-2 rounded bg-[#0f172a] border border-gray-600 text-white" required>
                </div>

                <button class="bg-[#2563eb] hover:bg-[#1d4ed8] px-4 py-2 rounded text-white font-medium">
                    Add Topic
                </button>
            </form>
        </div>

        {{-- Add Sub Question --}}
        <div class="bg-[#1e293b] p-6 rounded-xl shadow mb-8">
            <h2 class="text-lg font-semibold mb-3 text-[#58a6ff]">Add Sub-Question</h2>

            <form action="{{ route('settings.sub.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block mb-1">Select Topic</label>
                    <select name="support_topic_id"
                        class="w-full p-2 rounded bg-[#0f172a] border border-gray-600 text-white" required>
                        <option value="">-- Choose Topic --</option>
                        @foreach ($topics as $topic)
                            <option value="{{ $topic->id }}">{{ $topic->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block mb-1">Question Text</label>
                    <input type="text" name="question"
                        class="w-full p-2 rounded bg-[#0f172a] border border-gray-600 text-white" required>
                </div>

                <button class="bg-[#10b981] hover:bg-[#059669] px-4 py-2 rounded text-white font-medium">
                    Add Sub-Question
                </button>
            </form>
        </div>

        {{-- Existing Topics --}}
        <div class="max-w-4xl mx-auto">
            <h2 class="text-xl mb-4 font-semibold text-[#58a6ff]">Existing Topics</h2>
            @foreach ($topics as $topic)
                <div class="bg-[#182430] p-5 mb-4 rounded-xl border border-gray-700">
                    <h3 class="text-lg font-bold mb-2 text-[#58a6ff]">{{ $topic->title }}</h3>
                    <p class="text-sm text-gray-400 mb-2">WhatsApp: {{ $topic->whatsapp_link }}</p>

                    <ul class="list-disc pl-6 text-sm text-gray-300">
                        @foreach ($topic->subQuestions as $q)
                            <li>{{ $q->question }}</li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </div>

</x-layouts.app>
