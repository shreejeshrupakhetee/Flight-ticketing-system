@extends('layouts.app')

@section('content')
<section class="content container">
    @if(Session::has('unsuccessMessage'))
    <div class="alert alert-warning" role="alert" id="box">
       {{Session::get('unsuccessMessage')}}
      </div>
    @endif
    <div class="card card-solid">
    <div class="card-body">
    <div class="row">
    <div class="col-6">
    <img src='{{asset("images/$data->image")}}' class="img-fluid" alt="Product Image">
    </div>
    <div class="col-6 col-sm-6">
    <h3 class="my-3">{{$data->leavingcities->city}} - {{$data->goingcities->city}}</h3>
    <p>This flight travels from {{$data->leavingcities->city}} to {{$data->goingcities->city}}.Have a safe FLight</p>
    <hr>
    <h4>Available Seat : {{$data->available}}</h4>
    <div class="bg-gray p-2 mt-4">
        <h3 class="">
        Rs .{{$data->price}} per person/seat
        </h3>
        @php
        use Carbon\Carbon;   
       @endphp
        <p><b>Travel Name : {{$data->travelnames->travel_name}}</b></p>
        <p><b>Travel Type : {{$data->flighttypes->flight_type_name}}</b></p>
        <p><b>Flight Number : {{$data->flight_plate_number}}</b></p>
        <p><b>Travel Date : {{Carbon::parse($data->travel_date)->format('Y-m-d')}}</b></p>
        <p><b>Departure : {{$data->Departure}}
           
           @if(Carbon::parse($data->Departure)->format('H')>=12)
               PM
           @else
               AM
           @endif</b></p>
        </div>
        @if($data->available>0)
    <h4 class="mt-3">Number of seat You want to book</h4>
    <form method="POST" action="{{route('book',['data'=>$data->slug])}}">
        @csrf
    <input type="number" name="seatbook" class="form-control @error('seatbook') is-invalid @enderror" min="1" max="{{$data->available}}" placeholder="select number of seat"/>
    @error('seatbook')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
   
    <div class="mt-4">
      
    <button class="btn btn-primary btn-lg btn-flat">    
    <i class="fas fa-cart-plus fa-lg mr-2"></i>
    Book Now
    </button>
        </form>
        @else
        <h4 class="mt-3">All the seat are Reserved, Please search for another Tickets.</h4>
        @endif
    </div>
    </div>
    </div>
   
    
    </div>
    
    </section>
   
    
    @endsection