<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserActionNotification extends Notification
{
    use Queueable;

    public $user, $message;
    
    /**
     * Create a new notification instance.
     */
    public function __construct($user, $message)
    {
        //
        $this->user = $user;
        $this->message = $message;
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
    // public function toMail(object $notifiable): MailMessage
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    // }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
            'email' => $this->user->email,
            'name' => $this->user->first_name.' '.$this->user->last_name,
            'image' => $this->user->image,
            'message' => $this->message,

        ];
    }

    // public function toDatabase($notifiable)
    // {
    //     return [
    //         'message' => $this->message,
    //         // Add more details if needed
    //     ];
    // }
    
}