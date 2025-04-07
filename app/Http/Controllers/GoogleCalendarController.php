<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\UserGoogleToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\GoogleCalendar\Event;
use Carbon\Carbon;
use Laravel\Socialite\Facades\Socialite;

class GoogleCalendarController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')
            ->scopes(['https://www.googleapis.com/auth/calendar'])
            ->redirect();
    }

    public function callback()
    {
        $googleUser = Socialite::driver('google')->user();

        UserGoogleToken::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'google_id' => $googleUser->getId(),
                'access_token' => $googleUser->token,
                'refresh_token' => $googleUser->refreshToken,
                'expires_at' => Carbon::now()->addSeconds($googleUser->expiresIn),
            ]
        );

        return redirect()->route('dashboard')->with('success', 'Google Calendar połączony.');
    }

    public function addTask(Task $task)
    {
        $this->authorize('view', $task);

        $event = new Event;
        $event->name = $task->title;
        $event->description = $task->description;
        $event->startDate = Carbon::parse($task->due_date)->startOfDay();
        $event->endDate = Carbon::parse($task->due_date)->endOfDay();
        $event->save();

        return back()->with('success', 'Zadanie dodane do Google Calendar.');
    }
}