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
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    //productos, emprendimientos y categorias
    public function entrepreneurship(){
        return $this->belongsTo(Entrepreneurship::class);
    }



    //envios, productos y delivery
    public function send(){
        return $this->hasMany(Send::class);
    }
}
