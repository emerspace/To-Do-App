<h2>Hej {{ $task->user->name }},</h2>

<p>Przypomnienie o zadaniu:</p>

<ul>
    <li><strong>Tytuł:</strong> {{ $task->title }}</li>
    <li><strong>Opis:</strong> {{ $task->description }}</li>
    <li><strong>Status:</strong> {{ ucfirst($task->status) }}</li>
    <li><strong>Priorytet:</strong> {{ ucfirst($task->priority) }}</li>
    <li><strong>Termin:</strong> {{ \Carbon\Carbon::parse($task->due_date)->format('Y-m-d H:i') }}</li>
</ul>

<p><a href="{{ route('tasks.show', $task) }}">Zobacz zadanie</a></p>
