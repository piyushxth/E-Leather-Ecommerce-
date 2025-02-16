@extends('frontend.layouts.master')
@section('content')

<div class="forgot-password-wrapper custom-margin container">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <p>Reset Password link expired</p>
        </div>
    </div>

    <div class="forgot-log-in-images">
        <a href="{{ route('home') }}" class="idrc-password-btn">
            Go back to Home
        </a>
    </div>

</div>
@endsection
