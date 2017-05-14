@extends('layouts.master')

@section('content')

    <div class="container">

        <div class="auth">

            <form id='register' method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}
                <h2>Register</h2>
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="control-label">* Name</label>
                    <input class="form-control" id="name" type="text" name="name" placeholder="Name" value="{{ old('name') }}" required autofocus>
                    @if($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="control-label">* E-Mail Address</label>
                    <input class="form-control" id="email" type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                    @if($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="control-label">* Password</label>
                    <input class="form-control" id="password" type="password" name="password" placeholder="Password" required>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <label for="password-confirm" class="control-label">* Confirm Password</label>
                    <input class="form-control" id="password-confirm" type="password" name="password_confirmation" placeholder="Confirm Password" required>
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>
                <br>
                <div class="form-group">
                    <button type="submit" class="btn btn-default btn-block">Register</button>
                </div>
                <p class="small text-center">* Required fields</p>
            </form>

            <h5 class="text-center">Already have an account?</h5>
            <a href="/login" class="btn btn-default btn-block" role="button">Login</a>

        </div>

    </div>

@endsection
