<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Category;
use App\Models\Entrepreneurship;
use App\Models\ProductImage;
use App\Models\Send;
use App\Models\Review;

class Product extends Model
{
    use HasFactory;

    protected $perPage = 5;

    // Dejo media_file fuera del $fillable porque vamos a mover las imágenes a product_images.
    protected $fillable = [
        'name',
        'quantity',
        'description',
        'price',
        'category_id',
        'user_id',
        'entrepreneurship_id',
    ];

    /**
     * Si quieres que la propiedad `images_or_fallback` esté siempre disponible
     * en la serialización del modelo (por ejemplo al usar toArray()/toJson()),
     * descomenta $appends. Si no, puedes llamarla con $product->images_or_fallback.
     */
    protected $appends = [
        // 'images_or_fallback',
    ];

    // Relaciones existentes
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function entrepreneurship()
    {
        return $this->belongsTo(Entrepreneurship::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function send()
    {
        return $this->hasMany(Send::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // NUEVA: relación con la tabla product_images (todas las imágenes, ordenadas por 'order')
    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class)->orderBy('order');
    }

    // NUEVA: relación one-of-many para obtener la imagen "portada" (la de menor 'order')
    public function firstImage(): HasOne
    {
        // ofMany('order','min') selecciona la fila con el mínimo valor en 'order'
        return $this->hasOne(ProductImage::class)->ofMany('order', 'min');
    }

    /**
     * Helper: retorna un array de rutas de imágenes.
     * - Primero intenta la relación product_images.
     * - Si no hay imágenes relacionadas, hace fallback a media_file (si aún existe en la tabla).
     *
     * Uso: $product->images_or_fallback (o $product->images_or_fallback[0] para la primera)
     *
     * NOTA: los paths retornados son los valores almacenados en DB (ej. "products/abc.jpg").
     * En las vistas usa Storage::url($path) o asset('storage/'.$path) para generar la URL pública.
     */
    public function getImagesOrFallbackAttribute(): array
    {
        // Si la relación ya fue cargada (eager loaded), usamos la colección para evitar otra query.
        if ($this->relationLoaded('images')) {
            $imgs = $this->images->pluck('file_path')->filter()->values()->toArray();
            if (!empty($imgs)) {
                return $imgs;
            }
        } else {
            // Si no está cargada, consultamos la DB ordenada por 'order'
            $imgs = $this->images()->orderBy('order')->pluck('file_path')->filter()->toArray();
            if (!empty($imgs)) {
                return $imgs;
            }
        }

        // Fallback temporal: en caso de que todavía exista la columna media_file
        if (!empty($this->media_file)) {
            $maybe = @json_decode($this->media_file, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($maybe) && count($maybe) > 0) {
                return $maybe;
            }
            return [$this->media_file];
        }

        return [];
    }
}