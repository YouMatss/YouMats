<?php

namespace App\Helpers\Classes;

class Delivery
{
    private $cart;

    public function __construct($cart)
    {
        $this->cart = $cart;
    }

    public function get() {
        $delivery = 0;
        foreach ($this->cart as $item) {
            $product = $item->model;

            $deliveryIsExist = getDelivery($product, $item->qty);
            if(!is_null($deliveryIsExist)) {
                $delivery =+ round($deliveryIsExist['price'] / getCurrency('rate'), 2);
            }
        }

        return number_format($delivery, 2);
    }
}
