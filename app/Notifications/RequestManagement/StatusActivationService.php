<?php

namespace App\Notifications\RequestManagement;

use App\Models\ActivationServiceTransaction;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StatusActivationService extends Notification
{
    use Queueable;

    public $activationServiceTransaction;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(ActivationServiceTransaction $activationServiceTransaction)
    {
        $this->activationServiceTransaction = $activationServiceTransaction;
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
            'content' => 'Your service activation request '.$this->activationServiceTransaction->activationService->name. ' has been changed to status '.$this->activationServiceTransaction->requestStatus->name,
            'time' => Carbon::now()->diffForHumans(),
        ];
    }
}