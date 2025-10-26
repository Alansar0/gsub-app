
<x-layouts.app>
<div class="min-h-screen bg-white text-gray-900 dark:bg-[#0d1117] dark:text-[#f0f6fc] p-6 font-['Roboto']">
    <div class="max-w-3xl mx-auto">
        <!-- Icon -->
        <div class="flex justify-center mb-4">
            <img src="https://cdn-icons-png.flaticon.com/512/1041/1041916.png" alt="Wi-Fi Icon" class="w-20 h-20">
        </div>

        <!-- Header -->
        <h1 class="text-2xl font-bold mb-6 text-center text-[#58a6ff]">
            💬 Contact Support
        </h1>

        <p class="text-center mb-8 text-gray-400">
            Choose a topic below and click your issue to contact our support via WhatsApp.
        </p>

        <!-- Dynamic Dropdown Topics -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @forelse ($topics as $index => $topic)
                <div class="relative inline-block text-left bg-[#182430] rounded-xl p-4 shadow-md w-full">
                    <!-- Topic Button -->
                    <button id="topicDropdown{{ $index }}"
                        class="w-full inline-flex justify-between items-center text-sm font-medium text-[#f0f6fc] focus:outline-none">
                        {{ $topic->title }}
                        <svg class="w-5 h-5 ml-2 text-[#58a6ff]" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <!-- Sub Questions Dropdown -->
                    <div id="topicMenu{{ $index }}"
                        class="hidden absolute mt-2 w-64 rounded-lg shadow-lg bg-[#161b22] ring-1 ring-[#58a6ff]/40 divide-y divide-gray-700 z-50">
                        <div class="py-1">
                            @foreach ($topic->subQuestions as $question)
                                @php
                                    $message = urlencode(
                                        "Hi, I am {$user->name} from Cool Data Plug with an email {$user->email}. " .
                                        "I have the following issue: {$question->question}. " .
                                        "Here is my number: {$user->phone}"
                                    );
                                    $whatsappUrl = "{$topic->whatsapp_link}?text={$message}";
                                @endphp
                                <a href="{{ $whatsappUrl }}" target="_blank"
                                   class="block px-4 py-2 text-sm text-[#f0f6fc] hover:bg-[#182430]">
                                   {{ $question->question }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-500">No support topics available right now.</p>
            @endforelse
        </div>
    </div>
</div>

<!-- Dropdown Toggle JS -->
<script>
document.addEventListener('DOMContentLoaded', () => {
  const buttons = Array.from(document.querySelectorAll('[id^="topicDropdown"]'));
  const menus = buttons
    .map(btn => {
      const idx = btn.id.replace('topicDropdown', '');
      return document.getElementById('topicMenu' + idx);
    })
    .filter(Boolean);

  buttons.forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.stopPropagation();
      const idx = btn.id.replace('topicDropdown', '');
      const menu = document.getElementById('topicMenu' + idx);
      if (!menu) return;
      const wasHidden = menu.classList.contains('hidden');
      menus.forEach(m => m.classList.add('hidden'));
      if (wasHidden) menu.classList.remove('hidden');
    });
  });

  menus.forEach(m => m.addEventListener('click', e => e.stopPropagation()));
  document.addEventListener('click', () => menus.forEach(m => m.classList.add('hidden')));
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') menus.forEach(m => m.classList.add('hidden'));
  });
});
</script>
</x-layouts.app>

