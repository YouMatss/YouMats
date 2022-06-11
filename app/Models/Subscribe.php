<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscribe extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $dates = ['expiry_date'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vendor() {
        return $this->belongsTo(Vendor::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function membership() {
        return $this->belongsTo(Membership::class);
    }
}
