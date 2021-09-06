<?php

namespace App\Notifications\RequestManagement;

use App\Models\ServicesTransaction;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StatusService extends Notification
{
    use Queueable;

    public $servicesTransaction;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(ServicesTransaction $servicesTransaction)
    {
        $this->servicesTransaction = $servicesTransaction;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
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
            'content' => 'Your service request '.$this->servicesTransaction->service->name. ' has been changed to status '.$this->servicesTransaction->requestStatus->name,
            'time' => Carbon::now()->diffForHumans(),
        ];
    }
}
