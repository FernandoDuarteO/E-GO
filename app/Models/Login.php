<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    use HasFactory;
    protected $perPage = 5;

    protected $fillable = [
        'username',
        'password',
        'register_id'
    ];

    //login y registro
    public function register(){
        return $this->belongsTo(Register::class);
    }
}
