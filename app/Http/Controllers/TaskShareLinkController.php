<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskShareLink;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TaskShareLinkController extends Controller
{
    use AuthorizesRequests;

    public function index(Task $task)
    {
        $this->authorize('view', $task);
        return view('tasks.share', [
            'task' => $task,
            'links' => $task->shareLinks()->where('expires_at', '>', now())->get()
        ]);
    }

    public function store(Task $task)
    {
        $this->authorize('update', $task);

        $token = Str::uuid();
        $expiresAt = now()->addMinutes(Config::get('app.share_link_expiration', 1440));

        $link = $task->shareLinks()->create([
            'token' => $token,
            'expires_at' => $expiresAt,
        ]);

        return back()->with('success', 'Link wygenerowany: ' . route('tasks.shared.show', $token));
    }

    public function destroy(TaskShareLink $link)
    {
        $this->authorize('delete', $link->task);
        $link->delete();

        return back()->with('success', 'Link usunięty.');
    }

    public function showShared(string $token)
    {
        $link = TaskShareLink::where('token', $token)
            ->where('expires_at', '>', now())
            ->firstOrFail();

        return view('tasks.shared', ['task' => $link->task]);
    }
}