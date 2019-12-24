@extends('auth.layout')

@section('login-form')

    <form class="form-login" role="form" method="POST" action="{{ url('/guardian/register') }}">
        <h2 style="background-color: #CC6633" class="form-login-heading">Guardian</h2>
        <h2 style="background-color: #CC6633" class="form-login-heading">Registration</h2>
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                {{$errors->first()}}
            </div>
        @endif

        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="login-wrap">
            <input type="text" class="form-control" name="name" placeholder="name "
                   autofocus value="{{ old('name') }}">
            <br>
            <input type="text" class="form-control" name="username" placeholder="username "
                   autofocus value="{{ old('username') }}">
            <br>
            <input type="text" class="form-control" name="phone" placeholder="Phone Number" value="{{ old('phone') }}">
            <br>
            <select  class="form-control" name="gender">
                <option>Male</option>
                <option>Female</option>
            </select> 
            <br>
            <textarea  class="form-control" name="address" placeholder="Address">{{ old('address') }}</textarea> 
            <br>
            <input type="password" class="form-control" name="password"
                   placeholder="Choose a password, at least 6 characters. ">
            <br>
            <input type="password" class="form-control" name="password_confirmation"
                   placeholder="Retype Password. ">
            <br>
            <button style="background-color: #CC6633" class="btn btn-theme btn-block" type="submit"><i class="fa fa-lock"></i>REGISTER</button>

            <div class="registration">
                Already have a password??<br/>
                <a class="" href="/guardian">
                    Login here..
                </a>
            </div>

        </div>
    </form>
@endsection
