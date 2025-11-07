<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\Entrepreneurship;
use App\Models\ProductImage;
use App\Models\Send;
use App\Models\Review;
use App\Models\User;

class Product extends Model
{
    use HasFactory;

    /**
     * Resultados por página (paginación por defecto)
     */
    protected $perPage = 5;

    /**
     * Mass assignable
     */
    protected $fillable = [
        'name',
        'quantity',
        'description',
        'price',
        'category_id',
        'user_id',
        'entrepreneurship_id',
        // 'media_file' // si aún la usas, añádela aquí
    ];

    /**
     * Atributos que se pueden castear
     */
    protected $casts = [
        'price' => 'float',
        'quantity' => 'integer',
    ];

    /**
     * Si quieres añadir helpers automáticos al serializar, descomenta $appends.
     * protected $appends = ['images_or_fallback', 'image_urls'];
     */

    /**
     * Relaciones
     */

    // Categoría
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    // Emprendimiento (si aplica)
    public function entrepreneurship(): BelongsTo
    {
        return $this->belongsTo(Entrepreneurship::class, 'entrepreneurship_id', 'id');
    }

    // Vendedor / usuario
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // Envios asociados
    public function send(): HasMany
    {
        return $this->hasMany(Send::class, 'product_id', 'id');
    }

    // Reseñas
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'product_id', 'id');
    }

    /**
     * Relación principal con product_images.
     * Método estándar camelCase: productImages()
     * - Usar: with(['productImages'])
     */
    public function productImages(): HasMany
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id')->orderBy('order');
    }

    /**
     * Alias procedural (por compatibilidad con llamadas que usen snake_case)
     * Algunos lugares del código pueden llamar a 'product_images' en with() — esto evita errores.
     * NOTA: Laravel busca el método exacto; definir este alias evita 'RelationNotFoundException'.
     */
    public function product_images(): HasMany
    {
        return $this->productImages();
    }

    /**
     * Alias más corto: images()
     * Muchos proyectos usan images() para obtener imágenes del producto.
     */
    public function images(): HasMany
    {
        return $this->productImages();
    }

    /**
     * Imagen principal / portada (one-of-many)
     * obtiene la imagen con menor valor en 'order' (primera)
     */
    public function firstImage(): HasOne
    {
        return $this->hasOne(ProductImage::class, 'product_id', 'id')->ofMany('order', 'min');
    }

    /**
     * Helper: devuelve array de paths (tal como están en DB) o vacío.
     * Usa Storage::url($path) desde las vistas para generar URL pública.
     *
     * $product->images_or_fallback
     */
    public function getImagesOrFallbackAttribute(): array
    {
        // Si la relación 'productImages' está cargada, usarla
        if ($this->relationLoaded('productImages')) {
            $imgs = $this->productImages->pluck('file_path')->filter()->values()->toArray();
            if (!empty($imgs)) {
                return $imgs;
            }
        } else {
            // Si no está cargada, consulta con orden para evitar duplicados
            $imgs = $this->productImages()->orderBy('order')->pluck('file_path')->filter()->toArray();
            if (!empty($imgs)) {
                return $imgs;
            }
        }

        // Fallback a la columna media_file si aún la usas (puede ser string o JSON)
        if (!empty($this->media_file)) {
            $maybe = @json_decode($this->media_file, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($maybe) && count($maybe) > 0) {
                return $maybe;
            }
            return [$this->media_file];
        }

        return [];
    }

    /**
     * Helper adicional: devuelve URLs públicas completas para cada imagen.
     * No se añade automáticamente a toArray() para evitar overhead.
     * Uso: $product->image_urls
     */
    public function getImageUrlsAttribute(): array
    {
        $paths = $this->images_or_fallback;
        if (empty($paths)) {
            return [];
        }
        return array_map(function ($p) {
            // Si ya es URL absoluta, devuélvela tal cual
            if (preg_match('/^https?:\\/\\//i', $p)) {
                return $p;
            }
            // Storage::url requiere que el archivo esté en disk 'public' si usas storage:link
            try {
                return Storage::url($p);
            } catch (\Throwable $e) {
                return asset('storage/' . ltrim($p, '/'));
            }
        }, $paths);
    }

    /**
     * Opcional: scope para sólo productos publicados (si existe columna published)
     */
    public function scopePublished($query)
    {
        if (\Schema::hasColumn($this->getTable(), 'published')) {
            $query->where('published', 1);
        }
        return $query;
    }
}