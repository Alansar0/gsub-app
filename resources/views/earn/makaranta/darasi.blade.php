<x-layouts.app>
<div class="min-h-screen bg-[#0B141A] text-white flex flex-col items-center font-sans relative">
    {{-- Header --}}
    <header class="fixed top-0 left-0 right-0 z-40 bg-[#182430] border-b border-[#233044] shadow-[0_0_15px_rgba(88,166,255,0.25)]">
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
                class="flex-1 py-2 text-sm font-semibold rounded-full text-[#f0f6fc] bg-[#00FFD1]/20 hover:bg-[#00FFD1]/30 transition-all">
                Sauraro
            </button>
            <button id="btnKaranta"
                class="flex-1 py-2 text-sm font-semibold rounded-full text-[#f0f6fc] hover:bg-[#00FFD1]/20 transition-all">
                Karanta
            </button>
        </div>
    </header>

    {{-- 🔊 SAURARO SECTION --}}
    <section id="sauraroView" class="flex-grow w-full px-6 py-4 overflow-y-auto mt-[110px] max-w-3xl transition-all duration-500">
        <div class="flex justify-center mb-4">
            <div
                class="relative bg-[#161b22] rounded-2xl p-3 border border-[#58a6ff]/50 shadow-[0_0_15px_rgba(88,166,255,0.4)] hover:shadow-[0_0_25px_rgba(88,166,255,0.7)] transition">
                <img src="{{ Vite::asset('resources/images/kurakurai100.png') }}" alt="Makaranta Image"
                    class="w-[85vw] max-w-[600px] h-44 object-contain mx-auto drop-shadow-[0_0_12px_#58a6ff]/40">
            </div>
        </div>

        {{-- Surah List --}}
        <ul class="space-y-3">
            <a href="{{ route('makaranta.sauraro')}}"
                class="bg-gradient-to-r from-[#0C141C] to-[#182430] flex items-center justify-between rounded-2xl p-3 shadow-lg border border-[#00FFD1]/20">
                <div class="flex items-center gap-3">
                    <button class="playButton w-10 h-10 rounded-full bg-[#00FFD1] flex items-center justify-center shadow-[0_0_12px_rgba(0,255,209,0.6)] hover:scale-105 transition">
                        <i class="fas fa-play text-[#0C141C]"></i>
                    </button>
                    <div class="text-left">
                        <p class="text-[#f0f6fc] font-semibold text-base">Karatu 1</p>
                        <p class="text-[#58a6ff] text-sm">سورة الرحمن</p>
                    </div>
                </div>
                <i class="material-icons text-[#58a6ff] !text-[40px]">chevron_right</i>
                <audio class="audioSource" src="{{ asset('audio/surah-arrahman.mp3') }}"></audio>
            </a>
        </ul>
    </section>

    {{-- 📖 KARANTA SECTION --}}
    <section id="karantaView" class="hidden min-h-screen flex items-center justify-center px-6 py-10 bg-[#0f172a] text-[#f0f6fc]">
        <div id="readerWrapper"
            class="relative w-full max-w-2xl h-[80vh] overflow-hidden rounded-2xl border border-[#182430] shadow-[0_0_30px_#58a6ff40] bg-[#161b22]">
            <div id="reader"
                class="absolute inset-0 p-6 text-justify text-[#f0f6fc]/90 select-none transition-all duration-500 ease-in-out transform">
            </div>
        </div>

        <div id="quizContainer"
            class="hidden fixed inset-0 flex items-center justify-center bg-[#0f172a]/95 backdrop-blur-md z-50">
            <div class="max-w-xl w-full bg-[#161b22] p-6 rounded-2xl border border-[#233044] shadow-[0_0_25px_#58a6ff60]">
                <h2 class="text-[#58a6ff] text-2xl font-bold mb-4 text-center">🧠 Quiz Time</h2>
                <div id="quizContent"></div>
                <div class="text-center mt-6">
                    <button id="submitQuiz"
                        class="bg-[#58a6ff] text-[#0f172a] px-5 py-2 rounded-xl font-semibold hover:scale-105 transition">
                        Submit Answers
                    </button>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
const sauraroView = document.getElementById('sauraroView');
const karantaView = document.getElementById('karantaView');
const btnSauraro = document.getElementById('btnSauraro');
const btnKaranta = document.getElementById('btnKaranta');

// Toggle logic
btnKaranta.addEventListener('click', () => {
    sauraroView.classList.add('hidden');
    karantaView.classList.remove('hidden');
    btnKaranta.classList.add('bg-[#00FFD1]/20');
    btnSauraro.classList.remove('bg-[#00FFD1]/20');
});

btnSauraro.addEventListener('click', () => {
    karantaView.classList.add('hidden');
    sauraroView.classList.remove('hidden');
    btnSauraro.classList.add('bg-[#00FFD1]/20');
    btnKaranta.classList.remove('bg-[#00FFD1]/20');
});

// === Reading Swipe Logic (Simplified) ===
const text = `{{ Str::limit(strip_tags(optional($lesson)->content ?? 'No content uploaded yet'), 5000, '') }}`;
    const pages = text.match(/(.|[\r\n]){1,700}/g) || ["No text available"];
let currentPage = 0;
const reader = document.getElementById('reader');
reader.innerHTML = `<p>${pages[0]}</p>`;

const readerWrapper = document.getElementById('readerWrapper');
let startX = 0;
readerWrapper.addEventListener('touchstart', e => startX = e.touches[0].clientX);
readerWrapper.addEventListener('touchend', e => {
    const endX = e.changedTouches[0].clientX;
    if (startX - endX > 50) nextPage();
    if (endX - startX > 50) prevPage();
});

function animatePageChange(dir, content) {
    reader.style.transition = 'transform 0.4s ease, opacity 0.4s ease';
    reader.style.transform = dir === 'next' ? 'translateX(-100%)' : 'translateX(100%)';
    reader.style.opacity = '0';
    setTimeout(() => {
        reader.innerHTML = `<p>${content}</p>`;
        reader.style.transform = dir === 'next' ? 'translateX(100%)' : 'translateX(-100%)';
        setTimeout(() => {
            reader.style.transform = 'translateX(0)';
            reader.style.opacity = '1';
        }, 20);
    }, 400);
}

function nextPage() {
    if (currentPage < pages.length - 1) {
        currentPage++;
        animatePageChange('next', pages[currentPage]);
    } else {
        document.getElementById('quizContainer').classList.remove('hidden');
    }
}

function prevPage() {
    if (currentPage > 0) {
        currentPage--;
        animatePageChange('prev', pages[currentPage]);
    }
}
</script>
</x-layouts.app>
