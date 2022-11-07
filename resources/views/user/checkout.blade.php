@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!--display order details header -->
    @if (Session::has('success'))
    <div class="alert alert-success alert-dismissible " role="alert">
        {{Session::get('success')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
    @if($data)
    <div class="row">
        <div class="col-md-10">
            <div class="card p-1 text">
            <table class="table table">
                 <tr>
                    <th>FROM-TO</th>
                    <th>PRICE</th>
                    <th>No.OF SEATS</th>
                    <th>TOTAL AMOUNT</th>
                 </tr>
                 <tbody>
                    <tr>
                        <td>{{$data->travels->leavingcities->city}} - {{$data->travels->goingcities->city}}</td>
                        <td>Rs. {{$data->travels->price}}</td>
                        <td>{{$data->no_of_seats}}</td>
                        <td>Rs. {{$data->total_amount}}</td>
                    </tr>
                 </tbody>
            </table>
            </div>
        </div>
        <div class="col-md-10">
           
                <!--disply card -->
                <div class="card p-2 text-center ">
                    <h1>Thank you For Buying The Ticket </h1>
                    <h1> Have a safe Journey </h1>
                    <!--button -->
                    <div class="d-flex justify-content-between">
                        <a href="{{route('userprofile')}}">
                            <button type="submit" class="btn btn-primary">Go To Your Profile </button>
                        </a>
                    </div> 
                </div>
          
        </div>
            
    </div>
    @else
    <div class="text-center my-5">
        <h1 class="my-5">Nothing to Checkout !!</h1>
    </div>
    
    @endif
</div>

@endsection