<x-layouts.app>
    <div class="min-h-screen bg-[#0B141A] text-white flex flex-col items-center font-sans">
        {{-- Fixed Header --}}
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

            {{-- Makaranta Banner --}}
            <div class="flex justify-center mb-4 mt-3">
                <div
                    class="relative bg-[#161b22] rounded-2xl p-3 border border-[#58a6ff]/50 transition-all duration-300 shadow-[0_0_15px_rgba(88,166,255,0.4)] hover:shadow-[0_0_25px_rgba(88,166,255,0.7)] hover:scale-[1.02]">
                    <img src="   " alt="Makaranta Image"
                        class="w-[85vw] max-w-[600px] h-44 md:h-56 object-contain mx-auto drop-shadow-[0_0_12px_#58a6ff]/40">
                    <div class="absolute inset-0 rounded-2xl bg-gradient-to-b from-transparent to-[#0f172a]/60"></div>
                </div>
            </div>
        </header>


        {{-- Surah List --}}
        <main class="flex-grow w-full px-6 py-4 overflow-y-auto  mt-[290px] max-w-3xl">
            <ul class="space-y-3">

                 <div
                    class="bg-gradient-to-r from-[#0C141C] to-[#182430] flex items-center justify-between rounded-2xl px-4 py-3 shadow-lg border border-[#00FFD1]/20">
                    <div class="flex items-center gap-3">
                        <!-- Play Button -->
                        <button id="playButton"
                            class="w-10 h-10 rounded-full bg-[#00FFD1] flex items-center justify-center shadow-[0_0_12px_rgba(0,255,209,0.6)] hover:scale-105 transition">
                            <i id="playIcon" class="fas fa-play text-[#0C141C]"></i>
                        </button>

                        <!-- Surah Info -->
                        <div class="text-left">
                            <p class="text-[#f0f6fc] font-semibold text-base">Ar-Rahman</p>
                            <p class="text-[#58a6ff] text-sm">سورة الرحمن</p>
                        </div>
                    </div>

                    <a class="text-[#58a6ff]  " href="{{ route('makaranta.sauraro') }}">
                        <i class="material-icons !text-[54px]">chevron_right</i>
                    </a>



                    <!-- Audio Player (hidden controls) -->
                    <audio id="surahAudio" src="{{ asset('audio/surah-arrahman.mp3') }}"></audio>
                </div>

                <div
                    class="bg-gradient-to-r from-[#0C141C] to-[#182430] flex items-center justify-between rounded-2xl px-4 py-3 shadow-lg border border-[#00FFD1]/20">
                    <div class="flex items-center gap-3">
                        <!-- Play Button -->
                        <button id="playButton"
                            class="w-10 h-10 rounded-full bg-[#00FFD1] flex items-center justify-center shadow-[0_0_12px_rgba(0,255,209,0.6)] hover:scale-105 transition">
                            <i id="playIcon" class="fas fa-play text-[#0C141C]"></i>
                        </button>

                        <!-- Surah Info -->
                        <div class="text-left">
                            <p class="text-[#f0f6fc] font-semibold text-base">Ar-Rahman</p>
                            <p class="text-[#58a6ff] text-sm">سورة الرحمن</p>
                        </div>
                    </div>

                    <a class="text-[#58a6ff]  " href="{{ route('makaranta.sauraro') }}">
                        <i class="material-icons !text-[54px]">chevron_right</i>
                    </a>



                    <!-- Audio Player (hidden controls) -->
                    <audio id="surahAudio" src="{{ asset('audio/surah-arrahman.mp3') }}"></audio>
                </div>

                 <div
                    class="bg-gradient-to-r from-[#0C141C] to-[#182430] flex items-center justify-between rounded-2xl px-4 py-3 shadow-lg border border-[#00FFD1]/20">
                    <div class="flex items-center gap-3">
                        <!-- Play Button -->
                        <button id="playButton"
                            class="w-10 h-10 rounded-full bg-[#00FFD1] flex items-center justify-center shadow-[0_0_12px_rgba(0,255,209,0.6)] hover:scale-105 transition">
                            <i id="playIcon" class="fas fa-play text-[#0C141C]"></i>
                        </button>

                        <!-- Surah Info -->
                        <div class="text-left">
                            <p class="text-[#f0f6fc] font-semibold text-base">Ar-Rahman</p>
                            <p class="text-[#58a6ff] text-sm">سورة الرحمن</p>
                        </div>
                    </div>

                    <a class="text-[#58a6ff]  " href="{{ route('makaranta.sauraro') }}">
                        <i class="material-icons !text-[54px]">chevron_right</i>
                    </a>



                    <!-- Audio Player (hidden controls) -->
                    <audio id="surahAudio" src="{{ asset('audio/surah-arrahman.mp3') }}"></audio>
                </div>
                 <div
                    class="bg-gradient-to-r from-[#0C141C] to-[#182430] flex items-center justify-between rounded-2xl px-4 py-3 shadow-lg border border-[#00FFD1]/20">
                    <div class="flex items-center gap-3">
                        <!-- Play Button -->
                        <button id="playButton"
                            class="w-10 h-10 rounded-full bg-[#00FFD1] flex items-center justify-center shadow-[0_0_12px_rgba(0,255,209,0.6)] hover:scale-105 transition">
                            <i id="playIcon" class="fas fa-play text-[#0C141C]"></i>
                        </button>

                        <!-- Surah Info -->
                        <div class="text-left">
                            <p class="text-[#f0f6fc] font-semibold text-base">Ar-Rahman</p>
                            <p class="text-[#58a6ff] text-sm">سورة الرحمن</p>
                        </div>
                    </div>

                    <a class="text-[#58a6ff]  " href="{{ route('makaranta.sauraro') }}">
                        <i class="material-icons !text-[54px]">chevron_right</i>
                    </a>



                    <!-- Audio Player (hidden controls) -->
                    <audio id="surahAudio" src="{{ asset('audio/surah-arrahman.mp3') }}"></audio>
                </div>
            </ul>
        </main>

        <script>
            const playButton = document.getElementById('playButton');
            const playIcon = document.getElementById('playIcon');
            const surahAudio = document.getElementById('surahAudio');

            playButton.addEventListener('click', () => {
                if (surahAudio.paused) {
                    surahAudio.play();
                    playIcon.classList.replace('fa-play', 'fa-pause');
                } else {
                    surahAudio.pause();
                    playIcon.classList.replace('fa-pause', 'fa-play');
                }
            });
        </script>
</x-layouts.app>
