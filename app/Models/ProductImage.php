<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductImage extends Model
{
    use HasFactory;

    protected $table = 'product_images';

    protected $fillable = [
        'product_id',
        'file_path',
        'order',
        'alt',
    ];

    protected $casts = [
        'order' => 'integer',
    ];

    /**
     * Relación inversa hacia Product.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}