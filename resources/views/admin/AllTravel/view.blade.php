@extends('layouts.admin')
@section('admin-content')
@section('title'){{ 'View Ticket'}}@endsection
<div class="container">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-10">
        <h1 class="m-0">View Ticket</h1>
        </div>
        <div class="col-sm-10">
        </div>
        </div>
    </div>
    <div class="card shadow p-4">
        <div class="row">
            <div class="col-md-7">
                 <p><b>Travel Name</b></p>
                 <p>{{$travel->travelnames->travel_name}}</p>
            </div>
            <div class="col-md-7">
                <p><b>Flight Type</b></p>
                <p>{{$travel->flighttypes->flight_type_name}}</p>
            </div>
            <div class="col-md-7">
                <p><b>Available Seat</b></p>
                <p>{{$travel->available}} Seats</p>
            </div>
            <div class="col-md-7">
                <p><b>From</b></p>
                <p>{{$travel->leavingcities->city}}</p>
            </div>
            <div class="col-md-7">
                <p><b>To</b></p>
                <p>{{$travel->goingcities->city}}</p>
            </div>
            <div class="col-md-7">
                <p><b>Departure</b></p>
                <p>{{$travel->Departure}}
                    @php
                    use Carbon\Carbon;   
                   @endphp
                   @if(Carbon::parse($travel->Departure)->format('H')>=12)
                       PM
                   @else
                       AM
                   @endif</p>
            </div>
            <div class="col-md-7">
                <p><b>Price</b></p>
                <p>Rs. {{$travel->price}}</p>
            </div>
            <div class="col-md-7">
                <p><b>Travel Date</b></p>
                <p>{{Carbon::parse($travel->travel_date)->format('Y-m-d')}}</p>
            </div>
            <div class="col-md-7">
                <p><b>Flight Number</b></p>
              <p>{{$travel->flight_plate_number}}</p>
            </div>
            <div class="col-md-12">
                <p><b>Flight Image</b></p>
                <img src='{{asset("images/$travel->image")}}' alt="{{$travel->image}}" style="height:100px;width:100px;"/>
            </div>
            <div class="col-md-8 mt-5">
                <a href="{{route('travel.index')}}"><button type="submit" class="btn btn-secondary">Go Back</button></a>
            </div>
        </div>
    </div>
</div>
@endsection