<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class VendorBranch extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = ['name', 'website', 'fax', 'phone_number', 'latitude', 'longitude', 'address', 'vendor_id'];

    /**
     * @var string[]
     */
    protected $translatable = ['name'];

    /**
     * @return BelongsTo
     */
    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }
}
