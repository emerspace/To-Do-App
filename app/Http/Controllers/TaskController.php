<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TaskRevision;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::where('user_id', Auth::id());

        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('due_date')) {
            $query->whereDate('due_date', $request->due_date);
        }

        $tasks = $query->latest()->get();

        if ($request->ajax()) {
            return view('tasks.partials.list', compact('tasks'));
        }

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:to-do,in progress,done',
            'due_date' => 'required|date',
        ]);

        $task = Auth::user()->tasks()->create($validated);

        return redirect()->route('tasks.index')->with('success', 'Zadanie utworzone.');
    }

    public function edit(Task $task)
    {
        $this->authorize('update', $task);
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:to-do,in progress,done',
            'due_date' => 'required|date',
        ]);

        $old = $task->only(['title', 'description', 'priority', 'status', 'due_date']);
        $task->update($validated);
        $new = $task->only(['title', 'description', 'priority', 'status', 'due_date']);

        $changes = [];

        foreach ($old as $key => $value) {
            if ($old[$key] != $new[$key]) {
                $changes[$key] = [
                    'old' => $old[$key],
                    'new' => $new[$key],
                ];
            }
        }

        if (!empty($changes)) {
            TaskRevision::create([
                'task_id' => $task->id,
                'user_id' => auth()->id(),
                'changed_fields' => $changes,
            ]);
        }

        return redirect()->route('tasks.index')->with('success', 'Zadanie zaktualizowane.');
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Zadanie usunięte.');
    }

    public function show(Task $task)
    {
        $this->authorize('view', $task);
        return view('tasks.show', compact('task'));
    }
}
