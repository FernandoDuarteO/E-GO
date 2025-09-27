<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory;
    protected $perPage = 5;

    protected $fillable = [
        'title',
        'type',
        'format',
        'template_code',
        'entrepreneur_id'
    ];

    //plantilla y emprendedores
    public function entrepreneur(){
        return $this->belongsTo(Entrepreneur::class);
    }
}
