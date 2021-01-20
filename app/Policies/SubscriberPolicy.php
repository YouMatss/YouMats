<?php

namespace App\Policies;

use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubscriberPolicy extends Policy {
    public static $key = 'subscribers';
}
