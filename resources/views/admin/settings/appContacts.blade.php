<x-layouts.admin>

<div class="max-w-3xl mx-auto mt-10 text-[#f0f6fc]">
    <h2 class="text-2xl font-semibold mb-6">Manage Contact Support Questions</h2>

    <form action="{{ route('S.contactAction') }}" method="POST">
        @csrf

        <div id="questionsContainer" class="space-y-4">
            @foreach($questions as $index => $q)
            <div class="bg-[#182430] p-4 rounded-lg flex gap-4">
                <input type="text" name="questions[{{ $index }}][question]" value="{{ $q->question }}"
                    placeholder="Enter question"
                    class="w-1/2 p-2 rounded bg-[#0d1117] border border-gray-700 text-[#f0f6fc]" />

                <input type="text" name="questions[{{ $index }}][whatsapp_link]" value="{{ $q->whatsapp_link }}"
                    placeholder="WhatsApp link (optional)"
                    class="w-1/2 p-2 rounded bg-[#0d1117] border border-gray-700 text-[#f0f6fc]" />
            </div>
            @endforeach
        </div>

        <button type="button" id="addQuestion"
            class="mt-4 bg-[#58a6ff] px-4 py-2 rounded-lg text-sm hover:bg-[#1f2e3b]">+ Add Question</button>

        <button type="submit"
            class="mt-4 bg-green-600 px-4 py-2 rounded-lg text-sm hover:bg-green-700">Save Changes</button>
    </form>
</div>

<script>
document.getElementById('addQuestion').addEventListener('click', () => {
    const container = document.getElementById('questionsContainer');
    const index = container.children.length;
    const block = `
        <div class="bg-[#182430] p-4 rounded-lg flex gap-4">
            <input type="text" name="questions[${index}][question]" placeholder="Enter question"
                class="w-1/2 p-2 rounded bg-[#0d1117] border border-gray-700 text-[#f0f6fc]" />
            <input type="text" name="questions[${index}][whatsapp_link]" placeholder="WhatsApp link (optional)"
                class="w-1/2 p-2 rounded bg-[#0d1117] border border-gray-700 text-[#f0f6fc]" />
        </div>`;
    container.insertAdjacentHTML('beforeend', block);
});
</script>
</x-layouts.admin>
