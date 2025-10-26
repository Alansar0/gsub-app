<x-layouts.app>
<div class="min-h-screen flex flex-col items-center justify-center bg-[#0C141C] text-white px-4 py-10">
    <!-- Surah Info -->
    <div class="text-center mb-6">
        <h2 class="text-[#00FFD1] text-2xl font-semibold">سورة الرحمن</h2>
        <p class="text-[#94A3B8] text-sm mt-1">Ar-Rahman • Surah 55</p>
    </div>

    <!-- Circular Artwork -->
    <div class="relative w-64 h-64 rounded-full bg-gradient-to-br from-[#0D2C35] to-[#112C3A] flex items-center justify-center shadow-[0_0_40px_rgba(0,255,209,0.3)]">
        <img src="{{ Vite::asset('resources/images/kurakurai100.png') }}" alt="Surah Artwork"
             class="w-52 h-52 rounded-full object-cover opacity-80" />

        <!-- Circular Progress -->
        <svg class="absolute top-0 left-0 w-full h-full" viewBox="0 0 100 100">
            <circle cx="50" cy="50" r="48" stroke="#00FFD1" stroke-width="1.6" fill="none" opacity="0.25"/>
            <circle id="progressCircle" cx="50" cy="50" r="48" stroke="#00FFD1" stroke-width="2.5" fill="none"
                stroke-dasharray="301.59" stroke-dashoffset="301.59" stroke-linecap="round"
                class="transition-all duration-200 ease-linear"/>
        </svg>

        <!-- Play/Pause Button -->
        <button id="playBtn" class="absolute bottom-6 right-6 w-16 h-16 bg-[#00FFD1] rounded-full flex items-center justify-center shadow-[0_0_25px_rgba(0,255,209,0.6)] hover:scale-110 transition">
            <i id="playIcon" class="fas fa-play text-[#0C141C] text-2xl"></i>
        </button>
    </div>

    <!-- Track Info -->
    <div class="text-center mt-6">
        <p class="text-lg font-medium">Ar-Rahman - Mishary Alafasy</p>
        <p class="text-[#94A3B8] text-sm mt-1">"فَبِأَيِّ آلَاءِ رَبِّكُمَا تُكَذِّبَانِ"</p>
    </div>

    <!-- Audio Progress Bar -->
    <div class="w-full max-w-md mt-8">
        <input id="seekBar" type="range" min="0" value="0"
               class="w-full accent-[#00FFD1] h-2 rounded-lg cursor-pointer bg-[#1B2938]" />
        <div class="flex justify-between text-xs text-[#94A3B8] mt-1">
            <span id="currentTime">0:00</span>
            <span id="totalTime">0:00</span>
        </div>
    </div>

    <!-- Control Buttons -->
    <div class="flex justify-center items-center gap-15 mt-6">
        {{-- <button id="prevBtn" class="text-[#00FFD1] text-2xl hover:scale-110 transition"><i class="fas fa-step-backward"></i></button> --}}
        <span class="" > Dowload here</span>
        <button id="prevBtn" class="text-[#00FFD1] text-2xl hover:scale-110 transition"><i class="fas fa-download text-3xl text-[#58A6FF]"></i></button>
        <span class="" > Dowload here</span>
        {{-- <button id="restartBtn" class="text-[#00FFD1] text-2xl hover:scale-110 transition"><i class="fas fa-redo"></i></button> --}}
        <button id="nextBtn" class="text-[#00FFD1] text-2xl hover:scale-110 transition"><i class="fas fa-list-check text-3xl text-[#58A6FF]"></i></button>
        <span class="" > Take Quiz to earn </span>
        {{-- <button id="nextBtn" class="text-[#00FFD1] text-2xl hover:scale-110 transition"><i class="fas fa-step-forward"></i></button> --}}
    </div>

    <!-- Audio Element -->
    <audio id="audioPlayer" src="{{ asset('audio/arrahman.mp3') }}"></audio>
</div>

<!-- JS Logic -->
<script>
    const audio = document.getElementById('audioPlayer');
    const playBtn = document.getElementById('playBtn');
    const playIcon = document.getElementById('playIcon');
    const progressCircle = document.getElementById('progressCircle');
    const seekBar = document.getElementById('seekBar');
    const currentTime = document.getElementById('currentTime');
    const totalTime = document.getElementById('totalTime');
    const restartBtn = document.getElementById('restartBtn');

    audio.addEventListener('loadedmetadata', () => {
        seekBar.max = audio.duration;
        totalTime.textContent = formatTime(audio.duration);
    });

    audio.addEventListener('timeupdate', () => {
        seekBar.value = audio.currentTime;
        currentTime.textContent = formatTime(audio.currentTime);

        const progress = audio.currentTime / audio.duration;
        progressCircle.style.strokeDashoffset = 301.59 - (301.59 * progress);
    });

    seekBar.addEventListener('input', () => {
        audio.currentTime = seekBar.value;
    });

    playBtn.addEventListener('click', () => {
        if (audio.paused) {
            audio.play();
            playIcon.classList.replace('fa-play', 'fa-pause');
        } else {
            audio.pause();
            playIcon.classList.replace('fa-pause', 'fa-play');
        }
    });

    restartBtn.addEventListener('click', () => {
        audio.currentTime = 0;
        audio.play();
        playIcon.classList.replace('fa-play', 'fa-pause');
    });

    function formatTime(seconds) {
        const mins = Math.floor(seconds / 60);
        const secs = Math.floor(seconds % 60);
        return `${mins}:${secs < 10 ? '0' : ''}${secs}`;
    }
</script>

<script src="https://kit.fontawesome.com/a2d9d5e6c1.js" crossorigin="anonymous"></script>
</x-layouts.app>
