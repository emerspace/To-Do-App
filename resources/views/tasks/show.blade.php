<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            Podgląd zadania
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded p-6">
                <div class="mb-6">
                    <a href="{{ route('tasks.index') }}" class="text-sm text-gray-600 hover:underline">← Wróć do listy zadań</a>
                </div>
                <h3 class="text-2xl font-bold mb-4 break-words whitespace-normal">
                    {{ $task->title }}
                </h3>
                <p class="text-gray-700 mb-4 break-words whitespace-normal">
                    {{ $task->description }}
                </p>

                <ul class="text-sm text-gray-600 space-y-1">
                    <li><strong>Priorytet:</strong> {{ ucfirst($task->priority) }}</li>
                    <li><strong>Status:</strong> {{ ucfirst($task->status) }}</li>
                    <li><strong>Termin:</strong> {{ \Carbon\Carbon::parse($task->due_date)->format('Y-m-d') }}</li>
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
