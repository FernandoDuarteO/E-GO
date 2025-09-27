<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;
    protected $perPage = 5;

    protected $fillable = [
        'messages',
        'entrepreneur_id',
        'client_id'
    ];

    //chat, emprendedores y clientes
    public function entrepreneur(){
        return $this->belongsTo(Entrepreneur::class);
    }

    public function client(){
        return $this->belongsTo(Client::class);
    }
}
