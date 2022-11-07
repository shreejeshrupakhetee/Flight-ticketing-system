<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Travel;

class FlightType extends Model
{
    use HasFactory;
    protected $guarded=[];
    public $table="flight_types";

    public function travels(){
        return $this->hasMany(Travel::class,'flight_type_id');
    }
}
