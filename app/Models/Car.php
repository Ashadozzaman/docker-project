<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Year;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'make',
        'model',
        'details',
    ];

    public function years(){
        return $this->hasMany(Year::class,'car_id','id');
    }
}
