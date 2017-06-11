@extends('layouts.master')

@section('content')

    <div class="container">

        <div class="auth">

            <form id='register' method="POST" action="{{ route('password.request') }}">
                {{ csrf_field() }}
                <h2>Відновлення пароля</h2>

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="control-label">* E-Mail адреса</label>
                    <input class="form-control" id="email" type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                    @if($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="control-label">* Пароль</label>
                    <input class="form-control" id="password" type="password" name="password" placeholder="Пароль" required>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <label for="password-confirm" class="control-label">* Підтвердження пароля</label>
                    <input class="form-control" id="password-confirm" type="password" name="password_confirmation" placeholder="Підтвердження пароля" required>
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>
                <br>
                <div class="form-group">
                    <button type="submit" class="btn btn-default btn-block">Встановити пароль</button>
                </div>
                <p class="small text-center">* Обов&rsquo;язкові поля</p>
            </form>

        </div>

    </div>

@endsection
