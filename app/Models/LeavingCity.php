<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeavingCity extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function travels(){
        return $this->hasMany(Travel::class,'leaving_city_id');
    }
}
