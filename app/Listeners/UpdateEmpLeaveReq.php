<?php

namespace App\Listeners;

use App\Events\LeaveReqApproval;
use App\Models\Employee;
use App\Models\User;
use App\Notifications\LeaveReqNotif;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class UpdateEmpLeaveReq
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
    public function handle(LeaveReqApproval $event): void
    {
        //
        $admins = Employee::where('employee_id', $event->user->employee_id)->get();
        Notification::send($admins, new LeaveReqNotif($event->user, $event->dept));
    }
}
