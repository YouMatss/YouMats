<?php

namespace App\Notifications;

use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ProductUpdated extends Notification
{
    use Queueable;

    protected Vendor $vendor;
    protected Product $product;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Vendor $vendor, Product $product)
    {
        $this->vendor = $vendor;
        $this->product = $product;
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
            ->info('A new product has been updated.')
            ->subtitle($this->vendor->name . ' Update product !')
            ->routeDetail('products', $this->product->id)
            ->toArray();
    }
}
