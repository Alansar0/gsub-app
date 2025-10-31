<x-layouts.app>
    <div class="min-h-screen bg-[#0B141A] text-white flex flex-col items-center font-sans">

        <!-- Flash Modal -->
        <div id="flashModal" class="fixed inset-0 flex items-center justify-center z-50 hidden">
            <div class="bg-black/60 absolute inset-0"></div>
            <div class="relative bg-white text-black rounded-lg p-6 max-w-sm w-full shadow-lg">
                <h3 id="flashTitle" class="text-lg font-bold mb-2"></h3>
                <p id="flashMessage" class="mb-4"></p>
                <div class="text-right">
                    <button id="flashClose" class="px-4 py-2 bg-[#58a6ff] text-[#0f172a] rounded font-semibold">Close</button>
                </div>
            </div>
        </div>

        {{-- HEADER --}}
        <header
            class="fixed top-0 left-0 right-0 z-40 bg-[#182430] border-b border-[#233044] shadow-[0_0_15px_rgba(88,166,255,0.25)]">
            <div class="text-center py-4 relative">
                <a href="{{ url()->previous() }}"
                    class="absolute left-6 top-1/2 -translate-y-1/2 text-[#58a6ff] hover:underline flex items-center">
                    <i class="material-icons mr-1 text-[#58a6ff]">arrow_back</i>
                    Back
                </a>
                <h1 class="text-white text-xl font-semibold tracking-wide">Makaranta</h1>
            </div>

            {{-- Switcher --}}
            <div
                class="w-[65vw] mx-auto p-1 flex items-center justify-between bg-[#0C141C] rounded-full border border-[#00FFD1]/50 shadow-[0_0_20px_rgba(0,255,209,0.4)] mb-3 transition-all">
                <button id="btnSauraro" onclick="window.location.href='{{ route('makaranta.darasi') }}'"
                    class="flex-1 py-2 text-sm font-semibold rounded-full text-[#f0f6fc]
        {{ request()->routeIs('darasi.sauraro') ? 'bg-[#00FFD1]/30' : 'hover:bg-[#00FFD1]/20' }} transition-all">
                    🎧 Sauraro
                </button>

                <button id="btnKaranta" onclick="window.location.href='{{ route('makaranta.karanta', ['pageId' => $page['page'] ?? 1]) }}'"
                    class="flex-1 py-2 text-sm font-semibold rounded-full text-[#f0f6fc]
        {{ request()->routeIs('darasi.karanta') ? 'bg-[#00FFD1]/30' : 'hover:bg-[#00FFD1]/20' }} transition-all">
                    📖 Karanta
                </button>
            </div>
        </header>

        {{-- MAIN CONTENT --}}
        <section class="flex-grow w-full px-6 py-4 mt-[110px] max-w-3xl">
            {{-- Reading Content with Swipe Container --}}
            <div id="readerWrapper" class="touch-pan-x">
                <div class="bg-[#161b22] p-6 rounded-2xl shadow-lg border border-[#233044] mb-6">
                    <h2 class="text-[#58a6ff] text-lg font-bold mb-2">{{ $page['header'] ?? 'Lesson Title' }}</h2>
                    <p id="reader" class="text-[#f0f6fc]/90 leading-relaxed whitespace-pre-line">{{ $page['content'] ?? 'Lesson content goes here.' }}</p>
                </div>
            </div>
            
            {{-- Quiz Section --}}
            <div id="quizContainer" class="hidden transition-all duration-500 opacity-0">
                <div class="bg-[#182430] p-6 rounded-2xl border border-[#233044] shadow-[0_0_15px_#58a6ff40]">
                    <h3 class="text-[#58a6ff] text-lg font-bold mb-4">🧠 Quick Quiz</h3>
                    @if (!empty($quizzes))
                @php
                    $randomTwo = collect($quizzes)->shuffle()->take(2);
                @endphp
                <form action="{{ route('quiz.submit', ['pageId' => $page['page']]) }}" method="POST">
                    @csrf
                    @foreach ($randomTwo as $index => $quiz)
                        <div class="mb-4">
                            <p class="mb-2 font-semibold">{{ $index + 1 }}. {{ $quiz['question'] }}</p>
                            @foreach ($quiz['options'] as $i => $opt)
                                <label class="block mb-1">
                                    <input type="radio" name="quiz{{ $index }}" value="{{ $i }}" required>
                                    {{ $opt }}
                                </label>
                            @endforeach
                        </div>
                    @endforeach

                    <div class="text-center mt-6">
                        <button type="submit"
                            class="bg-[#58a6ff] text-[#0f172a] px-5 py-2 rounded-xl font-semibold hover:scale-105 transition">
                            Submit Answers
                        </button>
                    </div>
                </form>

                @else
                    <p class="text-gray-400 text-center">No quiz available for this lesson yet.</p>
                @endif
            </div>
        </section>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const readerWrapper = document.getElementById('readerWrapper');
            const reader = document.getElementById('reader');
            const quizContainer = document.getElementById('quizContainer');
            let startX = 0;
            let currentPageId = {{ $page['page'] ?? 1 }};
            let scrollTimeout;
            let quizShown = false;

            // Function to show quiz
            function showQuiz() {
                if (!quizShown && quizContainer) {
                    quizContainer.classList.remove('hidden');
                    // Small delay to trigger fade in
                    setTimeout(() => {
                        quizContainer.classList.remove('opacity-0');
                    }, 50);
                    quizShown = true;
                }
            }

            // Show quiz after 45 seconds of reading
            const readingTimer = setTimeout(showQuiz, 45000);

            // Show quiz when user reaches bottom of content
            document.addEventListener('scroll', () => {
                clearTimeout(scrollTimeout);
                scrollTimeout = setTimeout(() => {
                    const bottom = window.innerHeight + window.pageYOffset >= document.documentElement.scrollHeight - 100;
                    if (bottom) {
                        showQuiz();
                    }
                }, 100);
            });

            // Touch events for swipe navigation
            readerWrapper.addEventListener('touchstart', e => {
                startX = e.touches[0].clientX;
            });

            readerWrapper.addEventListener('touchend', e => {
                const endX = e.changedTouches[0].clientX;
                const diff = startX - endX;

                if (Math.abs(diff) > 50) { // Only navigate if swipe is significant
                    // Clear the reading timer if user navigates away
                    clearTimeout(readingTimer);

                    // Swipe right to go to previous page
                    if (diff < -50 && currentPageId > 1) {
                        window.location.href = '{{ route('makaranta.karanta', ['pageId' => 1]) }}'.replace('/1', '/' + (currentPageId - 1));
                    }
                    // Swipe left to go to next page
                    else if (diff > 50) {
                        window.location.href = '{{ route('makaranta.karanta', ['pageId' => 1]) }}'.replace('/1', '/' + (currentPageId + 1));
                    }
                }
            });

            // Flash messages from server (quiz result)
            const flashMsg = @json(session('success') ?? null);
            const flashErr = @json(session('error') ?? null);
            const flashModal = document.getElementById('flashModal');
            const flashTitle = document.getElementById('flashTitle');
            const flashMessage = document.getElementById('flashMessage');
            const flashClose = document.getElementById('flashClose');

            function showFlash(type, msg) {
                if (!flashModal) return;
                flashTitle.textContent = type === 'success' ? 'Congratulations!' : 'Oops!';
                flashMessage.textContent = msg || (type === 'success' ? 'You passed the quiz.' : 'Please read again and try.');
                // style title
                if (type === 'success') {
                    flashTitle.classList.remove('text-red-600');
                    flashTitle.classList.add('text-green-600');
                } else {
                    flashTitle.classList.remove('text-green-600');
                    flashTitle.classList.add('text-red-600');
                }
                flashModal.classList.remove('hidden');
                // auto-hide after 8s
                setTimeout(() => {
                    flashModal.classList.add('hidden');
                }, 8000);
            }

            if (flashMsg) showFlash('success', flashMsg);
            if (flashErr) showFlash('error', flashErr);

            if (flashClose) flashClose.addEventListener('click', () => flashModal.classList.add('hidden'));
        });
    </script>
</x-layouts.app>
