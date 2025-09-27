<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrepreneur extends Model
{
    use HasFactory;
    protected $perPage = 5;

    protected $fillable = [
        'name',
        'age',
        'sex',
        'identification_card',
        'telephone',
        'email',
        'country',
        'nationality',
        'municipality',
        'department',
        'media_file'
    ];

    //registro y admin, emprendedores y clientes
    public function register(){
        return $this->hasMany(Register::class);
    }

    //chat, emprendedores y clientes
    public function chat(){
        return $this->hasMany(Chat::class);
    }

    //curso y emprendedores
    public function course(){
        return $this->hasMany(Course::class);
    }

    //plantilla y emprendedores
    public function template(){
        return $this->hasMany(Template::class);
    }

    //emprendimiento, cliente y emprendedor
    public function entrepreneurship(){
        return $this->hasMany(Entrepreneurship::class);
    }

}
