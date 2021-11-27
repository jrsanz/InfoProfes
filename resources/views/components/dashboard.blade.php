<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Administrador' }}</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">

    {{ $styles ?? '' }}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <a href="{{ route('admin.index') }}">
                        <img class="d-none d-sm-inline d-flex align-items-center pb-3 mb-md-0 me-md-auto" src="{{ asset('img/InfoProfes Logo.JPG') }}">
                    </a>
                    <a class="text-decoration-none" href="{{ route('admin.index') }}">
                        <span class="fs-5 d-none d-sm-inline d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white">Administrador</span>
                    </a>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                        <li class="nav-item">
                            <a href="{{ route('admin.index') }}" class="nav-link align-middle px-0">
                                <i class="fs-4 bi-speedometer2"></i> <span class="ms-1 d-none d-sm-inline">Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-person-video3"></i> <span class="ms-1 d-none d-sm-inline">Profesores</span> </a>
                            <ul class="collapse nav flex-column ms-3" id="submenu1" data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="{{ route('admin.profesorShowAllDP') }}" class="nav-link px-0"> <i class="fs-5 bi-person"></i> <span class="d-none d-sm-inline">Datos Personales</span></a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.profesorShowAllDE') }}" class="nav-link px-0"> <i class="fs-5 bi-mortarboard"></i> <span class="d-none d-sm-inline">Datos Escolares</span></a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.profesorShowAllDC') }}" class="nav-link px-0"> <i class="fs-5 bi-bar-chart"></i> <span class="d-none d-sm-inline">Datos Evaluaciones</span></a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{ route('admin.usuarios') }}" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Usuarios</span> </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.search') }}" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Evaluar Profes</span> </a>
                        </li>
                        <li>
                            <a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-file-earmark-pdf""></i> <span class="ms-1 d-none d-sm-inline">Generar Reportes</span> </a>
                            <ul class="collapse nav flex-column ms-3" id="submenu2" data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="{{ route('admin.reporteUsuarios') }}" class="nav-link px-0" target="_blank"> <i class="fs-5 bi-people"></i> <span class="d-none d-sm-inline">Usuarios</span></a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.reporteProfesores') }}" class="nav-link px-0" target="_blank"> <i class="fs-5 bi-person-video3"></i> <span class="d-none d-sm-inline">Profesores</span></a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <hr>
                    <div class="dropdown pb-4">
                        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            @if(Auth::user()->profile_photo_path == null)
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                            </svg>
                            @else
                                <img class="rounded-circle me-2" src="/img/avatares/{{ Auth::user()->profile_photo_path }}" style="width: 50px; height: 50px;">
                            @endif
                            <span class="d-none d-sm-inline mx-1">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                            <li><a class="dropdown-item" href="{{ route('admin.miPerfil') }}">Mi Perfil</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">Cerrar Sesión</a></li>
                            </form>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-auto col-md-9 col-xl-10" style="background-color: #d3d3d3;">
                {{ $slot }}
            </div>
        </div>
    </div>
    
    {{ $script ?? '' }}

    @include('sweetalert::alert')
</body>
</html>