<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $perPage = 5;

    protected $fillable = [
        'type',
        'description'
    ];

    //productos, emprendimientos y categorias
    public function product(){
        return $this->hasMany(Product::class);
    }
}