<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            {{ __('Historia zmian') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="mb-6">
                    <a href="{{ route('tasks.index') }}" class="text-sm text-gray-600 hover:underline">←Wróć do listy zadań</a>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-4 break-words whitespace-normal">Zadanie: {{ $task->title }}</h3>

                @forelse ($revisions as $revision)
                    <div class="border-b py-4">
                        <p class="text-sm text-gray-600">
                            <strong>Zmieniono:</strong> {{ $revision->updated_at->format('Y-m-d H:i') }}<br>
                            <strong>Zmiany:</strong>
                        </p>
                        @if(is_array($revision->changed_fields))
                            <ul class="list-disc list-inside text-sm text-gray-700">
                                @foreach($revision->changed_fields as $field => $change)
                                    <li>{{ ucfirst($field) }}: "{{ $change['old'] }}" → "{{ $change['new'] }}"</li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-sm text-gray-500 italic">Brak szczegółowych danych o zmianach.</p>
                        @endif
                    </div>
                @empty
                    <p class="text-sm text-gray-500">Brak zarejestrowanych zmian.</p>
                @endforelse


            </div>
        </div>
    </div>
</x-app-layout>