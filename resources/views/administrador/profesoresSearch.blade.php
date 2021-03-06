<x-dashboard>
    <x-slot name="title">
        Buscar profesores
    </x-slot>
    <div class="container">
        <div class="row justify-content-center mx-5">
            <div class="col-md-12">
                <h1 class="text-center mt-5 mb-3">BUSCA A TU PROFESOR</h1>
                <p class="text-center">Por el momento esta plataforma solo incluye profesores de escuelas UDG.</p> <br>
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
                <br>
                <a href="{{ route('admin.profesorCreate') }}" style="color: black"><h5 class="text-center">¿No encuentres a tu profesor? Agrega uno aquí</h5></a>
            </div>
        </div>
    </div>
</x-dashboard>