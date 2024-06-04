<?php

namespace App\Listeners;

use App\Events\FileRemarksChanged;
use App\Models\User;
use App\Notifications\FileRemarks;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use Illuminate\Queue\InteractsWithQueue;

class UpdateFileRemarks
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
    public function handle(FileRemarksChanged $event): void
    {
        //
        $event->user->file = json_decode($event->user->file);
        $event->user->file_remarks = json_decode($event->user->file_remarks);
        $admins = User::where('application_id', $event->user->id)->get();
        Notification::send($admins, new FileRemarks($event->user, $event->index));
    }
}
