<?php

protected function schedule(Schedule $schedule)
{
    $schedule->command('tasks:check-due')->everyMinute();
}

