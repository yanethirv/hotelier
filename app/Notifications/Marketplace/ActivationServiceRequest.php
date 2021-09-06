<?php

namespace App\Notifications\Marketplace;

use App\Models\ActivationServiceTransaction;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ActivationServiceRequest extends Notification
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
            ->subject('New Service Activation Request')
            ->markdown('emails.marketplace.activation-service-request-admin');
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
            'content' => 'The user '.$this->activationServiceTransaction->user->name. ' has requested activation of the service '.$this->activationServiceTransaction->activationService->name,
            'time' => Carbon::now()->diffForHumans(),
        ];
    }
}
