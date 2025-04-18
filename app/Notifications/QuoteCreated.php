<?php

namespace App\Notifications;

use App\Models\Quote;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;

class QuoteCreated extends Notification
{
    use Queueable;

    protected User $user;
    protected Quote $quote;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, Quote $quote)
    {
        $this->user  = $user;
        $this->quote = $quote;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return \Mirovit\NovaNotifications\Notification::make()
            ->info('A new quote has been placed.')
            ->subtitle('There is a new quote in the system - Placed by:' . $this->user->name . '!')
            ->routeDetail('quotes', $this->quote->id)
            ->toArray();
    }
}
