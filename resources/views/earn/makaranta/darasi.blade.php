<x-layouts.app>
    <div class="min-h-screen bg-[#0B141A] text-white flex flex-col items-center font-sans relative">
        {{-- Header --}}
        <header
            class="fixed top-0 left-0 right-0 z-40 bg-[#182430] border-b border-[#233044] shadow-[0_0_15px_rgba(88,166,255,0.25)]">
            <div class="text-center py-4 relative">
                <a href="{{ url()->previous() }}"
                    class="absolute left-6 top-1/2 -translate-y-1/2 text-[#58a6ff] hover:underline flex items-center">
                    <i class="material-icons mr-1 text-[#58a6ff]">arrow_back</i>
                    Back
                </a>
                <h1 class="text-white text-xl font-semibold tracking-wide"> {{ $displayName }} </h1>
            </div>

            {{-- Switcher --}}
            <div
                class="w-[65vw] mx-auto p-1 flex items-center justify-between bg-[#0C141C] rounded-full border border-[#00FFD1]/50 shadow-[0_0_20px_rgba(0,255,209,0.4)] mb-3 transition-all">
                <button id="btnSauraro" onclick="window.location.href='{{ route('makaranta.darasi') }}'"
                    class="flex-1 py-2 text-sm font-semibold rounded-full text-[#f0f6fc]
        {{ request()->routeIs('makaranta.darasi') ? 'bg-[#00FFD1]/30' : 'hover:bg-[#00FFD1]/20' }} transition-all">
                    🎧 Sauraro
                </button>

                @php
                    // Store current course in session
                    session(['current_course' => $course ?? 'sharrindajjal']);
                @endphp
                <button id="btnKaranta" onclick="window.location.href='{{ route('makaranta.karanta', ['pageId' => 1]) }}'"
                    class="flex-1 py-2 text-sm font-semibold rounded-full text-[#f0f6fc]
        {{ Route::currentRouteName() === 'makaranta.karanta' ? 'bg-[#00FFD1]/30' : 'hover:bg-[#00FFD1]/20' }} transition-all">
                    📖 Karanta
                </button>
            </div>
        </header>


        {{-- 🔊 SAURARO SECTION --}}
        <section id="sauraroView"
            class="flex-grow w-full px-6 py-4 overflow-y-auto mt-[110px] max-w-3xl transition-all duration-500">
            <div class="flex justify-center mb-4">
                <div
                    class="relative bg-[#161b22] rounded-2xl p-3 border border-[#58a6ff]/50 shadow-[0_0_15px_rgba(88,166,255,0.4)] hover:shadow-[0_0_25px_rgba(88,166,255,0.7)] transition">
                    <img src="{{ Vite::asset('resources/images/kurakurai100.png') }}" alt="Makaranta Image"
                        class="w-[85vw] max-w-[600px] h-44 object-contain mx-auto drop-shadow-[0_0_12px_#58a6ff]/40">
                </div>
            </div>
  {{-- Audio Files List --}}
         @if(empty($files))
                <p class="text-center text-gray-400 mt-8">No audio files found for this course.</p>
            @else
            {{-- Surah List --}}
            <ul class="space-y-3">
                @foreach ($files as $index => $file)

                <a href="{{ route('makaranta.sauraro', ['course' => $course ?? 'sharrindajjal', 'file' => $file]) }}"
                    class="bg-gradient-to-r from-[#0C141C] to-[#182430] flex items-center justify-between rounded-2xl p-3 shadow-lg border border-[#00FFD1]/20">
                    <div class="flex items-center gap-3">
                        <button
                            class="playButton w-10 h-10 rounded-full bg-[#00FFD1] flex items-center justify-center shadow-[0_0_12px_rgba(0,255,209,0.6)] hover:scale-105 transition">
                            <i class="fas fa-play text-[#0C141C]"></i>
                        </button>
                        <div class="text-left">
                            <p class="text-[#f0f6fc] font-semibold text-base">Karatu {{ $index + 1 }}</p>
                            <p class="text-[#58a6ff] text-sm">{{ $displayName }}</p>
                        </div>
                    </div>
                    <i class="material-icons text-[#58a6ff] !text-[40px]">chevron_right</i>
                </a>
                @endforeach
            </ul>
            @endif
        </section>

</x-layouts.app>
