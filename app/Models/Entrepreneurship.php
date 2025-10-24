<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrepreneurship extends Model
{
    use HasFactory;
    protected $perPage = 5;

    protected $fillable = [
        //'name',
        'description',
        //'address',
        'type',
        'telephone',
        'email',
        'media_file',
        'entrepreneur_id',
        'client_id',
        'user_id',              // <-- Campo para la relación con User
        // Nuevos campos para el registro de emprendimiento
        'business_name',
        'department',
        'years_experience',
        'business_type'
    ];

    // Relación con emprendedor
    public function entrepreneur(){
        return $this->belongsTo(Entrepreneur::class);
    }

    // Relación con cliente
    public function client(){
        return $this->belongsTo(Client::class);
    }

    // Relación con usuario
    public function user(){
        return $this->belongsTo(User::class);
    }

    // Relación con productos
    public function product(){
        return $this->hasMany(Product::class);
    }
}
