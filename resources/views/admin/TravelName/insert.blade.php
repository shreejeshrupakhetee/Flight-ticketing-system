@extends('layouts.admin')
@section('admin-content')
@section('title'){{ 'Add Travel Name'}}@endsection
<div class="container">
   <div class="card my-5 shadow">
    <form action="{{route('travelname.store')}}" method="post">
        @csrf
        <div class="row p-3">
            <div class="col-md-6 ">
                <div class="mb-3">
                    <input type="text" name="travel_name" class="form-control @error('travel_name') is-invalid @enderror" id="exampleFormControlInput1" placeholder="Enter company name" value="{{old('travel_name')}}"/>
                    @error('travel_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                  </div>
            </div>
            <div class="col-md-10">
                <button type="submit" class="btn btn-primary">Add company name</button>
            </div>
        </div>
       
    </form>
   </div>
   <a href="{{route('travelname.index')}}" ><button class="btn btn-secondary">Go Back</button></a>
</div>
@endsection