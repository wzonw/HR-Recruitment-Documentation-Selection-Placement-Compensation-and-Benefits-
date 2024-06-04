<?php

namespace App\Listeners;

use App\Events\StatusChanged;
use App\Models\User;
use App\Notifications\NewStatus;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use Illuminate\Queue\InteractsWithQueue;

class UpdateApplicantAboutStatus
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(StatusChanged $event): void
    {
        //
        $admins = User::where('application_id', $event->user->id)->get();
        Notification::send($admins, new NewStatus($event->user));
    }
}
