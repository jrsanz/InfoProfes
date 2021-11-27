<x-dashboard>
    <x-slot name="title">
        Profesor No Encontrado
    </x-slot>
    <div class="container my-5">
        <h5 class="text-center">Profesor no encontrado, intenta nuevamente</h5>
        <br>
        <img class="float-center img-fluid w-50 h-auto d-block mx-auto rounded" src="{{ asset('img/Página no encontrada.png') }}">
        <br>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="{{ route('admin.find') }}" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control me-3" name="nombre" placeholder="Ingresa el nombre del profesor"> <br>
                        <button type="submit" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                            </svg>
                        </button> 
                    </div>
                </form>
            </div>
        </div>
        <br>
        <a href="{{ route('profesor.create') }}" style="color: black;"><h5 class="text-center">O agregalo a la plataforma</h5></a>
    </div>
</x-dashboard>