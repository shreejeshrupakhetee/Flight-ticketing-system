@extends('layouts.app')

@section('content')
<div class="container-fluid home">
    <div class="row">
        <div class="col-md-8">
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>
        </div>
        <div class="col-md-9">
            <form method="get" action="{{route('search')}}" class="p-4 bg-white text-black">
              @if(Session::has('error'))
              <div class="alert alert-danger" role="alert" id="box">
               {{Session::get('error')}}
              </div>
              @endif
                <div class="mb-3">
                    <label for="exampleInput" class="form-label">From</label>
                    <select data-live-search="true" class="form-select  @error('leavingcity') is-invalid @enderror" name="leavingcity" value={{ request('leavingcity') }} aria-label="Default select example" id='select1' onchange="getSelectValue(this.value)">
                      <option selected disabled value="leaving">From</option>
                      @foreach($leavingcityname as $city)
                      <option value="{{$city->id}}" {{old('leavingcity') == $city->id ? 'selected' : ''}}>{{$city->city}}</option>
                      @endforeach
                    </select>
                  @error('leavingcity')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                 @enderror
                  </div>
                  <div class="mb-3">
                    <label for="exampleInput" class="form-label">To</label>
                    <select class="form-select  @error('goingcity') is-invalid @enderror" name="goingcity" value={{ request('goingcity') }} aria-label="Default select example"  id="select2">
                      <option selected disabled value="going">To</option>
                      @foreach($goingcityname as $city)
                      <option value="{{$city->id}}" {{old('goingcity') == $city->id ? 'selected' : ''}}>{{$city->city}}</option>
                      @endforeach
                    </select>
                  @error('goingcity')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                 @enderror
                  </div>
                  <div class="mb-3">
                    <label for="exampleInput" class="form-label">Date of Travel</label>
                    <input type="date" class="form-control" name="date" id="exampleInput" placeholder="Enter Destination City" value="{{request('date')}}">
                  </div>
                  <div class="mb-3">
                    <button class="btn btn-primary w-10">Search Flight</button>
                  </div>
            </div>
        </div>
        <div class="col-md-12 my-5">
          <h2>Flights Available</h2>
          <div class="row my-4">
            @foreach($travel as $info)
            <div class="col-md-3 my-2">
              <a href="{{route('travel.details',['travel'=>$info->slug])}}" class="text-decoration-none text-secondary">
              <div class="card shadow">
                <img src='{{asset("images/$info->image")}}' class="card-img-top img-fluid" style="height:200px;" alt="{{$info->image}}">
                <div class="card-body">
                  <h5 class="card-title">{{$info->leavingcities->city}} - {{$info->goingcities->city}}</h5>
                  <p class="card-text"><b>Rs.{{$info->price}} Per/seat</b></p>
                </div>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">Flight Name : {{$info->travelnames->travel_name}}</li>
                  <li class="list-group-item">Seats: {{$info->available}}</li>
                  <li class="list-group-item">Departure time: {{Carbon\Carbon::parse($info->travel_date)->format('H:i:s')}}
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
          </div>
          <div class="paginate_wrapper">
            {{$travel->links()}}
          </div>
      </div>
    </div>
</div>
<script>
  function getSelectValue(select1){
    if(select1!=''){
      $("#select2 option[value='"+select1+"']").hide();
      $("#select2 option[value!='"+select1+"']").show();
    }
  }

  setTimeout(() => {
const box = document.getElementById('box');
box.style.display = 'none';
}, 1000);
  </script>
@endsection