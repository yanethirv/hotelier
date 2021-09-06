<?php

namespace App\Notifications\Marketplace;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ChargeSucceeded extends Notification
{
    use Queueable;

    public $payload;
    public $customer;
    public $description;
    public $amount;
    public $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($payload)
    {
        $this->payload = $payload;
        $this->customer = $payload['data']['object']['customer'];
        $this->description = $payload['data']['object']['description'];
        $this->amount = $payload['data']['object']['amount']/100;
        $this->user = User::where('stripe_id', $this->customer)->first();
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
            'user' => $this->user->name,
            'description' => $this->description,
            'amount' => $this->amount,
            'time' => Carbon::now()->diffForHumans(),
        ];
    }
}
