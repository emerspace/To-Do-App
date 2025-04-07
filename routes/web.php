<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskShareLinkController;
use App\Http\Controllers\TaskRevisionController;
use App\Http\Controllers\GoogleCalendarController;
use App\Http\Controllers\TaskEmailController;

Route::get('/', function () {
    return redirect()->route('tasks.index');
});

// Autoryzacja
require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('tasks.index');
    })->name('dashboard');

    Route::get('/profile', function () {
        return redirect()->route('tasks.index');
    })->name('profile.edit');

    // Zadania
    Route::resource('tasks', TaskController::class);

    // Historia zmian
    Route::get('/tasks/{task}/revisions', [TaskRevisionController::class, 'index'])
        ->name('tasks.revisions.index');

    // Udostępnianie
    Route::get('/tasks/{task}/share', [TaskShareLinkController::class, 'index'])
        ->name('tasks.share');

    Route::post('/tasks/{task}/share', [TaskShareLinkController::class, 'store'])
        ->name('tasks.share.store');

    Route::delete('/share/{link}', [TaskShareLinkController::class, 'destroy'])
        ->name('tasks.share.destroy');

    // Google Calendar
    Route::get('/google/redirect', [GoogleCalendarController::class, 'redirect'])
        ->name('google.redirect');

    Route::get('/oauth2callback', [GoogleCalendarController::class, 'callback'])
        ->name('google.callback');

    Route::post('/tasks/{task}/calendar', [GoogleCalendarController::class, 'addTask'])
        ->name('google.add.task');

    // Mailing
    Route::post('/tasks/{task}/remind', [TaskEmailController::class, 'sendReminder'])
        ->name('tasks.email.reminder');

    Route::post('/tasks/{task}/send-now', [TaskEmailController::class, 'sendNow'])->name('tasks.send-now');
    // Route::post('/tasks/{task}/schedule-email', [TaskEmailController::class, 'scheduleEmail'])->name('tasks.schedule-email');
        

});

// Publiczny dostęp przez token
Route::get('/share/{token}', [TaskShareLinkController::class, 'showShared'])
    ->name('tasks.shared.show');


    