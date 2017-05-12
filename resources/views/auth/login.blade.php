@extends('layouts.master')

@section('content')

    <div class="container">

        <form id='login' method="POST" action="/login">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="email" >E-Mail Address</label>
                <input class="form-control" id="email" type="email" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
                @if($errors->has('email'))
                    <div class="error">{{ $errors->first('email') }}</div>
                @endif
            </div>
            <div class="form-group">
                <label for="password" >Password</label>
                <input class="form-control" id="password" type="password"name="password" placeholder="Password" required>
                @if ($errors->has('password'))
                    <div class="error">{{ $errors->first('email') }}</div>
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

    </div>

@endsection
