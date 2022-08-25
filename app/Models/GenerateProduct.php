<?php

namespace App\Models;

use App\Helpers\Traits\UnicodeJsonColumn;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GenerateProduct extends Model
{
    use HasFactory, UnicodeJsonColumn;

    protected $guarded = ['id'];

    protected $casts = [
        'template' => 'json'
    ];

    /**
     * @return BelongsTo
     */
    public function category() {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return BelongsTo
     */
    public function vendor() {
        return $this->belongsTo(Vendor::class);
    }
}
