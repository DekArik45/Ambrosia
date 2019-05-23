@extends('layouts.app')

@section('content')
<form class="login100-form validate-form flex-sb flex-w" method="POST" action="{{route('admin.register.submit')}}">
    @csrf
    <span class="login100-form-title p-b-53">
        Sign Up
    </span>
    <div class="p-t-31 p-b-9">
        <span class="txt1">
            Username
        </span>
    </div>
    <div class="wrap-input100 validate-input" data-validate = "Username is required">
        <input class="input100" type="text" name="username" >
        <span class="focus-input100"></span>
    </div>
    
    <div class="p-t-13 p-b-9">
        <span class="txt1">
            Password
        </span>
    </div>
    <div class="wrap-input100 validate-input" data-validate = "Password is required">
        <input class="input100" type="password" name="password" >
        <span class="focus-input100"></span>
    </div>

    <div class="p-t-31 p-b-9">
        <span class="txt1">
            Name
        </span>
    </div>
    <div class="wrap-input100 validate-input" data-validate = "Name is required">
        <input class="input100" type="text" name="name" >
        <span class="focus-input100"></span>
    </div>

    <div class="p-t-31 p-b-9">
        <span class="txt1">
            Phone
        </span>
    </div>
    <div class="wrap-input100 validate-input" data-validate = "Phone is required">
        <input class="input100" type="text" name="phone" >
        <span class="focus-input100"></span>
    </div>

    <div class="p-t-31 p-b-9">
        <span class="txt1">
            Profile Image
        </span>
    </div>
    <div class="wrap-input100">
        <input type="file" name="profile_image" >
        <span class="focus-input100"></span>
    </div>

    <div class="container-login100-form-btn m-t-17">
        <button class="login100-form-btn">
            Sign Up
        </button>
    </div>

    <div class="w-full text-center p-t-55">
        <span class="txt2">
            Already have an Account?
        </span>

        <a href="{{route('admin.login')}}" class="txt2 bo1">
            Sign in now
        </a>
    </div>
</form>
@endsection
