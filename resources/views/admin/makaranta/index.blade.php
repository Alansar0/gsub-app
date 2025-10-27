<x-layouts.app>
<div class="min-h-screen bg-[#0C141C] text-white px-6 py-10">
    <div class="max-w-6xl mx-auto">

        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-[#00FFD1]">🎧 Manage Surah Audios</h1>
            <a href="{{ route('admin.audios.create') }}"
               class="bg-[#00FFD1] text-[#0C141C] font-semibold px-4 py-2 rounded-xl hover:scale-105 transition">
               + Upload New Audio
            </a>
        </div>

        <!-- Audio List -->
        @foreach($audios as $audio)
        <div class="bg-[#182430] p-6 rounded-2xl border border-[#233044] shadow-lg mb-8">

            <!-- Audio Info -->
            <div class="flex justify-between items-start">
                <div>
                    <h2 class="text-2xl font-semibold text-[#00FFD1]">{{ $audio->title }}</h2>
                    <p class="text-sm text-[#94A3B8] mb-2">Reciter: {{ $audio->reciter ?? 'Unknown' }}</p>
                    <audio controls class="w-full mt-3">
                        <source src="{{ asset('storage/'.$audio->file_path) }}" type="audio/mpeg">
                    </audio>
                </div>
                <form method="POST" action="{{ route('admin.audios.destroy', $audio) }}">
                    @csrf @method('DELETE')
                    <button class="text-red-400 hover:text-red-600 text-lg"><i class="fas fa-trash"></i></button>
                </form>
            </div>

            <!-- Divider -->
            <div class="border-t border-[#233044] my-6"></div>

            <!-- Add Quiz Section -->
            <h3 class="text-xl font-semibold text-[#00FFD1] mb-3">🧠 Add Quiz for "{{ $audio->title }}"</h3>
            <form method="POST" action="{{ route('admin.audios.storeQuiz', $audio) }}" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                @csrf
                <input name="question" placeholder="Question" required class="p-3 bg-[#0F1923] rounded text-white">
                <input name="option_a" placeholder="Option A" required class="p-3 bg-[#0F1923] rounded text-white">
                <input name="option_b" placeholder="Option B" required class="p-3 bg-[#0F1923] rounded text-white">
                <input name="option_c" placeholder="Option C (optional)" class="p-3 bg-[#0F1923] rounded text-white">
                <input name="option_d" placeholder="Option D (optional)" class="p-3 bg-[#0F1923] rounded text-white">
                <input name="correct_answer" placeholder="Correct Answer (copy exact option text)" required class="p-3 bg-[#0F1923] rounded text-white">
                <button class="bg-[#00FFD1] text-[#0C141C] font-semibold py-3 rounded-xl hover:scale-105 transition">+ Add Quiz</button>
            </form>

            <!-- Existing Quizzes -->
            <div class="mt-8">
                <h4 class="text-lg font-semibold text-[#00FFD1] mb-3">📋 Existing Quizzes</h4>
                <div class="space-y-3">
                    @forelse($audio->quizzes as $quiz)
                    <div class="bg-[#0F1923] p-4 rounded-xl border border-[#233044] flex justify-between items-start">
                        <div>
                            <p class="font-semibold text-[#00FFD1]">{{ $quiz->question }}</p>
                            <ul class="mt-1 text-sm text-[#94A3B8] list-disc list-inside">
                                <li>A: {{ $quiz->option_a }}</li>
                                <li>B: {{ $quiz->option_b }}</li>
                                @if($quiz->option_c)<li>C: {{ $quiz->option_c }}</li>@endif
                                @if($quiz->option_d)<li>D: {{ $quiz->option_d }}</li>@endif
                                <li class="text-[#00FFD1] mt-1">✅ Correct: {{ $quiz->correct_answer }}</li>
                            </ul>
                        </div>
                        <form method="POST" action="{{ route('admin.audios.destroyQuiz', $quiz) }}">
                            @csrf @method('DELETE')
                            <button class="text-red-400 hover:text-red-600"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                    @empty
                    <p class="text-[#94A3B8] text-sm">No quizzes added yet.</p>
                    @endforelse
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<script src="https://kit.fontawesome.com/a2d9d5e6c1.js" crossorigin="anonymous"></script>
</x-layouts.app>
