<x-layouts.app>
  <div class="text-center text-white bg-[#0d0d0f] min-h-screen flex flex-col justify-center">
      <h1 class="text-2xl font-bold text-[#58a6ff] mb-4">My Wallet</h1>
      <p class="text-gray-300 text-lg">Balance: ₦{{number_format($wallet->balance, 2)}}</p>
  </div>
</x-layouts.app>
