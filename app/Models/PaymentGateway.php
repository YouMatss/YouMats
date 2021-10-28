<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class PaymentGateway extends Model
{
    use HasFactory, SoftDeletes, HasTranslations;

    protected $translatable = ['name', 'subtitle', 'description'];

    public function getValueAttribute() {
        if(!isset($this->getTranslations('name')['en']))
            return;
        return $this->getTranslations('name')['en'];
    }
}
