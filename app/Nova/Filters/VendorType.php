<?php

namespace App\Nova\Filters;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Filters\Filter;

class VendorType extends Filter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'select-filter';

    /**
     * Apply the filter to the given query.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(Request $request, $query, $value)
    {
        if($value == 'have-products-contacts')
            return $query->select('vendors.*')
                ->join('products', 'products.vendor_id', 'vendors.id')
                ->whereNull('products.deleted_at')
                ->where('vendors.contacts', '!=', '[]')
                ->groupBy(['vendors.id'])
                ->havingRaw('COUNT(products.id) > ?', [0]);
        elseif($value == 'have-products-no-contacts')
            return $query->select('vendors.*')
                ->join('products', 'products.vendor_id', 'vendors.id')
                ->whereNull('products.deleted_at')
                ->where('vendors.contacts', '[]')
                ->groupBy(['vendors.id'])
                ->havingRaw('COUNT(products.id) > ?', [0]);
        elseif($value == 'have-not-products')
            return $query->select('vendors.*')
                ->leftJoin('products', 'products.vendor_id', 'vendors.id')
                ->groupBy(['vendors.id'])
                ->havingRaw('COUNT(products.id) = ?', [0]);
        elseif($value == 'have-products-but-soft-deleted')
            return $query->select('vendors.*')
                ->leftJoin('products', 'products.vendor_id', 'vendors.id')
                ->whereNotNull('products.deleted_at')
                ->groupBy(['vendors.id'])
                ->havingRaw('COUNT(products.id) = (SELECT COUNT(`products`.`id`) FROM `products` WHERE `products`.`vendor_id` = `vendors`.`id`)');
    }

    /**
     * Get the filter's available options.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function options(Request $request)
    {
        return [
            'Have Products & Contacts' => 'have-products-contacts',
            'Have Products & No Contacts' => 'have-products-no-contacts',
            'Haven\'t Products' => 'have-not-products',
            'Have Products But SoftDeleted' => 'have-products-but-soft-deleted'
        ];
    }
}
