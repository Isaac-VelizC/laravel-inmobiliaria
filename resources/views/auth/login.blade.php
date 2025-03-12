@extends('layouts.guest')

@section('content')
<div class="login-container">
    <div class="login-content">
        <div class="login-content_header">
            <span id="logo">
                Soluciones Inmobiliarias
            </span>
            <h2>Iniciar Sesión</h2>
        </div>
        <div>
            <form method="POST" action="{{ route('login') }}" class="login-form">
                @csrf
                <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                @error('email')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror

                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="current-password" placeholder="Contraseña">

                @error('password')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror

                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember')
                    ? 'checked' : '' }}>

                <label class="form-check-label" for="remember">
                    {{ __('Recordarme') }}
                </label>

                <input type="submit" value="Iniciar Sesión" style="cursor: pointer"/>

            </form>
            <div class="login-netoworks">
                @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">¿Olvidaste la contraseña?</a>
                @endif
                <span>o</span>
                <a href="{{ route('register') }}">Crear Cuenta</a>
            </div>
            <!--p>By creating an account you agree to Land Scape's <strong>Terms of Services</strong> and <strong>Privary Policy.</strong></p-->
        </div>
    </div>
    <div class="login-footer"></div>
</div>
@endsection