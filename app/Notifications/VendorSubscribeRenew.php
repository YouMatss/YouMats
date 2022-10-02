<?php

namespace App\Notifications;

use App\Models\Subscribe;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VendorSubscribeRenew extends Notification
{
    use Queueable;

    /**
     * @var Subscribe
     */
    private Subscribe $subscribe;


    /**
     * VendorSubscribeRenew constructor.
     * @param Subscribe $subscribe
     */
    public function __construct(Subscribe $subscribe)
    {
        $this->subscribe = $subscribe;
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

    public function toMail($notifiable) {}

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return \Mirovit\NovaNotifications\Notification::make()
            ->info('A Subscribe has been renewed.')
            ->subtitle('Vendor: ' . $this->subscribe->vendor->name . ' renewed his subscription.')
            ->routeDetail('subscribes', $this->subscribe->id)
            ->toArray();
    }
}
