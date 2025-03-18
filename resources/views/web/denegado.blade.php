@extends('layouts.client.app')

@section('title', 'Acceso Denegado')

@section('content')
<section class="error-area-1 position-relative">
    <div class="container">
        <div class="error-img">
            <img src="{{ asset('/imgs/error_1_1.png')}}" alt="404 image">
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="error-content">
                    <h2 class="error-title">403</h2>
                    <h3 class="error-subtitle">Esta página ha sido denegada.</h3>
                    <p class="error-text">Debe estar registrado y logeado.</p>
                    <a href="{{ route('login') }}" class="btn btn-b">Login</a>
                    <a href="{{ route('welcome') }}" class="btn btn-a">Principal</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection