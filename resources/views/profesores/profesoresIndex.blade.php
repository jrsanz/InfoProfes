<x-header>
</x-header>

<x-navbar>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h1 class="text-center mt-5 mb-3">BUSCA A TU PROFESOR</h1>
            <p class="text-center">Por el momento esta plataforma solo incluye profesores de escuelas UDG.</p> <br>
            <form action="{{ route('profesor.search') }}" method="GET">
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
            <a href="{{ route('profesor.create') }}" style="color: #302c1f;"><h5 class="text-center">¿No encuentres a tu profesor? Agrega uno aquí</h5></a>
            <br>
            <a href="{{ route('profesor.showAllDP') }}" style="color: #302c1f;"><h5 class="text-center">Ver Profesores</h5></a>
        </div>
    </div>
    
    <br>
    <h1 class="text-center my-4">BÚSQUEDA POR CENTRO UNIVERSITARIO</h1> <br>
    <div class="row justify-content-center">
        <button type="button" class="btn btn-outline-dark col-md-3 py-3 mb-md-5">CUCEI</button>
        <button type="button" class="btn btn-outline-dark col-md-3 offset-md-1 py-3 mb-md-5">CUCEA</button>
        <button type="button" class="btn btn-outline-dark col-md-3 offset-md-1 py-3 mb-md-5">CUCS</button>
    </div>
    <div class="row justify-content-center">
        <button type="button" class="btn btn-outline-dark col-md-3 py-3 mb-md-5">CUAAD</button>
        <button type="button" class="btn btn-outline-dark col-md-3 offset-md-1 py-3 mb-md-5">CUCBA</button>
        <button type="button" class="btn btn-outline-dark col-md-3 offset-md-1 py-3 mb-md-5">CUCSH</button>
    </div>
    <br>

    <h1 class="text-center" id="top-10">TOP 10 PROFES</h1>
    <table class="table">
        <thead>
            <th>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-award" viewBox="0 0 16 16">
                    <path d="M9.669.864 8 0 6.331.864l-1.858.282-.842 1.68-1.337 1.32L2.6 6l-.306 1.854 1.337 1.32.842 1.68 1.858.282L8 12l1.669-.864 1.858-.282.842-1.68 1.337-1.32L13.4 6l.306-1.854-1.337-1.32-.842-1.68L9.669.864zm1.196 1.193.684 1.365 1.086 1.072L12.387 6l.248 1.506-1.086 1.072-.684 1.365-1.51.229L8 10.874l-1.355-.702-1.51-.229-.684-1.365-1.086-1.072L3.614 6l-.25-1.506 1.087-1.072.684-1.365 1.51-.229L8 1.126l1.356.702 1.509.229z"/>
                    <path d="M4 11.794V16l4-1 4 1v-4.206l-2.018.306L8 13.126 6.018 12.1 4 11.794z"/>
                </svg>
            </th>
            <th>PROFESOR</th>
            <th>CU</th>
            <th>Calificación</th>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>A</td>
                <td>CUCEI</td>
                <td>90.00</td>
            </tr>
            <tr>
                <td>1</td>
                <td>A</td>
                <td>CUCEI</td>
                <td>90.00</td>
            </tr>
            <tr>
                <td>1</td>
                <td>A</td>
                <td>CUCEI</td>
                <td>90.00</td>
            </tr>
            <tr>
                <td>1</td>
                <td>A</td>
                <td>CUCEI</td>
                <td>90.00</td>
            </tr>
            <tr>
                <td>1</td>
                <td>A</td>
                <td>CUCEI</td>
                <td>90.00</td>
            </tr>
            <tr>
                <td>1</td>
                <td>A</td>
                <td>CUCEI</td>
                <td>90.00</td>
            </tr>
            <tr>
                <td>1</td>
                <td>A</td>
                <td>CUCEI</td>
                <td>90.00</td>
            </tr>
            <tr>
                <td>1</td>
                <td>A</td>
                <td>CUCEI</td>
                <td>90.00</td>
            </tr>
            <tr>
                <td>1</td>
                <td>A</td>
                <td>CUCEI</td>
                <td>90.00</td>
            </tr>
            <tr>
                <td>1</td>
                <td>A</td>
                <td>CUCEI</td>
                <td>90.00</td>
            </tr>
        </tbody>
    </table>
    <br>
</x-navbar>

<x-footer>
</x-footer>