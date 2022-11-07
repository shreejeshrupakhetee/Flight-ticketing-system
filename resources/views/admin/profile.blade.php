@extends('layouts.admin')
@section('admin-content')
@section('title'){{ 'Create Ticket'}}@endsection

<div class="container-fluid">
    <div class="row">
    <div class="col-md-4 py-5" style="margin:0px auto">
    
    <div class="card card-primary card-outline">
    <div class="card-body box-profile">
    <div class="text-center">
    <img class="profile-user-img img-fluid img-circle" src="https://ui-avatars.com/api/?name={{Auth::user()->name}}" alt="User profile picture">
    </div>
    <h3 class="profile-username text-center">{{Auth::user()->name}}</h3>
    <p class="text-muted text-center">@if(Auth::user()->role==0)
        User
        @else
        Admin
    @endif
    </p>
    <ul class="list-group list-group-unbordered mb-3">
    <li class="list-group-item">
    <b>Email</b> <a class="float-right">{{Auth::user()->email}}</a>
    </li>
    <li class="list-group-item">
    <b>Mobile Number</b> <a class="float-right">{{Auth::user()->mobilenumber}}</a>
    </li>
    <li class="list-group-item">
    <b>Account Created</b> <a class="float-right">{{Auth::user()->created_at->toFormattedDateString()}}</a>
    </li>
    </ul>
   
    </div>
    
    </div>
    
    

    
    </div>

@endsection