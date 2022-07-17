<?php

namespace App\Models;

use App\Helpers\Traits\UnicodeJsonColumn;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trip extends Model
{
    use SoftDeletes, HasFactory, UnicodeJsonColumn;

    protected $guarded = ['id'];

    protected $dates = [
        'pickup_date',
        'started_at'
    ];

    protected $casts = [
        'pickup_location' => 'array',
        'destination_location' => 'array'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function driver() {
        return $this->belongsTo(Driver::class);
    }
}
