<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Task;
use App\Jobs\SendTaskReminderJob;
use Carbon\Carbon;
use App\Mail\TaskReminder;
use Illuminate\Support\Facades\Mail;

class SendUpcomingTaskReminders extends Command
{

        /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send_upcoming-task-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public function handle()
    {
        Mail::to($this->task->user->email)
            ->send(new TaskReminder($this->task));
    }
}
