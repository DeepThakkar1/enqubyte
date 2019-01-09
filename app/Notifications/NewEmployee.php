<?php

namespace App\Notifications;
use App\User;
use App\Models\Employee;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
class NewEmployee extends Notification
{
    use Queueable;
    public $employee;
    public $company;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Employee $employee, User $company)
    {
        $this->employee = $employee;
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
                    ->greeting('Hello!')
                    ->line('You received an login credential as an employee for ' . $this->company->name)
                    ->line('Email : '.$this->employee->email)
                    ->line('Password : '. $this->employee->password)
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
            'id' => $this->id,
            'read_at' => null,
            'data' => [
                'message' =>  'Employee added successfully!',
                'icon' => '/img/sidebar/employee.png',
                'link' => '/employees/'.$this->employee->id,
                'type' => 'employees'
            ]
        ];
    }

    public function toDatabase($notifiable)
    {
        return [
            'id' => $this->id,
            'read_at' => null,
            'message' =>  'Employee added successfully!',
            'icon' => '/img/sidebar/employee.png',
            'link' => '/employees/'.$this->employee->id,
            'type' => 'employees'
        ];
    }
}
