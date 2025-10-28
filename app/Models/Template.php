<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Si usas Laravel Breeze/Fortify, estos son los fillable por defecto
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Tu campo para roles
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relación: Un usuario puede tener muchos emprendimientos
    public function entrepreneurships()
    {
        return $this->hasMany(Entrepreneurship::class, 'user_id');
    }

    // Si tienes relación con Entrepreneur (otro modelo de perfil)
    public function entrepreneur()
    {
        return $this->hasOne(Entrepreneur::class);
    }

    // Si tienes relación con Client (otro modelo de perfil)
    public function client()
    {
        return $this->hasOne(Client::class);
    }
}
