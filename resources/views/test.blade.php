
<x-layouts.app>

<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-6">

    <!-- Dropdown 1 -->
    <div class="relative inline-block text-left bg-[#182430] rounded-xl p-4 shadow-md">
        <button id="userDropdown1"
            class="w-full inline-flex justify-between items-center text-sm font-medium text-[#f0f6fc] focus:outline-none">
            Users
            <svg class="w-5 h-5 ml-2 text-[#58a6ff]" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 9l-7 7-7-7" />
            </svg>
        </button>
        <div id="userMenu1"
            class="hidden absolute mt-2 w-56 rounded-lg shadow-lg bg-[#161b22] ring-1 ring-[#58a6ff]/40 divide-y divide-gray-700 z-50">
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
                <a href="{{ $whatsappUrl }}" target="_blank" class="block px-4 py-2 text-sm text-[#f0f6fc] hover:bg-[#182430]"> {{ $question->question }}</a>

            </div>
        </div>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
  // find all dropdown buttons that follow the pattern userDropdown1..N
  const buttons = Array.from(document.querySelectorAll('[id^="userDropdown"]'));
  const menus = buttons
    .map(btn => {
      const idx = btn.id.replace('userDropdown', '');
      return document.getElementById('userMenu' + idx);
    })
    .filter(Boolean);

  // toggle clicked menu, close the rest
  buttons.forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.stopPropagation();
      const idx = btn.id.replace('userDropdown', '');
      const menu = document.getElementById('userMenu' + idx);
      if (!menu) return;
      const wasHidden = menu.classList.contains('hidden');
      // close all menus
      menus.forEach(m => m.classList.add('hidden'));
      // open the clicked one if it was hidden
      if (wasHidden) menu.classList.remove('hidden');
    });
  });

  // prevent clicks inside menu from closing it
  menus.forEach(m => m.addEventListener('click', e => e.stopPropagation()));

  // click outside -> close all
  document.addEventListener('click', () => menus.forEach(m => m.classList.add('hidden')));

  // esc -> close all
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') menus.forEach(m => m.classList.add('hidden'));
  });
});
</script>
</x-layouts.app>

