@extends('layouts.app')

@section('content')
<p class="login-box-msg">Sign in to start using ISP.</p>
<form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="form-group has-feedback">
        <input id="email" type="email" placeholder="Email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
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
    <div class="row">
        <div class="col-xs-8">
            <div class="checkbox icheck">
                <label>
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    {{ __('Remember Me') }}
                </label>
            </div>
        </div>
        <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">
                {{ __('Sign In') }}
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <a class="btn btn-danger btn-block btn-flat" href="{{ route('password.request') }}">
                {{ __('I forgot my password') }}
            </a>
            @if (Route::has('register'))
            <a class="btn btn-success btn-block btn-flat" href="{{ route('register') }}">{{ __('Register') }}</a>
            @endif
        </div>
    </div>
</form>
@endsection

@section('pagename')
login-page
@endsection

@section('js')
<script>
    $(document).ready(function(){
        $('#remember').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            increaseArea: '20%'
        });
    });
</script>
@endsection
