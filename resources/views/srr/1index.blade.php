<x-layouts.app>
<div class="w-full bg-[#0d1117] text-[#f0f6fc] font-['Roboto'] min-h-screen p-6 flex flex-col items-center">

    <!-- Header -->
    <div class="text-center mt-6 mb-6">
        <div class="flex justify-center mb-4">
            <img src="https://cdn-icons-png.flaticon.com/512/2331/2331942.png"
                 alt="Help Icon"
                 class="w-20 h-20">
        </div>
        <h1 class="text-2xl font-bold text-[#58a6ff] mb-2">Help & Support</h1>
        <p class="text-gray-300 text-sm leading-relaxed max-w-sm mx-auto">
            How can we help you? <br>
            Our Customer Interaction Center offers 24/7 real-time assistance for all your enquiries.
        </p>
    </div>

    <!-- Dynamic FAQ Section -->
    <div class="w-full max-w-md space-y-3">
        @forelse($questions as $index => $q)
            @php
                $waLink = $q->whatsapp_link ?? 'https://wa.me/2348123456789'; // Default fallback
                $encoded = urlencode("Hello, I need help with: {$q->question}");
            @endphp

            <details class="bg-gradient-to-br from-[#182430] to-[#0C141C] border border-white/10 rounded-xl p-4">
                <summary class="cursor-pointer font-medium text-[#f0f6fc]">
                    {{ $index + 1 }}. {{ $q->question }}
                </summary>
                <div class="mt-2">
                    <a href="{{ $waLink }}?text={{ $encoded }}"
                       target="_blank"
                       class="text-[#58a6ff] text-sm hover:underline">
                        👉 Chat with Support on WhatsApp
                    </a>
                </div>
            </details>
        @empty
            <div class="bg-[#182430] text-gray-400 text-center p-6 rounded-xl border border-white/10">
                No support topics available yet. Please check back later.
            </div>
        @endforelse
    </div>

    <!-- Other Issues Button -->
    <div class="mt-8 w-full max-w-md">
        <button
            class="w-full bg-gradient-to-r from-[#58a6ff] to-[#1f6feb] text-white font-semibold py-3 rounded-xl hover:opacity-90 transition">
            Other Issues
        </button>
    </div>

</div>

</x-layouts.app>
