<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Travel;
use App\Models\GoingCity;
use App\Models\LeavingCity;
use App\Models\Booking;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;

class UserController extends Controller
{
    public function index(){
        $user=auth()->user()->id;
        $ticket=Booking::where('user_id',$user)->where('status','1')->get();
        return view('user.profile',['booked'=>$ticket]);
    }

    public function updateprofile(Request $request){
       $request->validate([
        'name'=>'required',
        'number'=>'required'
       ]);
       $slug=auth()->user()->slug;
       $data=User::where('slug',$slug)->first();
       $data->name=$request->name;
       $data->mobilenumber=$request->number;
       $data->save();
       return back()->with('successMessage','User Profile Update Successfull !!');
    }

    public function search(Request $request)
{
    try{
    $data=Travel::where('status','1');
    if($request->leavingcity){
       $data1=$data->where('leaving_city_id',$request->leavingcity)->paginate(8);
    }
    if($request->goingcity){
        $data1=$data->where('going_city_id',$request->goingcity)->paginate(8);
    }
    if($request->date){
        $data1=$data->where('travel_date','like',$request->date.'%')->paginate(8);
    }
    if($request->leavingcity && $request->goingcity && $request->date){
        $data1=$data->where('leaving_city_id',$request->leavingcity)
        ->where('going_city_id',$request->goingcity)
        ->where('travel_date','like',$request->date.'%')->paginate(8);
    }
    if($request->leavingcity && $request->goingcity){
        $data1=$data->where('leaving_city_id',$request->leavingcity)
        ->where('going_city_id',$request->goingcity)->paginate(8);
    }
    if($request->leavingcity && $request->date){
        $data1=$data->where('leaving_city_id',$request->leavingcity)
        ->where('travel_date','like',$request->date.'%')->paginate(8);
    }
    if($request->goingcity && $request->date){
        $data1=$data->where('going_city_id',$request->goingcity)
        ->where('travel_date','like',$request->date.'%')->paginate(8);
    }
    return view('user.viewsearchticket',['travel'=>$data1]);
}catch(\Exception $e){
    return back()->with('error','please choose one fileds !!!');
}

}

public function allticket(){
    $data=Travel::where('travel_date','>=',date('Y-m-d'))->where('status','1')->paginate(8);
    return view('user.viewsearchticket',['travel'=>$data]);
}
   
public function userview($view){
    $traveldata=Travel::where('slug',$view)->first();
    return view('user.viewdetails',['travel'=>$traveldata]);

}

public function destroy($book){
   $booking=Booking::findorFail($book);
   $travel=Travel::findorFail($booking->travel_id);
   $travel->available=($booking->no_of_seats)+($travel->available);
   $travel->save();
   $booking->delete();
   return back()->with('successMessage','You have Cancel your Ticket !!');
}

  public function AdminUser(){
    $data=User::where('role','0')->get();
    return view('admin.users.index',['data'=>$data]);
  }

  public function deleteUser($slug){
    $data=User::where('slug',$slug)->first();
    $data->delete();
    return back()->with('successMessage','User has been Removed !!!');
  }


  public function editUser($slug){
    $data=User::where('slug',$slug)->first();
    return view('admin.users.useredit',['user'=>$data]);
  }

  public function updateUseremail(Request $request){
    $data=User::where('slug',$request->userslug)->first();
    $data->email=$request->email;
    if($request->status==0){
      $data->email_verified_at=NULL;
    }
    if($request->status==1){
        $data->email_verified_at=now();
    }
    $data->save();
    return redirect()->route('adminUser')->with('successMessage','Email updated !!');
  }
}
