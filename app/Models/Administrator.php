<?php

namespace App\Models;

use illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrator extends Model
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
        'department'
    ];

    //registro y admin, emprendedores y clientes
    public function register(){
        return $this->hasMany(Register::class);
    }
}
