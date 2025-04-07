<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Task;
use App\Jobs\SendTaskReminderEmail;
use Illuminate\Support\Carbon;

class CheckDueTasks extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-due-tasks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();
        $soon = $now->copy()->addDay();
    
        $tasks = Task::whereNull('notified_at')
            ->whereBetween('due_date', [$now, $soon])
            ->get();
    
        foreach ($tasks as $task) {
            dispatch(new SendTaskReminderEmail($task))->delay(now()->addMinute());
    
            $task->notified_at = now();
            $task->save();
        }
    
        $this->info("Zadania zaplanowane do powiadomień: " . $tasks->count());
    }
}
