<?php

namespace App\Http\Controllers;

use App\Models\FlightType;
use App\Http\Requests\StoreFlightTypeRequest;
use App\Http\Requests\UpdateFlightTypeRequest;
use Illuminate\Support\Str;

class FlightTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.TravelType.TravelTypeIndex',['data'=>FlightType::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.TravelType.insert');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFlightTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFlightTypeRequest $request)
    {
        try{
            $slug=Str::random(20);
            FlightType::create([
                'flight_type_name'=>$request->flight_type_name,
                'slug'=>$slug
            ]);
        }catch(Exception $e)  
        {  
            if (!($e instanceof SQLException)) {
                app()->make(\App\Exceptions\Handler::class)->report($e); // Report the exception if you don't know what actually caused it
            }
            return redirect()->back()->with('unsuccessMessage', 'Failed to add flight type !!!');  
        } 
           return redirect()->route('traveltype.index')->with('successMessage','flight Type Added Successfully!!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FlightType  $flightType
     * @return \Illuminate\Http\Response
     */
    public function show(FlightType $flightType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FlightType  $flightType
     * @return \Illuminate\Http\Response
     */
    public function edit($flightType)
    {
        $data=FlightType::where('slug',$flightType)->first();
        return view('admin.TravelType.edit',['traveltype'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFlightTypeRequest  $request
     * @param  \App\Models\FlightType  $flightType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFlightTypeRequest $request,$flightType)
    {
        try{
            $data=FlightType::where('slug',$flightType)->first();
            $data->flight_type_name=$request->flight_type_name;
            }
            catch(Exception $e)  
        {  
            if (!($e instanceof SQLException)) {
                app()->make(\App\Exceptions\Handler::class)->report($e); // Report the exception if you don't know what actually caused it
            }
            return redirect()->back()->with('unsuccessMessage', 'Failed to update flight type !!!');  
        } 
           $data->save();
           return redirect()->route('traveltype.index')->with('successMessage','Flight type Updated Successfully!!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FlightType  $flightType
     * @return \Illuminate\Http\Response
     */
    public function destroy($flightType)
    {
        FlightType::where('slug',$flightType)->first()->delete();
        return back()->with('successMessage','Flight type Deleted Successfully!!!');
    }
}
