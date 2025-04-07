<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ $task->title }}</h3>

                <p class="text-gray-700 mb-2">
                    <strong>Opis:</strong><br>
                    {{ $task->description ?? 'Brak opisu' }}
                </p>

                <p class="text-gray-700 mb-2">
                    <strong>Priorytet:</strong> {{ ucfirst($task->priority) }}<br>
                    <strong>Status:</strong> {{ ucfirst($task->status) }}<br>
                    <strong>Termin:</strong> {{ \Carbon\Carbon::parse($task->due_date)->format('Y-m-d') }}
                </p>
            </div>
        </div>
    </div>
</x-app-layout>