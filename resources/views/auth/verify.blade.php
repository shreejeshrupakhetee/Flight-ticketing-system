@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center my-5">
        <div class="col-md-8 my-5">
            <div class="card my-5">
                <div class="card-header bg-dark">{{ __('Verify Your Email Address From Admin') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to Admin.') }}
                        </div>
                    @endif

                    {{ __('After verifying the email address from admin, within 24 hrs.') }}
                    {{ __('You can access the User Credentials !!') }}
                    <form class="d-inline mt-3" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary mt-3">{{ __('Resend Verification link to Admin') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
