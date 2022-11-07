@extends('layouts.admin')
@section('admin-content')
@section('title'){{ 'Create Ticket'}}@endsection
<div class="container">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-1">
        <div class="col-sm-0">
        <h1 class="m-0">ADD TICKET</h1>
        </div>
        <div class="col-sm-10">
        </div>
        </div>
    </div>
    <div class="card shadow p-3">
       <form action="{{route('travel.store')}}" method="POST" enctype="multipart/form-data">
           @csrf
           <div class="row">
            <div class="col-md-10">
                <div class="mb-5">
                    <label for="exampleInput" class="form-label">From</label>
                    <select data-live-search="true" class="form-select  @error('leavingcity') is-invalid @enderror" name="leavingcity" aria-label="Default select example" id='select1' onchange="getSelectValue(this.value)">
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
            </div>
            <div class="col-md-10">
                <div class="mb-5">
                    <label for="exampleInput" class="form-label">To</label>
                    <select class="form-select  @error('goingcity') is-invalid @enderror" name="goingcity" aria-label="Default select example" id="select2">
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
            </div>
            <div class="col-md-10">
                <div class="mb-5">
                    <label for="exampleInput" class="form-label">Departure | Shift</label>
                    <input type="time" name="departure" class="form-control @error('departure') is-invalid @enderror" id="exampleInput" placeholder="enter Departure" value="{{old('departure')}}">
                    @error('departure')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                   @enderror
                  </div>
            </div>
            <div class="col-md-10">
                <div class="mb-5">
                    <label for="exampleInput" class="form-label">Available Seat</label>
                    <input type="number" name="seatAvailable" min="1" max="56" class="form-control @error('seatAvailable') is-invalid @enderror" id="exampleInput" placeholder="enter seatAvailable" value="{{old('seatAvailable')}}">
                    @error('seatAvailable')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                   @enderror
                  </div>
            </div>
            <div class="col-md-10">
                <div class="mb-5">
                    <label for="exampleInput" class="form-label">Price</label>
                    <input type="text" name="price" class="form-control @error('price') is-invalid @enderror" id="exampleInput" placeholder="enter price" value="{{old('price')}}">
                    @error('price')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                   @enderror
                  </div>
            </div>
            <div class="col-md-10">
                <div class="mb-5">
                    <label for="exampleInput" class="form-label">Flight Image</label>
                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" id="exampleInput"/>
                    @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                   @enderror
                  </div>
            </div>
            <div class="col-md-10">
                <div class="mb-5">
                    <label for="exampleInput" class="form-label ">Choose Travels Name</label>
                    <select id="travelname" class="form-select  @error('travelname') is-invalid @enderror" name="travelname" aria-label="Default select example">
                        <option selected disabled value="name">Select Travels Name</option>
                        @foreach($travelname as $travelnames)
                        <option value="{{$travelnames->id}}" {{old('travelname') == $travelnames->id ? 'selected' : ''}}>{{$travelnames->travel_name}}</option>
                        @endforeach
                      </select>
                    @error('travelname')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                   @enderror
                  </div>
            </div>
            <div class="col-md-10">
                <div class="mb-5">
                    <label for="exampleInput" class="form-label ">Choose Flight Type</label>
                    <select id="flighttype" class="form-select  @error('traveltype') is-invalid @enderror" name="traveltype" aria-label="Default select example">
                        <option selected disabled value="type">Select Flight Type</option>
                        @foreach($traveltype as $traveltypes)
                        <option value="{{$traveltypes->id}}" {{old('traveltype') == $traveltypes->id ? 'selected' : ''}} >{{$traveltypes->flight_type_name}}</option>
                        @endforeach
                      </select>
                    @error('traveltype')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                   @enderror
                  </div>
            </div>
            <div class="col-md-10">
                <div class="mb-5">
                    <label for="exampleInput" class="form-label ">Travel Date</label>
                    <input type="date" name="travel_date" class="form-control @error('travel_date') is-invalid @enderror" placeholder="enter travel date" value="{{old('travel_date')}}"/>
                    @error('travel_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                   @enderror
                  </div>
            </div>
            <div class="col-md-10">
                <div class="mb-5">
                    <label for="exampleInput" class="form-label ">Flight Number</label>
                    <input type="text" name="flightno" class="form-control @error('flightno') is-invalid @enderror" placeholder="Enter flight plate Number" value="{{old('flightno')}}"/>
                    @error('flightno')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                   @enderror
                  </div>
            </div>
           </div>
          <div class="mt-5 d-flex justify-content-between">
            <button type="submit" class="btn btn-secondary">ADD TICKET</button>
          </div>
       
       </form>
    </div>
</div>

<script>
    function getSelectValue(select1){
      if(select1!=''){
        $("#select2 option[value='"+select1+"']").hide();
        $("#select2 option[value!='"+select1+"']").show();
      }
    }
   // $('#select1').chosen();
//$('#select2').chosen();
$('#travelname').chosen();
$('#flighttype').chosen(); 
    </script>

@endsection