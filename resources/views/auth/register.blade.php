@extends('layouts.master')

@section('content')

    <div class="container">

        <form id='register' method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="name">Name</label>
                <input class="form-control" id="name" type="text" name="name" placeholder="Name" value="{{ old('name') }}" required autofocus>
                @if($errors->has('name'))
                    <div class="error">{{ $errors->first('name') }}</div>
                @endif
            </div>
            <div class="form-group">
                <label for="email" >E-Mail Address</label>
                <input class="form-control" id="email" type="email" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
                @if($errors->has('email'))
                    <div class="error">{{ $errors->first('email') }}</div>
                @endif
            </div>
            <div class="form-group">
                <label for="password" >Password</label>
                <input class="form-control" id="password" type="password" name="password" placeholder="Password" required>
                @if ($errors->has('password'))
                    <div class="error">{{ $errors->first('password') }}</div>
                @endif
            </div>
            <div class="form-group">
                <label for="password-confirm" >Confirm Password</label>
                <input class="form-control" id="password-confirm" type="password" name="password_confirmation" placeholder="Confirm Password" required>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-default">Register</button>
            </div>
        </form>

    </div>

@endsection
