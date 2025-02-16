    <form action="{{ route('user.login.submit') }}" method="POST" autocomplete="off" id="loginform">
        @csrf
        @if(session()->has('success_msg'))
        <div class="mt-4 alert alert-success">
            {{ session()->get('success_msg') }}
        </div>
        @endif

    @if(session()->has('error_msg'))
    <div class="mt-3 alert alert-error">
        {{ session()->get('error_msg') }}
    </div>
    @endif
        <div class="email pt-3">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" autocomplete="off" />
        </div>
        <div class="password pt-3">
            <label for="Password">Password</label>
            <input type="password" name="password" id="password" autocomplete="off" />
        </div>
        <button type="submit" id="customer_signin">Sign In</button>
        <div class=" pt-2"> <a class="forgot-password " href="{{ route('user.forgotPasswordIndex') }}">Forgot password?</a></div>
    </form>