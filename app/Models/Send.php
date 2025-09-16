<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Send extends Model
{
    use HasFactory;
    protected $perPage = 5;

    protected $fillable = [
        'status',
        'address',
        'product_id',
        'delivery_id'
    ];

    //envios, productos y delivery
    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function delivery(){
        return $this->belongsTo(Delivery::class);
    }
}
