<?php

namespace App\Notifications;
use App\Models\RequestDemo;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class DemoCredential extends Notification
{
    use Queueable;
    public $demo;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(RequestDemo $demo)
    {
        $this->demo = $demo;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->greeting('Hello '. $this->demo->fname .' '. $this->demo->lname .'!')
                    ->line('You received an requested login credential for demo on Enqubyte.')
                    ->line('username : sample')
                    ->line('Password : Password')
                    ->action('Login', url('/login'))
                    ->line('Thank you for using Enqubyte!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
