<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FlightType;
use App\Models\TravelName;
use App\Models\Booking;
use Illuminate\Database\Eloquent\SoftDeletes;

class Travel extends Model
{
    use HasFactory,SoftDeletes;
    public $table='travels';
    protected $guarded=[];
    
    public function flighttypes(){
        return $this->belongsTo(FlightType::class,'flight_type_id');
    }
    public function travelnames(){
        return $this->belongsTo(TravelName::class,'travel_name_id');
    }
    public function leavingcities(){
        return $this->belongsTo(LeavingCity::class,'leaving_city_id');
    }
    public function goingcities(){
        return $this->belongsTo(GoingCity::class,'going_city_id');
    }
    public function bookings(){
        return $this->hasMany(Booking::class,'travel_id');
    }
}
