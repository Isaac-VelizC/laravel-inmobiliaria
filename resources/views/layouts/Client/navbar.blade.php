<div class="click-closed"></div>
<!--/ Nav Star /-->
<nav class="navbar navbar-default navbar-trans navbar-expand-lg fixed-top">
  <div class="container">
    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarDefault"
      aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation">
      <span></span>
      <span></span>
      <span></span>
    </button>
    <a class="navbar-brand text-brand" href="{{ url('/') }}">Soluciones<span class="color-b">{{"
        "}}Inmobiliarias</span></a>
    <div class="navbar-collapse collapse justify-content-center" id="navbarDefault">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}">Inicio</a>
        </li>
        @auth
        @role('Admin')
        <li class="nav-item">
          <a class="nav-link" href="{{ route('home') }}">Administración</a>
        </li>
        @endrole
        @endauth
        <li class="nav-item">
          <a class="nav-link {{ Request::is('propieades') ? 'active' : '' }}"
            href="{{ route('home.propiedades') }}">Propiedades</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('nosotros') ? 'active' : '' }}"
            href="{{ route('home.nosotros') }}">Nosotros</a>
        </li>
      </ul>
    </div>
    @guest
    <a href="{{ route('login') }}" class="btn btn-b-n navbar-toggle-box-collapse d-none d-md-block">
      Iniciar Sesión
    </a>
    @else
    <a class="btn btn-b-n navbar-toggle-box-collapse d-none d-md-block" href="{{ route('logout') }}" onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
      Salir
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
      @csrf
    </form>
    @endguest
  </div>
</nav>
<!--/ Nav End /-->