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
          <a class="nav-link" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Home</a>
        </li>
      </ul>
      <div class="d-flex">
        <a href="{{ route('login') }}"><button class="btn btn-outline-primary" type="submit">LOGIN</button></a>
        <a href="{{ route('register') }}"><button class="btn btn-outline-success ms-3 me-5" type="submit">REGISTRO</button></a>
      </div>
    </div>
  </div>
</nav>

<div class="container">
  {{$slot}}
</div>