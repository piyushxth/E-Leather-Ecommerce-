@extends('frontend.layouts.master')
@section('content')
<section class="login sec-padding custom-margin">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-sm-12 col-md-6">
                <div class="l-form verify-email-form">
                    <form action="{{ route('user.login.submit') }}" method="post">
                        @csrf
                        <h3 class="verify-title text-center pb-3">
                            Verify The Account
                        </h3>
                        @php
                        $email = Session::get('user');
                        @endphp
                        <div class="resend-info">
                            <span>Before proceeeding, please check your email for a verification link. If you did
                                not
                                receive the email,
                                </span><a href="{{ route('resend_email', $email) }}">Click here to request
                                        another</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection