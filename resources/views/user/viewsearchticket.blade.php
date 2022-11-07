@extends('layouts.app')

@section('content')
<div class="col-md-12 my-5">
    @if(Request::path() == 'allticket')
    <h2>All Tickets</h2>
    @else
    <h2>Searched Tickets</h2>
    @endif
    <div class="smallline"></div>
    <div class="row my-4">
      @if($travel->count()>0)
      @foreach($travel as $info)
      <div class="col-md-3 my-2">
        <a href="{{route('travel.details',['travel'=>$info->slug])}}" class="text-decoration-none text-secondary">
        <div class="card shadow">
          <img src='{{asset("images/$info->image")}}' class="card-img-top img-fluid" style="height:200px;" alt="{{$info->image}}">
          <div class="card-body">
            <h5 class="card-title">{{$info->leavingcities->city}} - {{$info->goingcities->city}}</h5>
            <p class="card-text"><b>Rs. {{$info->price}} per seat/person</b></p>
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">Travel Name : {{$info->travelnames->travel_name}}</li>
            <li class="list-group-item">Travel Type: {{$info->flighttypes->flight_type_name}}</li>
            <li class="list-group-item">Travel Date: {{Carbon\Carbon::parse($info->travel_date)->format('Y-m-d')}}</li>
            <li class="list-group-item">Travel time: {{Carbon\Carbon::parse($info->travel_date)->format('H:i:s')}}
              @if(Carbon\Carbon::parse($info->travel_date)->format('H')>=12)
              PM
              @else
              AM
              @endif
            </li>
          </ul>
        </div>
      </a>
      </div>
      
      @endforeach
      <div class="paginate-wrapper mt-4">
        {{$travel->links()}}
      </div>
      @else
      <div class="text-center">
        <h2>Record Not Found !!</h2>
      </div>
      @endif
    </div>
   
</div>
@endsection