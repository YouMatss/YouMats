<?php

namespace App\Notifications;

use App\Models\Membership;
use App\Models\Subscribe;
use App\Models\Vendor;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class VendorSubscribed extends Notification
{
    use Queueable;

    private Vendor $vendor;
    private Membership $membership;
    private Subscribe $subscribe;

    /**
     * VendorSubscribed constructor.
     * @param Vendor $vendor
     * @param Membership $membership
     * @param Subscribe $subscribe
     */
    public function __construct(Vendor $vendor, Membership $membership, Subscribe $subscribe)
    {
        $this->vendor = $vendor;
        $this->membership = $membership;
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
            ->info('A vendor has been subscribed.')
            ->subtitle('Vendor: ' . $this->vendor->name . ' Subscribed to an ' . $this->membership->name . ' plan.')
            ->routeDetail('subscribes', $this->subscribe->id)
            ->toArray();
    }
}
