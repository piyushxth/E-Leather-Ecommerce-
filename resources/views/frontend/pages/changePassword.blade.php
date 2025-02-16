@extends('frontend.layouts.master')
@section('content')
<div class="forgot-password-wrapper custom-margin container">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="forgot-password-content">
                <h3 class="verify-title text-center pb-3">
                    Create Your New Password
                </h3>
                @if(session()->has('success_msg'))
                <div class="mt-4 alert alert-success">
                    {{ session()->get('success_msg') }}
                </div>
                @endif

                @if(session()->has('error_msg'))
                <div class="mt-3 alert alert-danger">
                    {{ session()->get('error_msg') }}
                </div>
                @endif
                <form action="{{ route('user.changePassword.submit',$email) }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label> New Password </label><br>

                        <input type="password" name="password" size="40"
                            class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" required>

                        @error('password')
                        <span class="text-danger">
                            {{ $errors->first('password') }}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group mt-2">
                        <label> Confirm Password </label><br>
                        <input type="password" name="password_confirmation" value="" size="40" class="form-control"
                            required>
                        @error('password_confirmation')
                        <span class="text-danger">
                            {{ $errors->first('password_confirmation') }}
                        </span>
                        @enderror

                    </div>
                    <div class="idrc-password-btn">
                        <button type="submit">
                            Update Password
                        </button>
                    </div>
                </form>
                <div class="forgot-log-in-images">
                    <a href="{{ route('home') }}" class="idrc-password-btn">
                        Go back to Home
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection