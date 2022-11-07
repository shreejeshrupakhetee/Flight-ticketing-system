<?php

namespace App\Http\Controllers;

use App\Models\TravelName;
use App\Http\Requests\StoreTravelNameRequest;
use App\Http\Requests\UpdateTravelNameRequest;
use Illuminate\Support\Str;

class TravelNameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.TravelName.TravelNameIndex',['data'=>TravelName::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.TravelName.insert');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTravelNameRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTravelNameRequest $request)
    {
        try{
        $slug=Str::random(20);
        TravelName::create([
            'travel_name'=>$request->travel_name,
            'slug'=>$slug
        ]);
    }catch(Exception $e)  
    {  
        if (!($e instanceof SQLException)) {
            app()->make(\App\Exceptions\Handler::class)->report($e); // Report the exception if you don't know what actually caused it
        }
        return redirect()->back()->with('unsuccessMessage', 'Failed to add product !!!');  
    } 
       return redirect()->route('travelname.index')->with('successMessage','Company Name Added Successfully!!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TravelName  $travelName
     * @return \Illuminate\Http\Response
     */
    public function show(TravelName $travelName)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TravelName  $travelName
     * @return \Illuminate\Http\Response
     */
    public function edit($travelName)
    {
        $data=TravelName::where('slug',$travelName)->first();
        return view('admin.TravelName.edit',['travelname'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTravelNameRequest  $request
     * @param  \App\Models\TravelName  $travelName
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTravelNameRequest $request, $travelName)
    {
        try{
        $data=TravelName::where('slug',$travelName)->first();
        $data->travel_name=$request->travel_name;
        }
        catch(Exception $e)  
    {  
        if (!($e instanceof SQLException)) {
            app()->make(\App\Exceptions\Handler::class)->report($e); // Report the exception if you don't know what actually caused it
        }
        return redirect()->back()->with('unsuccessMessage', 'Failed to add product !!!');  
    } 
       $data->save();
       return redirect()->route('travelname.index')->with('successMessage','Company Name Updated Successfully!!!');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TravelName  $travelName
     * @return \Illuminate\Http\Response
     */
    public function destroy($travelName)
    { 
      TravelName::where('slug',$travelName)->first()->delete();
      return back()->with('successMessage','Company Name Deleted Successfully!!!'); 
    }
}
