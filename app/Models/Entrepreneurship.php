<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrepreneurship extends Model
{
    use HasFactory;
    protected $perPage = 5;

    protected $fillable = [
        'name',
        'description',
        'address',
        'type',
        'telephone',
        'email',
        'media_file',
        'entrepreneur_id',
        'client_id'
    ];

    
    // emprendimiento, cliente y emprendedor
    public function entrepreneur(){
        return $this->belongsTo(Entrepreneur::class);
    }

    public function client(){
        return $this->belongsTo(Client::class);
    }

    //productos, emprendimientos y categorias
    public function product(){
        return $this->hasMany(Product::class);
    }


}
