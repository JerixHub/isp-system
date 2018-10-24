@extends('layouts.app')

@section('content')
<p class="login-box-msg">Register a new user</p>
<form method="POST" action="{{ route('register') }}">
    @csrf
    <div class="form-group has-feedback">
        <input id="name" type="text" placeholder="Fullname" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        @if ($errors->has('name'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('name') }}</strong>
        </span>
        @endif
    </div>

    <div class="form-group has-feedback">
        <input id="email" type="email" placeholder="Email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        @if ($errors->has('email'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
        @endif
    </div>

    <div class="form-group has-feedback">
        <input id="password" type="password" placeholder="Password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        @if ($errors->has('password'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('password') }}</strong>
        </span>
        @endif
    </div>

    <div class="form-group has-feedback">
        <input id="password-confirm" type="password" placeholder="Retype Password" class="form-control" name="password_confirmation" required>
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <button type="submit" class="btn btn-primary btn-block btn-flat">
                {{ __('Register') }}
            </button>
            <a href="/" class="btn btn-link btn-block btn-flat">I already have account</a>
        </div>
    </div>
</form>
@endsection

@section('css')
<style>
    .btn:active{
        -webkit-box-shadow: none;
        box-shadow: none;
    }
</style>
@endsection

@section('pagename')
register-page
@endsection
