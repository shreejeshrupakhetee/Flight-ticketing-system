<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoingCity extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function travels(){
        return $this->hasMany(Travel::class,'going_city_id');
    }
}
