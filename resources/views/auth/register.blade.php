@extends('layouts.guest')

@section('content')
<div class="login-container">
    <div class="login-content">
        <div class="login-content_header">
            <span id="logo">
                Soluciones Inmobiliarias
            </span>
            <h2>Registrar Cuenta</h2>
        </div>
        <div>
            <form id="formAuthentication" class="login-form" action="{{ route('register') }}" method="POST">
                @csrf
                <input type="text" class="@error('name') is-invalid @enderror" id="username" name="name"
                    placeholder="Nombre de Usuario" autofocus value="{{ old('name') }}">
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <span class="fw-medium">{{ $message }}</span>
                </span>
                @enderror

                <input type="text" class="@error('apellido') is-invalid @enderror" id="apellido" name="apellido"
                    placeholder="Apellidos" autofocus value="{{ old('apellido') }}">
                @error('apellido')
                <span class="invalid-feedback" role="alert">
                    <span class="fw-medium">{{ $message }}</span>
                </span>
                @enderror
                <input type="text" class="@error('email') is-invalid @enderror" id="email" name="email"
                    placeholder="john@example.com" value="{{ old('email') }}">
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <span class="fw-medium">{{ $message }}</span>
                </span>
                @enderror
                <input type="text" class="@error('phone') is-invalid @enderror" id="phone" name="phone"
                    placeholder="00000000" value="{{ old('phone') }}">
                @error('phone')
                <span class="invalid-feedback" role="alert">
                    <span class="fw-medium">{{ $message }}</span>
                </span>
                @enderror
                <input type="password" id="password" class="@error('password') is-invalid @enderror" name="password"
                    placeholder="********" aria-describedby="password" />
                <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <span class="fw-medium">{{ $message }}</span>
                </span>
                @enderror
                <input type="password" id="password-confirm" name="password_confirmation" placeholder="********"
                    aria-describedby="password" />
                <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
                <input type="submit" value="Registrarse" style="cursor: pointer;"/>
            </form>
            <div class="login-netoworks">
                <p class="text-center mt-2">
                    <span>Ya tienes una cuenta?</span>
                    @if (Route::has('login'))
                    <a href="{{ route('login') }}">
                        <span>Inicia sesión en su lugar</span>
                    </a>
                    @endif
                </p>
            </div>
        </div>
    </div>
    <div class="login-footer"></div>
</div>
@endsection