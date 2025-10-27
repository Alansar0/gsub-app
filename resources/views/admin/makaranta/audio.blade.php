@php
    $audio = \App\Models\SurahAudio::with('quizzes')->latest()->first();
@endphp

<x-layouts.app>
<div class="min-h-screen bg-[#0C141C] text-white flex flex-col items-center justify-center p-10">
    <h2 class="text-2xl text-[#00FFD1] font-semibold mb-4">{{ $audio->title }}</h2>
    <audio id="audioPlayer" src="{{ asset('storage/'.$audio->file_path) }}" controls class="w-full max-w-lg"></audio>

    <div id="quizContainer" class="hidden mt-8 w-full max-w-xl space-y-4"></div>
</div>

<script>
const quizzes = @json($audio->quizzes);
const quizContainer = document.getElementById('quizContainer');
const audioPlayer = document.getElementById('audioPlayer');

// Shuffle function
function getRandomQuizzes(all, count = 5) {
    return all.sort(() => 0.5 - Math.random()).slice(0, Math.min(count, all.length));
}

// When audio ends
audioPlayer.addEventListener('ended', () => {
    quizContainer.innerHTML = '';
    quizContainer.classList.remove('hidden');

    const randomQuizzes = getRandomQuizzes(quizzes, 5);
    randomQuizzes.forEach((q, i) => {
        const div = document.createElement('div');
        div.className = "bg-[#182430] p-4 rounded-lg border border-[#233044]";
        div.innerHTML = `
            <p class="text-[#00FFD1] font-semibold mb-2">${i + 1}. ${q.question}</p>
            <div class="grid grid-cols-2 gap-2">
                ${['a','b','c','d'].map(opt => q['option_' + opt] ?
                    `<button class='option bg-[#0F1923] p-2 rounded hover:bg-[#1B2938]' data-answer='${q['option_' + opt]}'>${q['option_' + opt]}</button>`
                : '').join('')}
            </div>
        `;
        quizContainer.appendChild(div);
    });

    // Check answers
    document.querySelectorAll('.option').forEach(btn => {
        btn.addEventListener('click', e => {
            const answer = e.target.dataset.answer;
            const question = randomQuizzes.find(q => Object.values(q).includes(answer));
            if (question && answer === question.correct_answer) {
                e.target.classList.add('bg-green-600');
            } else {
                e.target.classList.add('bg-red-600');
            }
        });
    });
});
</script>
</x-layouts.app>
