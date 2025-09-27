<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    use HasFactory;
    protected $perPage = 5;

    protected $fillable = [
        'username',
        'password',
        'role',
        'client_id',
        'administrator_id',
        'entrepreneur_id'
    ];

    //registro y admin, emprendedores y clientes
    public function client(){
        return $this->belongsTo(Client::class);
    }
    
    public function administrator(){
        return $this->belongsTo(Administrator::class);
    }

    public function entrepreneur(){
        return $this->belongsTo(Entrepreneur::class);
    }

    //login y registro
    public function login(){
        return $this->hasMany(Login::class);
    }
    
}
