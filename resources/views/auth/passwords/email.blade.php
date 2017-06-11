@extends('layouts.master')

@section('content')

    <div class="container">

        <div class="auth">

            <form id='register' method="POST" action="{{ route('password.email') }}">
                {{ csrf_field() }}
                <h2>Відновлення пароля</h2>
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="control-label">* E-Mail адреса</label>
                    <input class="form-control" id="email" type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                    @if($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <br>
                <div class="form-group">
                    <button type="submit" class="btn btn-default btn-block">Відправити відновлювальний лінк</button>
                </div>
                <p class="small text-center">* Обов&rsquo;язкові поля</p>
            </form>

        </div>

    </div>

@endsection
