@extends('layouts.admin')
@section('admin-content')
@section('title'){{ 'Admin Dashboard'}}@endsection
<div class="" >

    <div class="content-header">
    <div class="container-fluid">
    <div class="row mb-7">
    <div class="col-sm-10">
    <h1 class="m-0">Dashboard</h1>
    </div>
    <div class="col-sm-6">
    </div>
    </div>
    </div>
    </div>
    <section class="content">
    <div class="container-fluid">
    
    <div class="row">
    <div class="col-lg-9 col-10">
    
    <div class="small-box">
    <div class="inner">
    <h3>{{$travel}}</h3>
    <p>Tickets</p>
    </div>
    <div class="icon">
    <i class="ticket"></i>
    </div>
    <a href="{{route('travel.index')}}" class="small-box-footer-bg-warning">More info </a>
    </div>
    </div>
    
    <div class="col-lg-9 col-9">
    
    <div class="small-box">
    <div class="inner">
    <h3>{{$travelname}}</h3>
    <p>Travel Name</p>
    </div>
    <div class="icon">
    <i class="Travel Name"></i>
    </div>
    <a href="{{route('travelname.index')}}" class="small-box-footer-bg-warning">More info </a>
    </div>
    </div>
    
    <div class="col-lg-9 col-9">
    
    <div class="small-box">
    <div class="inner">
    <h3>{{$flighttype}}</h3>
    <p>Flight Type</p>
    </div>
    <div class="icon">
     <i class="Flight Type"></i>
    </div>
    <a href="{{route('traveltype.index')}}" class="small-box-footer-bg-warning">More info</a>
    </div>
    </div>
    
    <div class="col-lg-9 col-9">
    
    <div class="small-box">
    <div class="inner">
    <h3>{{$user}}</h3>
    <p>Users</p>
    </div>
    <div class="icon">
    <i class="Users"></i>
    </div>
    <a href="{{route('adminUser')}}" class="small-box-footer-bg-warning">More info </a>
    </div>
  
    
    </div>
    <div class="col-lg-9 col-9">
    <div class="small-box">
        <div class="inner">
        <h3>{{$booking}}</h3>
        <p>Booking</p>
        </div>
        <div class="icon">
        <i class="Booking"></i>
        </div>
        <a href="{{route('booked.index')}}" class="small-box-footer-bg-warning">More info </a>
        </div>
    </div>
    </div>
    </div>

    @endsection