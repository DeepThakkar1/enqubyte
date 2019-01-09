<?php

namespace App\Notifications;
use App\User;
use App\Models\Invoice;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewInvoice extends Notification
{
    use Queueable;
    public $invoice;
    public $company;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Invoice $invoice, User $company)
    {
        $this->invoice = $invoice;
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
                    ->greeting('Hello '. $this->invoice->customer->fullname .'!')
                    ->line('Thanks for purchase from ' . $this->company->company_name)
                    ->line('We hope you enjoy the new styles you bought!')
                    ->line('Visit again!');
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
                'message' =>  'Invoice added successfully!',
                'icon' => '/img/sidebar/sale.png',
                'link' => '/invoices/'.$this->invoice->id,
                'type' => 'invoices'
            ]
        ];
    }

    public function toDatabase($notifiable)
    {
        return [
            'id' => $this->id,
            'read_at' => null,
            'message' =>  'Invoice added successfully!',
            'icon' => '/img/sidebar/sale.png',
            'link' => '/invoices/'.$this->invoice->id,
            'type' => 'invoices'
        ];
    }
}
