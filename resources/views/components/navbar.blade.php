<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #dac88e;">
  <div class="container">
    <a class="navbar-brand" href="{{ route('profesor.index') }}">
        <img src="{{asset('/img/InfoProfes Logo.JPG')}}">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav m-auto">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('profesor.index') }}">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('profesor.index') }}#top-10">Top 10</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('profesor.index') }}#otros-sitios">Otros Sitios</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('profesor.create') }}">Agregar Profesor</a>
        </li>
      </ul>
      <div class="d-flex">
        @if(Auth::check())
          @if(Auth::user()->type_of_user == "user")
            <div class="btn-group">
              <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                @if(Auth::user()->profile_photo_path == null)
                  <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                      <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                      <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                  </svg>
                @else
                    <img class="rounded-circle me-2" src="/img/avatares/{{ Auth::user()->profile_photo_path }}" style="width: 30px; height: 30px;">
                @endif
                {{ Auth::user()->name }}
              </button>
              <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                  <li><a class="dropdown-item" href="{{ route('profesor.miPerfil') }}">Mi Perfil</a></li>
                  <li>
                      <hr class="dropdown-divider">
                  </li>
                  <form action="{{ route('logout') }}" method="POST">
                      @csrf
                      <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">Cerrar Sesión</a></li>
                  </form>
              </ul>
            </div>
          @endif
        @else
            <a href="{{ route('login') }}"><button class="btn btn-outline-primary" type="submit">LOGIN</button></a>
            <a href="{{ route('register') }}"><button class="btn btn-outline-success ms-3 me-5" type="submit">REGISTRO</button></a>
        @endif
      </div>
    </div>
  </div>
</nav>

<div class="container">
  {{$slot}}
</div>