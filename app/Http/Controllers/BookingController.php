<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Travel;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.booking.index',['data'=>Booking::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('user.checkout');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBookingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookingRequest $request)
    {
        //retive the relevent data from  travel table
        $travel=Travel::where('slug',$request->data)->first();
        //get id from auth users
        $user=auth()->user()->id;
        //check if the ticket are booked by individual user
        if (Booking::where('user_id', $user)->where('travel_id',$travel->id)->exists()) {
            return back()->with('unsuccessMessage','You have already book the ticket. Go to your Profile and view bought Ticket !!');
         }else{
            //store in booking table if ticket are booked
            $booking=Booking::create([
                'user_id'=>$user,
                'no_of_seats'=>$request->seatbook,
                'travel_id'=>$travel->id,
                'total_amount'=>($request->seatbook)*($travel->price),
            ]);
            //update the travel if the number of seat are booked 
            $travel->available=($travel->available)-($request->seatbook);
            //update the column from travels table
            $travel->save();
            //redirect to given page with some data
            //return redirect()->route('checkoutview')->with(['booking'=>$booking,'price'=>$travel->price]);
            return redirect()->route('checkoutview')->with('success','Thanks for Booking the Tickets');
         }
     
    }
    public function checkout(){
        $data= Booking::where('user_id',auth()->user()->id)->latest()->first();
        return view('user.checkout',['data'=>$data]);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBookingRequest  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req)
    {
        $req->validate(['no_of_seat'=>'required | min:1']);
        $booking=Booking::find($req->booking_id);
        $travel=Travel::findorFail($booking->travel_id);
        if(($booking->no_of_seats) < ($req->no_of_seat)){
           $subtract=($req->no_of_seat)-($booking->no_of_seats);
           $travel->available=($travel->available)-$subtract;
        }
        if(($booking->no_of_seats) > ($req->no_of_seat)){
            $add=($booking->no_of_seats)-($req->no_of_seat);
            $travel->available=($travel->available)+$add;
         }
        $booking->no_of_seats=$req->no_of_seat;
        $booking->total_amount=($req->no_of_seat)*($travel->price);
        $travel->save();
        $booking->save();
        return back()->with('successMessage','Booking Seat Updated !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $booking=Booking::find($slug);
        $travel=Travel::findorFail($booking->travel_id);
        $travel->available=($booking->no_of_seats)+($travel->available);
        $travel->save();
        $booking->delete();
        return back()->with('successMessage','Booking deleted !!');
    }

   
}
