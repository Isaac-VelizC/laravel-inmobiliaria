<!-- ======== sidebar-nav start =========== -->
<aside class="sidebar-nav-wrapper">
    <div class="navbar-logo">
        <a href="{{ url('/') }}">
            <img src="{{ asset('assets/dashboard/images/logo/logo.svg')}}" alt="logo" />
        </a>
    </div>
    <nav class="sidebar-nav">
        <ul>
            <li class="nav-item">
                <a href="{{ route('home') }}" class="active">
                    <span class="icon mdi mdi-home-outline"></span>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li class="nav-item nav-item-has-children">
                <a href="#0" data-bs-toggle="collapse" data-bs-target="#ddmenu_2" aria-controls="ddmenu_2">
                    <span class="icon mdi mdi-home-modern"></span>
                    <span class="text">Propiedades</span>
                </a>
                <ul id="ddmenu_2" class="collapse dropdown-nav">
                    <li>
                        <a href="{{ route('adm.index.propiedades') }}"> Lista </a>
                    </li>
                    <li>
                        <a href="{{ route('adm.create.propiedades') }}"> Agregar </a>
                    </li>
                    <li>
                        <a href="{{ route('adm.propietarios.index') }}"> Propietarios </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="{{ route('adm.citas.group.index') }}">
                    <span class="icon mdi mdi-account-clock"></span>
                    <span class="text">Citas</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('adm.servicios.index') }}">
                    <span class="icon mdi mdi-hammer-wrench"></span>
                    <span class="text">Servicios</span>
                </a>
            </li>
            <span class="divider">
                <hr />
            </span>
            <li class="nav-item">
                <a href="{{ route('adm.usuarios.index') }}">
                    <span class="icon mdi mdi-account-group"></span>
                    <span class="text">Usuarios</span>
                </a>
            </li>
        </ul>
    </nav>
</aside>
<div class="overlay"></div>
<!-- ======== sidebar-nav end =========== -->