@extends('layouts.master')

@section('content')

    <div class="container">

        <div class="auth">

            <form id='login' method="POST" action="/login">
                {{ csrf_field() }}
                <h2>Login</h2>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="control-label">E-Mail Address</label>
                    <input class="form-control" id="email" type="email" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
                    @if($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="control-label">Password</label>
                    <input class="form-control" id="password" type="password" name="password" placeholder="Password" required>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                            </label>
                        </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-default">Login</button>
                    <a class="btn btn-link" href="/password/reset">Forgot Your Password?</a>
                </div>
            </form>

            <h5 class="text-center">New to eXpenses?</h5>
            <a href="/register" class="btn btn-default btn-block" role="button">Register</a>

        </div>

    </div>

@endsection
