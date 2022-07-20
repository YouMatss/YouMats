<?php

namespace App\Notifications;

use App\Models\Membership;
use App\Models\Subscribe;
use App\Models\Vendor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VendorSubscribeCanceled extends Notification
{
    use Queueable;

    private Vendor $vendor;
    private Subscribe $subscribe;

    /**
     * VendorSubscribeCanceled constructor.
     * @param Vendor $vendor
     * @param Subscribe $subscribe
     */
    public function __construct(Vendor $vendor, Subscribe $subscribe)
    {
        $this->vendor = $vendor;
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

    public function toMail($notifiable){}

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return \Mirovit\NovaNotifications\Notification::make()
            ->info('A vendor cancels his subscription.')
            ->subtitle('Vendor: ' . $this->vendor->name . ' cancels his subscription!')
            ->routeDetail('subscribes', $this->subscribe->id)
            ->toArray();
    }
}
