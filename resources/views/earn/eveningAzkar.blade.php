{{-- resources/views/adhkar/morning.blade.php --}}
<x-layouts.app>



    <div class="min-h-screen bg-[#101E2B] flex flex-col items-center justify-between text-white">

        {{-- Header --}}
        <header class="w-full bg-[#182430] mt-0 text-center py-4 shadow-md fixed top-0 z-10">
             <a href="{{ url()->previous() }}" class="text-[#58a6ff] hover:underline flex items-center mt-1 ml-1">
                <i class="material-icons mr-1">arrow_back</i> Back
            </a>
            <h1 class="text-[#00FFD1] text-xl font-semibold tracking-wide">أَذْكَارُ المَسَاءِ</h1>
            <h1 class="text-white text-xl font-semibold tracking-wide">Azkar na Maraice</h1>

        </header>

        {{-- Main Dua Card --}}
        <main class="flex-grow flex flex-col items-center w-full px-4 py-6 overflow-y-auto space-y-8">
            @foreach ($adhkar as $index => $dua)
                <div class="bg-[#182430] text-center p-6 rounded-2xl shadow-lg border border-[#233044] max-w-lg w-full"
                    x-data="{ count: 0, max: {{ $dua['count'] }} }">
                    {{-- Arabic --}}
                    <p class="text-2xl leading-relaxed  text-right font-[Scheherazade] mb-6 text-[#00FFD1] " dir="rtl">
                        {{ $dua['arabic'] }}
                    </p>

                    {{-- Ajami --}}
                    <p class="text-[#58A6FF] italic mb-4 text-lg text-left" dir="ltr">
                        {{ $dua['ajami'] }}
                    </p>

                    {{-- Hausa --}}
                    <p class="text-gray-300 text-sm mb-10 text-left" dir="ltr">
                        {{ $dua['hausa'] }}
                    </p>

                    {{-- Counter --}}
                    <button @click="if(count < max) count++; else count = 0"
                        class="mx-auto flex items-center justify-center bg-[#00FFD1] text-[#101E2B] w-16 h-16 rounded-full text-xl font-bold shadow-lg hover:bg-[#58A6FF] transition">
                        <span x-text="count + '/' + max"></span>
                    </button>
                </div>
            @endforeach
        </main>

        {{-- Footer --}}
        <footer class="w-full text-center py-4 text-sm text-gray-400">
            © 2025 FAHAX | Morning Adhkar
        </footer>

    </div>

    {{-- Alpine.js for counter logic --}}
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>


</x-layouts.app>
