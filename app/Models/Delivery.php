<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;
    protected $perPage = 5;

    protected $fillable = [
        'name',
        'type',
        'email',
        'telephone',
    ];

    //envios, productos y delivery
    public function send(){
        return $this->hasMany(Send::class);
    }
}