<?php

namespace App\Http\Controllers;

use App\Models\Travel;
use App\Models\TravelName;
use App\Models\FlightType;
use App\Models\Booking;
use App\Models\GoingCity;
use App\Models\LeavingCity;
use App\Http\Requests\StoreTravelRequest;
use App\Http\Requests\UpdateTravelRequest;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TravelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.AllTravel.TravelIndex',['data'=>Travel::where('status','1')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.AllTravel.create',['travelname'=>TravelName::all(),'traveltype'=>FlightType::all(),'goingcityname'=>GoingCity::all(),'leavingcityname'=>LeavingCity::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTravelRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTravelRequest $request)
    {
        try{
        $slug=Str::random(20);
        if(isset($request->image)){
            $Imagename = time() .'.'. $request->image->extension();
            $request->image->move(public_path('images'), $Imagename);
        }
        Travel::create([
            'leaving_city_id'=>$request->leavingcity,
            'going_city_id'=>$request->goingcity,
            'travel_name_id'=>$request->travelname,	
            'flight_type_id'=>	$request->traveltype,
            'Departure'=>$request->departure,
            'available'=>$request->seatAvailable,
            'price'=>$request->price,
            'image'=>$Imagename,	
            'slug'=>$slug,
            'travel_date'=>$request->travel_date.' '.Carbon::parse($request->departure)->format('H:i:s'),
            'flight_plate_number'=>$request->flightno
        ]);
    }catch(Exception $e)  
    {  
        if (!($e instanceof SQLException)) {
            app()->make(\App\Exceptions\Handler::class)->report($e); // Report the exception if you don't know what actually caused it
        }
        return redirect()->back()->with('unsuccessMessage', 'Failed to add Ticket !!!');  
    } 
       return redirect()->route('travel.index')->with('successMessage','Ticket Added Successfully!!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Travel  $travel
     * @return \Illuminate\Http\Response
     */
    public function show($travel)
    {
        $travels=Travel::where('slug',$travel)->first();
        return view('admin.AllTravel.view',['travel'=>$travels]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Travel  $travel
     * @return \Illuminate\Http\Response
     */
    public function edit($travel)
    {
        $travels=Travel::where('slug',$travel)->first();
        return view('admin.AllTravel.edit',['travel'=>$travels,'travelname'=>TravelName::all(),'traveltype'=>FlightType::all(),'goingcityname'=>GoingCity::all(),'leavingcityname'=>LeavingCity::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTravelRequest  $request
     * @param  \App\Models\Travel  $travel
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTravelRequest $request, $travel)
    {
        try{
            $travel=Travel::where('slug',$travel)->first();
            if(isset($request->image)){
                $image_path=public_path("/images/".$travel->image);
                if (file_exists($image_path)) {
                    @unlink($image_path);
                }
                $Imagename = time() .'.'. $request->image->extension();
                $request->image->move(public_path('images'), $Imagename);
                $travel->image=$Imagename;
            }

                $travel->leaving_city_id=$request->leavingcity;
                $travel->going_city_id=$request->goingcity;
                $travel->travel_name_id=$request->travelname;	
                $travel->flight_type_id=$request->traveltype;
                $travel->Departure=$request->departure;
                $travel->available=$request->seatAvailable;
                $travel->price=$request->price;
                $travel->travel_date=$request->travel_date.' '.Carbon::parse($request->departure)->format('H:i:s');
                $travel->flight_plate_number=$request->flightno;
           
        }catch(Exception $e)  
        {  
            if (!($e instanceof SQLException)) {
                app()->make(\App\Exceptions\Handler::class)->report($e); // Report the exception if you don't know what actually caused it
            }
            return redirect()->back()->with('unsuccessMessage', 'Failed to update Ticket !!!');  
        } 
        $travel->save();
           return redirect()->route('travel.index')->with('successMessage','Ticket Update Successfully!!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Travel  $travel
     * @return \Illuminate\Http\Response
     */
    public function destroy($travel)
    {
        $travel_data=Travel::where('slug',$travel)->first();
        $findbooking=Booking::where('travel_id',$travel_data->id)->get();
        foreach($findbooking as $booked){
          $booked->status='0';
          $booked->save();
        }
        $travel_data->delete();
        return back()->with('successMessage','Ticket Deleted Successfully!!!');
    }

    public function traveldetails($travel){
        $detail=Travel::where('slug',$travel)->first();
        return view('components.Traveldetails',['data'=>$detail]);
    }
}
