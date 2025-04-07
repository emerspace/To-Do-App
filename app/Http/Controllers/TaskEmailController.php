<?php

namespace App\Http\Controllers;

use App\Mail\TaskReminderMail;
use App\Models\Task;
use App\Jobs\SendTaskReminderJob;
use Illuminate\Support\Facades\Mail;

class TaskEmailController extends Controller
{
    public function sendReminder(Task $task)
    {
        $this->authorize('view', $task);

        Mail::to($task->user->email)->send(new TaskReminderMail($task));

        return back()->with('success', 'Wysłano przypomnienie!');
    }

    public function sendNow(Task $task)
    {
        $this->authorize('view', $task);

        // Wysyła e-mail natychmiast przez kolejkę
        SendTaskReminderJob::dispatch($task);

        return back()->with('success', 'E-mail z przypomnieniem został wysłany natychmiast.');
    }

    public function scheduleEmail(Task $task)
    {
        $this->authorize('view', $task);

        // Zaplanuj e-mail za 2 minuty od teraz
        SendTaskReminderJob::dispatch($task)->delay(now()->addMinutes(2));

        return back()->with('success', 'E-mail z przypomnieniem został zaplanowany na za 2 minuty.');
    }
}
