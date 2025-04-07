@forelse ($tasks as $task)
    <div class="border-b border-gray-200 py-4">
        <div class="flex justify-between items-center">
        <div class="flex-grow">
                <h3 class="text-lg font-semibold text-gray-900 break-words whitespace-normal" style="max-width:64rem">
                    <a href="{{ route('tasks.edit', $task) }}">
                        {{ Str::limit($task->title, 255) }}
                    </a>
                </h3>
                <p class="text-sm text-gray-600 break-words whitespace-normal" style="max-width:64rem">{{ $task->description }}</p>
                <p class="text-sm mt-1">
                    Priorytet: <strong>{{ ucfirst($task->priority) }}</strong> |
                    Status: <strong>{{ ucfirst($task->status) }}</strong> |
                    Termin: <strong>{{ \Carbon\Carbon::parse($task->due_date)->format('Y-m-d') }}</strong>
                </p>
            </div>
            <div class="flex flex-col items-end space-y-1 w-40 shrink-0">
                <a href="{{ route('tasks.show', $task) }}" class="text-sm text-gray-500 hover:underline">Podgląd</a>
                <a href="{{ route('tasks.edit', $task) }}" class="text-sm text-indigo-600 hover:underline">Edytuj</a>
                <a href="{{ route('tasks.share', $task) }}" class="text-sm text-yellow-600 hover:underline">Udostępnij</a>
                <a href="{{ route('tasks.revisions.index', $task) }}" class="text-sm text-blue-600 hover:underline">Historia zmian</a>

                @if(auth()->user()->googleToken)
                    <form method="POST" action="{{ route('google.add.task', $task) }}">
                        @csrf
                        <button type="submit" class="text-sm text-red-500 hover:underline">Dodaj do Google Calendar</button>
                    </form>
                @endif

                <form method="POST" action="{{ route('tasks.send-now', $task) }}">
                    @csrf
                    <button type="submit" class="text-sm text-green-600 hover:underline">Wyślij email teraz</button>
                </form>
            </div>
        </div>
    </div>
@empty
    <p class="text-gray-500">Brak zadań do wyświetlenia.</p>
@endforelse
