<?php

namespace App\Notifications;

use App\User;
use App\Models\Enquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewEnquiry extends Notification
{
    use Queueable;
    public $enquiry;
    public $company;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Enquiry $enquiry, User $company)
    {
        $this->enquiry = $enquiry;
        $this->company = $company;
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
                    ->greeting('Hello '. $this->enquiry->customer->fullname .'!')
                    ->line('Thanks for enquiry in ' . $this->company->company_name)
                    ->line('We hope you enjoy the new styles you bought!')
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
            'id' => $this->id,
            'read_at' => null,
            'data' => [
                'message' =>  'Enquiry added successfully!',
                'icon' => '/img/sidebar/sale.png',
                'link' => '/enquiries/'.$this->enquiry->id,
                'type' => 'enquiries'
            ]
        ];
    }

    public function toDatabase($notifiable)
    {
        return [
            'id' => $this->id,
            'read_at' => null,
            'message' =>  'Enquiry added successfully!',
            'icon' => '/img/sidebar/sale.png',
            'link' => '/enquiries/'.$this->enquiry->id,
            'type' => 'enquiries'
        ];
    }
}
