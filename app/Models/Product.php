<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $perPage = 5;

    protected $fillable = [
        'name',
        'quantity',
        'description',
        'price',
        'media_file',
        'category_id',
        'user_id',        // añade si existe en tu tabla
        'entrepreneurship_id', // opcional, si usas esa FK
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    // Si usas una relación Entrepreneurship (ya la tenías)
    public function entrepreneurship(){
        return $this->belongsTo(Entrepreneurship::class);
    }

    // NEW: relación con el usuario (vendedor)
    // Ajusta la FK si en tu tabla se llama diferente (por ejemplo 'vendor_id')
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    //envios, productos y delivery
    public function send(){
        return $this->hasMany(Send::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}