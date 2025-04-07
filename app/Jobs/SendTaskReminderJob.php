<?php

namespace App\Jobs;

use App\Mail\TaskReminderMail;
use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendTaskReminderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Task $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function handle(): void
    {
        Log::info('Wysyłanie maila do: ' . $this->task->user->email);
        Mail::to($this->task->user->email)->send(new TaskReminderMail($this->task));
    }
}
