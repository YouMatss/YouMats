<?php

namespace App\Helpers\Classes;

class Shipping
{
    public static function remap($shipping_prices, $flexible = true) {
        $arr = [];
        if($flexible) {
            foreach ($shipping_prices as $price) {
                foreach ($price['attributes']['cities'] as $city) {
                    $arr[$city['attributes']['city']][] = [
                        'car' => $price['attributes']['car_type'],
                        'quantity' => $city['attributes']['quantity'],
                        'price' => $city['attributes']['price'],
                        'time' => $city['attributes']['time'],
                        'format' => $city['attributes']['format']
                    ];
                }
            }
        } else {
            foreach ($shipping_prices as $price) {
                foreach ($price['attributes']['cities'] as $city) {
                    $arr[$city['city']][] = [
                        'car' => $price['attributes']['car_type'],
                        'quantity' => $city['quantity'],
                        'price' => $city['price'],
                        'time' => $city['time'],
                        'format' => $city['format']
                    ];
                }
            }
        }
        return $arr;
    }

    public static function getBestPrice($cars, $quantity, $selected_cars = []) {
        $cheapest_car = self::getCheapestCar($cars);
        $cheapest_car_quantity = $cheapest_car['quantity'];

        $car_count = intdiv($quantity, $cheapest_car['quantity']);

        if($quantity >= $cheapest_car_quantity) {
            $rest_quantity = (int)fmod($quantity, $cheapest_car['quantity']);

            $cheapest_car['count'] = $car_count;
            $selected_cars[] = $cheapest_car;

            if($rest_quantity > 0) {
                return self::getBestPrice($cars, $rest_quantity, $selected_cars);
            } else {
                return $selected_cars;
            }
        } elseif($quantity < $cheapest_car_quantity) {
            $cheapest_car = self::getCheapestCarBySpecificQuantity($cars, $quantity);
            $car_count = intdiv($quantity, $cheapest_car['quantity']);
            if($car_count == 0) {
                $car_count = 1;
                $cheapest_car['count'] = $car_count;
                $selected_cars[] = $cheapest_car;
                return $selected_cars;
            } else {
                $rest_quantity = (int)fmod($quantity, $cheapest_car['quantity']);
                return self::getBestPrice($cars, $rest_quantity, $selected_cars);
            }
        }
    }

    private static function getCheapestCar($cars) {
        $cheapest_car = $cars[0];
        $cheapest_avg = $cars[0]['price'] / $cars[0]['quantity'];
        foreach ($cars as $key => $car) {
            if($key == 0) continue;
            $avg = $car['price'] / $car['quantity'];
            if($cheapest_avg > $avg) {
                $cheapest_car = $car;
                $cheapest_avg = $avg;
            } elseif($cheapest_avg == $avg && $cheapest_car['quantity'] < $car['quantity']) {
                $cheapest_car = $car;
                $cheapest_avg = $avg;
            }
        }
        return $cheapest_car;
    }

    private static function getCheapestCarBySpecificQuantity($cars, $quantity) {
        $cheapest_car = null;
        $cheapest_avg = PHP_INT_MAX;
        foreach ($cars as $key => $car) {
            if($car['quantity'] >= $quantity) {
                $avg = $car['price'] / $quantity;
            } else {
                $avg = ($car['price'] * ceil($quantity/$car['quantity'])) / $quantity;
            }

            if($cheapest_avg > $avg) {
                $cheapest_car = $car;
                $cheapest_avg = $avg;
            } elseif($cheapest_avg == $avg && $cheapest_car['quantity'] < $car['quantity']) {
                $cheapest_car = $car;
                $cheapest_avg = $avg;
            }
        }
        return $cheapest_car;
    }

    public static function result($cars) {
        $price = 0;
        $maxTime = 0;
        $format = 'hour';
        foreach ($cars as $car) {
            $price += $car['price'] * $car['count'];
            if($maxTime < $car['time'] && $car['format'] == 'day') {
                $maxTime = $car['time'];
                $format = 'day';
            }
        }
        return [
            'price' => $price,
            'time' => $maxTime,
            'format' => $format
        ];
    }

}
