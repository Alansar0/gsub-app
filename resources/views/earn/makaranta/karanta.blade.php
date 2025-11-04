

<x-layouts.app>
<div class="min-h-screen bg-[#0B141A] text-white flex flex-col items-center font-sans">

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
            <button id="btnSauraro"
                onclick="window.location.href='{{ route('makaranta.darasi', ['course' => $course]) }}'"
                class="flex-1 py-2 text-sm font-semibold rounded-full text-[#f0f6fc]
                {{ request()->routeIs('darasi.sauraro') ? 'bg-[#00FFD1]/30' : 'hover:bg-[#00FFD1]/20' }} transition-all">
                🎧 Sauraro
            </button>

            <button id="btnKaranta"
                onclick="window.location.href='{{ route('makaranta.karanta', ['pageId' => $page['page'] ?? 1]) }}'"
                class="flex-1 py-2 text-sm font-semibold rounded-full text-[#f0f6fc]
                {{ request()->routeIs('darasi.karanta') ? 'bg-[#00FFD1]/30' : 'hover:bg-[#00FFD1]/20' }} transition-all">
                📖 Karanta
            </button>
        </div>
    </header>

    {{-- MAIN CONTENT --}}
    <section class="flex-grow w-full px-6 py-4 mt-[110px] max-w-3xl">
        <div id="readerWrapper" class="touch-pan-x">
            <div class="bg-[#161b22] p-6 rounded-2xl shadow-lg border border-[#233044] mb-6">
                <h2 class="text-[#58a6ff] text-lg font-bold mb-2">{{ $page['header'] ?? 'Lesson Title' }}</h2>
                <p id="reader" class="text-[#f0f6fc]/90 leading-relaxed whitespace-pre-line">
                    {{ $page['content'] ?? 'Lesson content goes here.' }}</p>
            </div>
        </div>

        {{-- Trigger Button --}}
        <div class="flex justify-center mt-6">
            <button id="quizBtn"
                class="bg-[#00FFD1] text-[#0C141C] px-6 py-2 rounded-lg font-semibold hover:scale-105 transition">
                🧠 Take Quiz
            </button>
        </div>
    </section>
</div>

{{-- QUIZ MODAL --}}
<div id="quizModal"
    class="fixed inset-0 bg-black/70 backdrop-blur-sm hidden flex items-center justify-center z-50">
    <div class="bg-[#182430] rounded-2xl p-6 w-11/12 max-w-md border border-[#233044] shadow-lg text-[#f0f6fc]">
        <h3 class="text-lg font-semibold text-[#58a6ff] mb-4 text-center">🧠 Quick Quiz</h3>

        @if (!empty($quizzes))
            @php $randomTwo = collect($quizzes)->shuffle()->take(2); @endphp
            <form id="quizForm" action="{{ route('quiz.submit', ['pageId' => $page['page']]) }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="type" value="karanta">
                @foreach ($randomTwo as $index => $quiz)
                    <div>
                        <p class="mb-2">{{ $index + 1 }}. {{ $quiz['question'] }}</p>
                        @foreach ($quiz['options'] as $i => $opt)
                            <label class="block">
                                <input type="radio" name="quiz{{ $index }}" value="{{ $i }}" class="mr-2" required>
                                {{ $opt }}
                            </label>
                        @endforeach
                    </div>
                @endforeach
                <button type="submit"
                    class="w-full bg-[#00FFD1] text-[#0C141C] py-2 rounded-lg mt-3 font-semibold hover:scale-105 transition">
                    Submit
                </button>
            </form>
        @else
            <p class="text-gray-400 text-center">No quiz available for this lesson yet.</p>
        @endif
    </div>
</div>

{{-- REWARD MODAL --}}
<div id="rewardModal"
    class="fixed inset-0 bg-black/70 backdrop-blur-sm hidden flex items-center justify-center z-50">
    <div class="bg-[#182430] rounded-2xl p-6 w-10/12 max-w-sm border border-[#233044] text-center">
        <h3 class="text-[#00FFD1] text-xl font-semibold mb-3" id="rewardTitle">🎉 Congratulations!</h3>
        <p class="text-[#f0f6fc]/80 mb-4" id="rewardMessage">You earned ₦50 reward 🎁</p>
        <button id="closeReward"
            class="bg-[#00FFD1] text-[#0C141C] px-6 py-2 rounded-lg font-semibold hover:scale-105 transition">OK</button>
    </div>
</div>




<script>
document.addEventListener('DOMContentLoaded', () => {
    const quizBtn = document.getElementById('quizBtn');
    const quizModal = document.getElementById('quizModal');
    const rewardModal = document.getElementById('rewardModal');
    const closeReward = document.getElementById('closeReward');
    const quizForm = document.getElementById('quizForm');

    // 🧠 Show quiz modal
    if (quizBtn) {
        quizBtn.addEventListener('click', () => quizModal.classList.remove('hidden'));
    }

    // 🎯 Handle quiz submission (fetch -> JSON)
    if (quizForm) {
        quizForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            try {
                const res = await fetch(quizForm.action, {
                    method: 'POST',
                    body: new FormData(quizForm),
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
                });

                const result = await res.json(); // ✅ Expect JSON now
                quizModal.classList.add('hidden');

                // Update modal based on backend response
                const rewardTitle = document.getElementById('rewardTitle');
                const rewardMessage = document.getElementById('rewardMessage');

                if (result.status === 'success') {
                    rewardTitle.textContent = '🎉 Congratulations!';
                    rewardMessage.textContent = result.message || 'You earned ₦50 reward 🎁';
                } else {
                    rewardTitle.textContent = '❌ Try Again';
                    rewardMessage.textContent = result.message || 'Incorrect answers. Please try again.';
                }

                rewardModal.classList.remove('hidden');

            } catch (err) {
                console.error('Quiz submission failed:', err);
                alert('Something went wrong. Please try again.');
            }
        });
    }

    // ✖ Close reward modal
    if (closeReward) {
        closeReward.addEventListener('click', () => rewardModal.classList.add('hidden'));
    }

    // 🕓 Auto show quiz after 45s of reading
    setTimeout(() => {
        if (quizModal) quizModal.classList.remove('hidden');
    }, 45000);
});
</script>

</x-layouts.app>
