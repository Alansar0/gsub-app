// public/js/audio-quiz.js

document.addEventListener('DOMContentLoaded', () => {
    let allQuizzes = []; // Loaded from backend via Blade JSON
    let currentSet = [];

    const quizPopup = document.getElementById('quizPopup');
    const quizContainer = document.getElementById('quizContainer');
    const submitQuizBtn = document.getElementById('submitQuizBtn');

    // Fetch all quizzes from backend (injected via Blade)
    if (typeof window.allQuizzes !== 'undefined') {
        allQuizzes = window.allQuizzes;
    }

    function getRandomQuizzes(num = 5) {
        const shuffled = [...allQuizzes].sort(() => 0.5 - Math.random());
        return shuffled.slice(0, num);
    }

    function showQuizPopup() {
        currentSet = getRandomQuizzes(5);
        quizContainer.innerHTML = '';

        currentSet.forEach((q, index) => {
            const questionEl = document.createElement('div');
            questionEl.className = "mb-4";
            questionEl.innerHTML = `
                <p class="font-semibold mb-2">${index + 1}. ${q.question}</p>
                ${q.options.map((opt, i) => `
                    <label class="block mb-1">
                        <input type="radio" name="q${index}" value="${opt}" class="mr-2">
                        ${opt}
                    </label>
                `).join('')}
            `;
            quizContainer.appendChild(questionEl);
        });

        quizPopup.classList.remove('hidden');
    }

    submitQuizBtn.addEventListener('click', () => {
        let score = 0;
        currentSet.forEach((q, index) => {
            const selected = document.querySelector(`input[name="q${index}"]:checked`);
            if (selected && selected.value === q.correct_answer) {
                score++;
            }
        });

        quizPopup.classList.add('hidden');
        alert(`You scored ${score}/${currentSet.length}! 🎉`);
        // Here you’d call an API to update user rewards
    });

    // Listen for audio end event
    const audio = document.getElementById('audioPlayer');
    audio.addEventListener('ended', () => {
        showQuizPopup();
    });
});
