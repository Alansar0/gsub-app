<x-layouts.app>

    <div class="bg-[#0d0d0f] text-white min-h-screen p-4 font-sans">


        <div class=" w-full flex justify-start mt-6 mb-4">
            <a href="{{ url()->previous() }}" class="text-[#58a6ff] hover:underline flex items-center">
                <i class="material-icons mr-1">arrow_back</i> Back
            </a>
        </div>
        <!-- Header -->
        <div class="flex items-center justify-center mb-6">
            <h1 class="text-lg font-semibold">Bank Transfer</h1>
        </div>
        {{-- @if ($bank->isEmpty())
            <div class="text-center py-10">
                <p class="text-gray-400 text-sm">No bank account added yet.</p>
            </div>
        @endif --}}
        <!-- Bank Cards -->
        <div class="space-y-4">
            {{-- @foreach ($banks as $bank) --}}
             <!-- Bank Palmpay -->
            <div class="border border-gray-700 rounded-xl p-4">
                <p class="text-gray-300 mb-2 font-medium">Bank Palmpay</p>
                <div class="flex items-center mb-2">
                    <div class="flex items-center bg-blue-900 text-blue-200 px-3 py-1 rounded-lg text-sm font-semibold">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 16h8M8 12h8m-6 8h6a2 2 0 002-2V6a2 2 0 00-2-2h-6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        {{ $wallet->account_number }}
                    </div>
                </div>
                <p class="text-gray-400 text-sm">Cool Data - AHMAD SAADU NUHU</p>
            </div>
            {{-- @endforeach --}}
        </div>
        {{-- @endif --}}
    </div>

</x-layouts.app>
