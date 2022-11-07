<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Travel;
use App\Models\GoingCity;
use App\Models\LeavingCity;
use App\Models\Booking;
use App\Models\FlightType;
use App\Models\TravelName;
use App\Models\User;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $dt = Carbon::now()->format('Y-m-d H:i:s');
        $data=Travel::where('travel_date','>=',$dt)->paginate(8);
        $delete_travel=Travel::where('travel_date','<',$dt)->get();
        //return $data;
        foreach($delete_travel as $t){
            $t->status='0';
            $t->save();
        }
        return view('components.index',['travel'=>$data,'goingcityname'=>GoingCity::all(),'leavingcityname'=>LeavingCity::all()]);
    }

    public function adminprofile(){
        return view('admin.profile');
    }
    public function adminbashboard(){
        $countTravel=Travel::where('status','1')->count();
        $countTravelName=TravelName::count();
        $countUser=User::where('role','0')->count();
        $countFlightType=FlightType::count();
        $countBooking=Booking::count();
        return view('admin.index',['travel'=>$countTravel,'user'=>$countUser,'travelname'=>$countTravelName,'flighttype'=>$countFlightType,'booking'=>$countBooking]);
    }
    
}
