<x-layouts.app>
<div class="min-h-screen flex flex-col items-center justify-center bg-[#0C141C] text-white px-4 py-10">
    <!-- Back Button -->
    <a href="{{ route('makaranta.darasi', ['course' => $course]) }}"
       class="absolute left-6 top-6 text-[#58a6ff] hover:underline flex items-center">
        <i class="material-icons mr-1">arrow_back</i>
        Back
    </a>

    <!-- Audio Info -->
    <div class="text-center mb-6">
        <h2 class="text-[#00FFD1] text-2xl font-semibold">{{ $displayFile }}</h2>
        <p class="text-[#94A3B8] text-sm mt-1">{{ $displayName }}</p>
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
        <p class="text-lg font-medium">kura kuari 100 Acikin Sallarmu</p>
        <p class="text-[#94A3B8] text-sm mt-1">Zakusamu Grabasa Voucher kyauta</p>
        <p class="text-[#94A3B8] text-sm mt-1">Idan ka Saurari karatu</p>

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
    <div class="flex justify-center items-center gap-20 mt-2">
        <div class="flex flex-col items-center">
            <button id="downloadBtn" class="text-[#58A6FF] hover:scale-110 transition">
                <i class="fas fa-download text-3xl"></i>
            </button>
            <span class="text-xs mt-1 text-[#94A3B8]">Download</span>
        </div>

        <div class="flex flex-col items-center">
            <button id="quizBtn" class="text-[#58A6FF] hover:scale-110 transition">
                <i class="fas fa-list-check text-3xl"></i>
            </button>
            <span class="text-xs mt-1 text-[#94A3B8]">Take Quiz</span>
        </div>
    </div>

    <!-- Audio Element -->
    <audio id="audioPlayer" src="{{ asset($path) }}"></audio>
</div>

<!-- Quiz Modal -->
<div id="quizModal" class="fixed inset-0 bg-black/70 backdrop-blur-sm hidden flex items-center justify-center z-50">
    <div class="bg-[#182430] rounded-2xl p-6 w-11/12 max-w-md border border-[#233044] shadow-lg text-[#f0f6fc]">
        <h3 class="text-lg font-semibold text-[#58a6ff] mb-4 text-center">🧠 Quick Quiz</h3>
        <form id="quizForm" class="space-y-4">
            <div>
                <p class="mb-2">1. What does “Ar-Rahman” mean?</p>
                <label class="block"><input type="radio" name="q1" value="Merciful" class="mr-2">The Merciful</label>
                <label class="block"><input type="radio" name="q1" value="Punisher" class="mr-2">The Punisher</label>
            </div>
            <div>
                <p class="mb-2">2. How many verses does Surah Ar-Rahman have?</p>
                <label class="block"><input type="radio" name="q2" value="78" class="mr-2">78</label>
                <label class="block"><input type="radio" name="q2" value="55" class="mr-2">55</label>
            </div>
            <button type="submit" class="w-full bg-[#00FFD1] text-[#0C141C] py-2 rounded-lg mt-3 font-semibold hover:scale-105 transition">Submit</button>
        </form>
    </div>
</div>

<!-- Congrats Modal -->
<div id="rewardModal" class="fixed inset-0 bg-black/70 backdrop-blur-sm hidden flex items-center justify-center z-50">
    <div class="bg-[#182430] rounded-2xl p-6 w-10/12 max-w-sm border border-[#233044] text-center">
        <h3 class="text-[#00FFD1] text-xl font-semibold mb-3">🎉 Congratulations!</h3>
        <p class="text-[#f0f6fc]/80 mb-4">You earned ₦500 Cashback and 1 Voucher 🎁</p>
        <button id="closeReward" class="bg-[#00FFD1] text-[#0C141C] px-6 py-2 rounded-lg font-semibold hover:scale-105 transition">OK</button>
    </div>
</div>

<script>
    const audio = document.getElementById('audioPlayer');
    const playBtn = document.getElementById('playBtn');
    const playIcon = document.getElementById('playIcon');
    const progressCircle = document.getElementById('progressCircle');
    const seekBar = document.getElementById('seekBar');
    const currentTime = document.getElementById('currentTime');
    const totalTime = document.getElementById('totalTime');
    const downloadBtn = document.getElementById('downloadBtn');
    const quizBtn = document.getElementById('quizBtn');
    const quizModal = document.getElementById('quizModal');
    const rewardModal = document.getElementById('rewardModal');
    const closeReward = document.getElementById('closeReward');

    // 🕓 Restore saved progress
    const savedTime = localStorage.getItem('audioProgress');
    if (savedTime) audio.currentTime = parseFloat(savedTime);

    // ⏯ Play / Pause
    playBtn.addEventListener('click', () => {
        if (audio.paused) {
            audio.play();
            playIcon.classList.replace('fa-play', 'fa-pause');
        } else {
            audio.pause();
            playIcon.classList.replace('fa-pause', 'fa-play');
        }
    });

    // 🎧 Duration setup
    audio.addEventListener('loadedmetadata', () => {
        seekBar.max = audio.duration;
        totalTime.textContent = formatTime(audio.duration);
    });

    // 🔄 Progress update
    audio.addEventListener('timeupdate', () => {
        seekBar.value = audio.currentTime;
        currentTime.textContent = formatTime(audio.currentTime);
        localStorage.setItem('audioProgress', audio.currentTime);
        const progress = audio.currentTime / audio.duration;
        progressCircle.style.strokeDashoffset = 301.59 - (301.59 * progress);
    });

    // 🎵 Prevent skipping forward
    let lastSeekValue = 0;
    seekBar.addEventListener('input', (e) => {
        if (e.target.value < lastSeekValue) {
            audio.currentTime = e.target.value; // allow backward
        } else {
            seekBar.value = lastSeekValue; // block forward seek
        }
    });
    seekBar.addEventListener('change', () => lastSeekValue = audio.currentTime);

    // 💾 Download logic
    downloadBtn.addEventListener('click', () => {
        const link = document.createElement('a');
        link.href = audio.src;
        link.download = 'surah-ar-rahman.mp3';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    });

    // 🧠 Quiz popup
    quizBtn.addEventListener('click', () => quizModal.classList.remove('hidden'));

    document.getElementById('quizForm').addEventListener('submit', (e) => {
        e.preventDefault();
        quizModal.classList.add('hidden');
        rewardModal.classList.remove('hidden');
    });

    closeReward.addEventListener('click', () => rewardModal.classList.add('hidden'));

    // 📘 Auto show quiz after audio ends
    audio.addEventListener('ended', () => {
        quizModal.classList.remove('hidden');
    });

    function formatTime(seconds) {
        const mins = Math.floor(seconds / 60);
        const secs = Math.floor(seconds % 60);
        return `${mins}:${secs < 10 ? '0' : ''}${secs}`;
    }
</script>

<script src="https://kit.fontawesome.com/a2d9d5e6c1.js" crossorigin="anonymous"></script>
</x-layouts.app>
