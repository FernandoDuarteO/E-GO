<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relación: un usuario puede tener muchas reviews
    public function reviews()
    {
        return $this->hasMany(\App\Models\Review::class);
    }

    // Relación: un usuario puede tener muchos emprendimientos (si usas user_id en entrepreneurships)
    // O uno solo si solo puede tener uno. Si tu relación es diferente, ajusta el método.
    public function entrepreneurships()
    {
        return $this->hasMany(\App\Models\Entrepreneurship::class, 'entrepreneur_id');
    }
}
