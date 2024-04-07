<?php

namespace App\Listeners;

use App\Events\DocumentRequestNotif;
use App\Models\User;
use App\Notifications\DocumentReqNotif;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class UpdateEmpDocuReq
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
    public function handle(DocumentRequestNotif $event): void
    {
        //
        $admin = User::where('id', $event->user->emp_id)->get();
        Notification::send($admin, new DocumentReqNotif($event->user));
    }
}
