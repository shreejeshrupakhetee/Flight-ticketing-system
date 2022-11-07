@extends('layouts.admin')
@section('admin-content')
@section('title'){{ 'Edit Travels Type'}}@endsection
<div class="container">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Edit Travel Type</h1>
        </div>
        </div>
    </div>
   <div class="card my-5 shadow">
    <form action="{{route('traveltype.update',['traveltype'=>$traveltype->slug])}}" method="post">
        @csrf
        @method('PUT')
        <div class="row p-3">
            <div class="col-md-6 ">
                <div class="mb-3">
                    <input type="text" name="flight_type_name" class="form-control @error('flight_type_name') is-invalid @enderror" id="exampleFormControlInput1" placeholder="enter flight type name" value="{{$traveltype->flight_type_name}}"/>
                    @error('flight_type_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                  </div>
            </div>
            <div class="col-md-6">
                <button type="submit" class="btn btn-primary">Update flight type</button>
            </div>
        </div>
        <a href="{{route('traveltype.index')}}" ><button class="btn btn-secondary">Go Back</button></a>
    </form>
   </div>
</div>
@endsection