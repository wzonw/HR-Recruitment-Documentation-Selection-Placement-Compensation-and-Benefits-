<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DocumentReqNotif extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct($user, $dept)
    {
        //
        $this->user = $user;
        $this->dept = $dept;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'employee_id' => $this->user->employee_id,
            'type_of_request' => 'Document Request',
            'reference_num' => $this->user->reference_num,
            'name_of_department' => $this->dept,
            'verdict' => $this->user->status,
        ];
    }
}
