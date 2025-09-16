<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $perPage = 5;

    protected $fillable = [
        'title',
        'description',
        'type',
        'duration',
        'code_course',
        'entrepreneur_id'
    ];

    //curso y emprendedores
    public function entrepreneur()
    {
        return $this->belongsTo(Entrepreneur::class);
    }
}
