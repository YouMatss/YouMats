<?php

namespace App\Notifications;

use App\Models\GenerateProduct;
use App\Models\Vendor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class GenerateProductsRequest extends Notification
{
    use Queueable;

    protected Vendor $vendor;
    protected GenerateProduct $generateProducts;


    public function __construct(Vendor $vendor, GenerateProduct $generateProducts)
    {
        $this->vendor = $vendor;
        $this->generateProducts = $generateProducts;
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
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     */
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
            ->info('A new request products generate has been requested.')
            ->subtitle('There is a new request in the system - Created by:' . $this->vendor->name . '!')
            ->routeDetail('generate-products', $this->generateProducts->id)
            ->toArray();
    }
}
