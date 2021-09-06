<?php

namespace App\Notifications\Marketplace;

use App\Models\SubscriptionsTransaction;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SubscriptionRequest extends Notification
{
    use Queueable;

    public $subscriptionTransaction;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(SubscriptionsTransaction $subscriptionTransaction)
    {
        $this->subscriptionTransaction = $subscriptionTransaction;
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
            'content' => 'The user '.$this->subscriptionTransaction->user->name. ' has requested activation of the subscription '.$this->subscriptionTransaction->marketplaceSubscription->subscription_name,
            'time' => Carbon::now()->diffForHumans(),
        ];
    }
}
