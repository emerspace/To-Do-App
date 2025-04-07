<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskRevisionController extends Controller
{
    public function index(Task $task)
    {
        $this->authorize('view', $task);

        $revisions = $task->revisions()->with('user')->latest()->get();

        return view('tasks.revisions', [
            'task' => $task,
            'revisions' => $revisions,
        ]);
    }
}