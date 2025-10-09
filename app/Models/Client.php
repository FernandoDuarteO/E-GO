<?php

namespace App\Models;

use illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
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
        'media_file',
        'user_id'
    ];

    //registro y admin, emprendedores y clientes
    public function register(){
        return $this->hasMany(Register::class);
    }

    //chat, emprendedores y clientes
    public function chat(){
        return $this->hasMany(Chat::class);
    }

    //emprendimiento, cliente y emprendedor
    public function entrepreneurship(){
        return $this->hasMany(Entrepreneurship::class);
    }
}
