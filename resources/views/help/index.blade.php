<x-layouts.app>

<div class="min-h-screen bg-white text-gray-900 dark:bg-[#0f172a] dark:text-white p-6">
    <div class="max-w-3xl mx-auto">
        <div class="flex justify-center mb-4">
         <img src="https://cdn-icons-png.flaticon.com/512/1041/1041916.png"alt="Wi-Fi Icon" class="w-20 h-20">

        </div>
        <h1 class="text-2xl font-bold mb-6 text-center text-[#2563eb] dark:text-[#58a6ff]">
            💬 Contact Support
        </h1>

        <p class="text-center mb-8 text-gray-600 dark:text-gray-300">
            Choose a topic below and click your issue to contact our support via WhatsApp.
        </p>

        @forelse ($topics as $topic)
            <div class="bg-gray-100 dark:bg-[#1e293b] rounded-xl p-5 mb-6 shadow">
                <h2 class="text-lg font-semibold mb-3 text-[#2563eb] dark:text-[#58a6ff]">
                    {{ $topic->title }}
                </h2>
                <ul class="space-y-2">
                    @foreach ($topic->subQuestions as $question)
                        @php
                            $message = urlencode(
                                "Hi, I am {$user->name} from Cool Data Plug with an email {$user->email}. " .
                                "I have the following issue: {$question->question}. " .
                                "Here is my number: {$user->phone}"
                            );
                            $whatsappUrl = "{$topic->whatsapp_link}?text={$message}";
                        @endphp
                        <li>
                            <a href="{{ $whatsappUrl }}" target="_blank"
                               class="block px-4 py-2 rounded-lg bg-[#2563eb] dark:bg-[#58a6ff] hover:bg-[#1d4ed8] dark:hover:bg-[#3b82f6] text-white text-sm transition">
                                {{ $question->question }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @empty
            <p class="text-center text-gray-500">No support topics available right now.</p>
        @endforelse
    </div>
</div>

</x-layouts.app>
