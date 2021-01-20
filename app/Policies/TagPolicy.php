<?php

namespace App\Policies;

use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class TagPolicy extends Policy {
    public static $key = 'tags';
}
