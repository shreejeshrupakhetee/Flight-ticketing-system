<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Travel;
use App\Models\User;

class Booking extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function travels(){
        return $this->belongsTo(Travel::class,'travel_id');
    }
    public function users(){
        return $this->belongsTo(User::class,'user_id');
    }
}
