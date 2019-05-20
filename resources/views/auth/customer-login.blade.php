@extends('layouts.app')

@section('content')
<form class="login100-form validate-form flex-sb flex-w" method="POST" action="{{ route('customer.login.submit') }}">
    @csrf
    <span class="login100-form-title p-b-53">
        Sign In With
    </span>
    
    <div class="p-t-31 p-b-9">
        <span class="txt1">
            Email
        </span>
    </div>
    <div class="wrap-input100 validate-input" data-validate = "email is required">
        <input class="input100" type="text" name="email" >
        <span class="focus-input100"></span>
    </div>
    
    <div class="p-t-13 p-b-9">
        <span class="txt1">
            Password
        </span>

        <a href="#" class="txt2 bo1 m-l-5">
            Forgot?
        </a>
    </div>
    <div class="wrap-input100 validate-input" data-validate = "Password is required">
        <input class="input100" type="password" name="password" >
        <span class="focus-input100"></span>
    </div>

    <div class="container-login100-form-btn m-t-17">
        <button class="login100-form-btn">
            Sign In
        </button>
    </div>

    <div class="w-full text-center p-t-55">
        <span class="txt2">
            Not a member?
        </span>

        <a href="{{ route('register') }}" class="txt2 bo1">
            Sign up now
        </a>
    </div>
</form>
@endsection
