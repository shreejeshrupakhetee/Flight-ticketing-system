@extends('layouts.admin')
@section('admin-content')
@section('title'){{ 'Edit User'}}@endsection
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
    <div class="col-sm-6">
    <h1 class="m-0">Edit User Email</h1>
    </div>
    <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('adminUser')}}">Home</a></li>
    <li class="breadcrumb-item active">Edit User Email</li>
    </ol>
    </div>
    </div>
</div>
<div class="container">
    <form action="{{route('user.update')}}" method="post">
        @csrf
        @method('put')
        <input type="hidden" value="{{$user->slug}}" name="userslug"/>
        <div class="card shadow p-4">
        <div class="row">
               
                <div class="col-md-6">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="email" class="form-control" value="{{$user->email}}"/>
                </div>
                
                <div class="col-md-6">
                    <label>Status</label>
                    <div class="d-flex">
                        <div class="form-check me-3">
                            <input class="form-check-input" type="radio" value="1" name="status" id="flexCheckDefault" {{ $user->email_verified_at!==null ? "checked" : "" }}>
                            <label class="form-check-label" for="flexCheckDefault">
                                Active
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" value="0" name="status" id="flexCheckChecked" {{ $user->email_verified_at==null ? "checked" : "" }}>
                            <label class="form-check-label" for="flexCheckChecked">
                              Inactive
                            </label>
                          </div>
                    </div>
                </div>
               <div class="col-md-6 mt-3">
                <button type="submit" class="btn btn-secondary">Update</button>
               </div>
            </div>
           
        </div>
       
        
    </form>
</div>

@endsection