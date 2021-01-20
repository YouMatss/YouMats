<?php

namespace App\Policies;

use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class CurrencyPolicy extends Policy {
    public static $key = 'currencies';
}

