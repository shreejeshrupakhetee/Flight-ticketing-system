<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelName extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function travels(){
        return $this->hasMany(Travel::class,'travel_name_id');
    }
}
