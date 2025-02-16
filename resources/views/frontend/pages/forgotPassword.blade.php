@extends('frontend.layouts.master')
@section('content')
<div class="forgot-password-wrapper custom-margin container">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="forgot-password-content">

                <h3 class="verify-title text-center pb-3">
                    Forgot Password
                </h3>
                @if(session()->has('success_msg'))
                <div class="mt-4 alert alert-success">
                    {{ session()->get('success_msg') }}
                </div>
                @endif

                @if(session()->has('error_msg'))
                <div class="mt-3 alert  alert-danger">
                    {{ session()->get('error_msg') }}
                </div>
                @endif
                <form action="{{ route('user.email.verify') }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="email pt-3">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" autocomplete="off" required />
                        @error('email')
                        <span class="text-danger">
                            {{ $errors->first('email') }}
                        </span>
                        @enderror
                    </div>
                    <button type="submit">Recover Password</button>
                </form>
                <div class="forgot-log-in-images">
                    <a href="{{ route('home') }}">
                        <figure><img src="{{ asset('frontend/images/banner.png') }}" alt="{{ env('APP_NAME') }}">
                        </figure>
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection