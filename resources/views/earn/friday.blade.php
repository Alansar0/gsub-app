<x-layouts.app>
    <div class="min-h-screen bg-[#0B141A] text-white flex flex-col items-center font-sans relative">
        {{-- Header --}}
        <header
            class="fixed top-0 left-0 right-0 z-40 bg-[#182430] border-b border-[#233044] shadow-[0_0_15px_rgba(88,166,255,0.25)] `">
            <div class="text-center py-4 relative">
                <a href="{{ url()->previous() }}"
                    class="absolute left-6 top-1/2 -translate-y-1/2 text-[#58a6ff] hover:underline flex items-center">
                    <i class="material-icons mr-1 text-[#58a6ff]">arrow_back</i>
                    Back
                </a>
                <h1 class="text-white text-xl font-semibold tracking-wide">Friday</h1>
            </div>

            {{-- Switcher --}}
            <div
                class="w-[65vw] mx-auto p-1 flex items-center justify-between bg-[#0C141C] rounded-full border border-[#00FFD1]/50 shadow-[0_0_20px_rgba(0,255,209,0.4)] mb-3 transition-all">
                <button id="showQuran"
                    class="flex-1 py-2 text-sm font-semibold rounded-full text-[#f0f6fc]
        bg-[#00FFD1]/30 hover:bg-[#00FFD1]/20 transition-all">
                    Surah Al-Kahf
                </button>

                <button id="showSalawat"
                    class="flex-1 py-2 text-sm font-semibold rounded-full text-[#f0f6fc]

        bg-[#00FFD1]/30 hover:bg-[#00FFD1]/20 transition-all">
                    Salli 'ala Annabi.
                </button>
            </div>
        </header>
        {{-- Surah List --}}

        <section id="QuranView" class="mt-[100px]">
            <div class="min-h-screen bg-[#0B141A] text-white flex flex-col items-center py-8 px-4 font-sans">

                {{-- Header --}}
                <header
                    class="w-full max-w-2xl flex items-center justify-between mb-4 border-b border-[#233044] pb-2 relative">
                    <!-- Page Number (Left) -->
                    <div class="absolute left-0 text-sm ">Page #{{ $page['page'] }}</div>

                    <!-- Surah Name (Centered) -->
                    <div class="mx-auto text-lg font-semibold text-[#00FFD1] text-center">
                        {{ $page['surah_name'] }}
                    </div>
                </header>


                {{-- Content --}}
                <div
                    class="w-full max-w-2xl bg-[#182430] border border-[#233044] rounded-2xl shadow-lg p-6 text-center text-white">
                    {!! $page['content'] !!}
                </div>
            </div>
        </section>

        {{-- Salawat Section --}}
        <section id="SalawatView" class="mt-[200px]">

            <div class="min-h-screen bg-[#101E2B] flex flex-col items-center justify-between text-white">

                {{-- Header --}}
                <header class="w-full bg-[#182430] mt-0 text-center py-4 shadow-md fixed top-25 z-10">
                    <span class="block text-center leading-relaxed">
                        <p dir="rtl" class="text-2xl font-arabic text-white">
                            قال رسول الله ﷺ: «أكثروا من الصلاة علي يوم الجمعة وليلة الجمعة، فإن صلاتكم معروضة عليّ»
                        </p>
                        <p class="mt-2 text-xs text-gray-400">— Hadith: Ibn Majah 1085</p>
                    </span>

                </header>

                -{{-- Main Dua Card --}}
                <main class="flex-grow flex flex-col items-center w-full px-4 py-6 overflow-y-auto space-y-8">
                    @foreach ($adhkar as $index => $dua)
                        <div class="bg-[#182430] text-center p-6 rounded-2xl shadow-lg border border-[#233044] max-w-lg w-full"
                            x-data="{ count: 0, max: {{ $dua['count'] }} }">
                            {{-- Arabic --}}
                            <p class="text-2xl leading-relaxed  text-right font-[Scheherazade] mb-6 text-[#00FFD1] "
                                dir="rtl">
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
                                class="mx-auto flex items-center justify-center bg-[#00FFD1] text-[#101E2B] w-18 h-18 rounded-full text-xl font-bold shadow-lg hover:bg-[#58A6FF] transition">
                                <span x-text="count + '/' + max"></span>
                            </button>
                        </div>
                    @endforeach
                </main>

                {{-- Footer --}}
                <div class="w-full bg-[#182430] text-center py-4 border-t border-[#233044] mt-4">
                    <span class="block text-center leading-relaxed">
                        <p dir="rtl" class="text-2xl font-arabic text-white">
                            فضل الصلاة على النبي ﷺ يوم الجمعة عظيم، فهي سبب لمغفرة الذنوب ورفع الدرجات.
                        </p>
                        <p class="mt-3 text-sm text-[#00FFD1] italic">
                            Yin salati ga Annabi (ﷺ) a ranar Jumma’a yana kawo albarka, gafara, da ƙarin lada daga
                            Allah.
                        </p>
                    </span>

                </div>

                {{-- Alpine.js for counter logic --}}
                <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

        </section>

        </section>

        <script>
            // Toggle between QuranView and SalawatView in the Friday page
            (function() {
                const qBtn = document.getElementById('showQuran');
                const sBtn = document.getElementById('showSalawat');
                const qView = document.getElementById('QuranView');
                const sView = document.getElementById('SalawatView');

                function show(target) {
                    if (!qView || !sView) return;
                    if (target === 'quran') {
                        qView.style.display = '';
                        sView.style.display = 'none';
                        qBtn.classList.add('bg-[#00FFD1]');
                        sBtn.classList.remove('bg-[#00FFD1]');
                    } else {
                        qView.style.display = 'none';
                        sView.style.display = '';
                        sBtn.classList.add('bg-[#00FFD1]');
                        qBtn.classList.remove('bg-[#00FFD1]');
                    }
                }

                // default: show QuranView
                show('quran');

                if (qBtn) qBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    show('quran');
                });
                if (sBtn) sBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    show('salawat');
                });
            })();
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const wrapper = document.getElementById('quranPageWrapper');
                const content = document.getElementById('quranPageContent');
                let startX = 0;
                const currentPage = {{ $page['page'] ?? 1 }};
                const baseUrl = '{{ route('earn.friday', ['id' => 1]) }}'; // will replace number dynamically

                // Handle touch start
                wrapper.addEventListener('touchstart', e => {
                    startX = e.touches[0].clientX;
                });

                // Handle touch end (detect swipe)
                wrapper.addEventListener('touchend', e => {
                    const endX = e.changedTouches[0].clientX;
                    const diff = startX - endX;

                    if (Math.abs(diff) > 50) { // threshold for swipe
                        if (diff > 0) {
                            // Swipe left → next
                            slideTo('next');
                        } else {
                            // Swipe right → previous
                            slideTo('prev');
                        }
                    }
                });

                function slideTo(direction) {
                    if (direction === 'next') {
                        content.classList.add('-translate-x-full');
                        setTimeout(() => {
                            window.location.href = baseUrl.replace('/1', '/' + (currentPage + 1));
                        }, 300);
                    } else if (direction === 'prev' && currentPage > 1) {
                        content.classList.add('translate-x-full');
                        setTimeout(() => {
                            window.location.href = baseUrl.replace('/1', '/' + (currentPage - 1));
                        }, 300);
                    }
                }
            });
        </script>

</x-layouts.app>
