@extends('layouts.client.app')

@section('title', 'Cuenta de usuario')

@section('content')

<!--/ Intro Single star /-->
<section class="intro-single">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-8">
                <div class="title-single-box">
                    <h1 class="title-single">Perfil de Usuario</h1>
                </div>
            </div>
            <div class="col-md-12 col-lg-4">
                <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}">Inicio</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Perfil
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<!--/ Intro Single End /-->

@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Close">x</button>
</div>
@endif

@if (session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Close">x</button>
</div>
@endif

<!--/ Profile Section /-->
<section class="section-profile">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="title-d">Información del Usuario</h3>
                <form action="{{ route('user.update', auth()->user()->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ auth()->user()->name }}"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="email">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ auth()->user()->email }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar Información</button>
                </form>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-12">
                <h3 class="title-d">Cambiar Contraseña</h3>
                <form action="{{ route('user.changePassword', auth()->user()->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="current_password">Contraseña Actual</label>
                        <input type="password" class="form-control" id="current_password" name="current_password"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="new_password">Nueva Contraseña</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" required>
                    </div>
                    <div class="form-group">
                        <label for="new_password_confirmation">Confirmar Nueva Contraseña</label>
                        <input type="password" class="form-control" id="new_password_confirmation"
                            name="new_password_confirmation" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Cambiar Contraseña</button>
                </form>
            </div>
        </div>
    </div>
</section>
<!--/ Profile End /-->

@endsection