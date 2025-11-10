<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

/**
 * ProductImage
 *
 * Modelo para almacenar las rutas/metadata de imágenes de producto.
 *
 * Campos esperados en la tabla `product_images`:
 * - id
 * - product_id
 * - file_path  (ruta relativa en disco, p.ej. "products/abc.jpg" o URL absoluta)
 * - order      (int) orden para mostrar miniaturas / portada
 * - alt        (string|null) texto alternativo
 * - created_at, updated_at
 */
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
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    /**
     * Mutator: limpiar file_path al asignar (quita slashes iniciales).
     */
    public function setFilePathAttribute(?string $value): void
    {
        if (is_null($value)) {
            $this->attributes['file_path'] = null;
            return;
        }
        // eliminar espacios y slashes iniciales para consistencia
        $this->attributes['file_path'] = ltrim(trim($value), '/');
    }

    /**
     * Accessor: devuelve la URL pública completa de la imagen.
     * - Si file_path ya es una URL absoluta (http/https) la devuelve tal cual.
     * - Si es una ruta relativa, intenta Storage::url() y, si falla, usa asset('storage/...').
     *
     * Uso: $image->url
     */
    public function getUrlAttribute(): ?string
    {
        $path = $this->file_path ?? null;
        if (empty($path)) {
            return null;
        }

        if (preg_match('/^https?:\\/\\//i', $path)) {
            return $path;
        }

        try {
            // intenta convertir según el disk configurado (normalmente 'public')
            return Storage::url($path);
        } catch (\Throwable $e) {
            return asset('storage/' . ltrim($path, '/'));
        }
    }

    /**
     * Helper: si quieres eliminar el archivo físico al borrar el registro.
     * NO está activado automáticamente; invócalo desde un observer o manualmente.
     */
    public function deleteFileFromStorage(): bool
    {
        $path = $this->file_path;
        if (!$path) {
            return false;
        }

        // si es URL absoluta no intentamos eliminar
        if (preg_match('/^https?:\\/\\//i', $path)) {
            return false;
        }

        try {
            return Storage::delete($path);
        } catch (\Throwable $e) {
            // no propagamos la excepción aquí; retorna false si no se pudo borrar
            return false;
        }
    }
}