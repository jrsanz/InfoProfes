<x-profesores-show-header>
</x-profesores-show-header>

<x-navbar>
    <br>
    <div class="row justify-content-center">
        <div class="col-12">
            <form action="{{ route('profesor.search') }}" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control me-3" name="nombre" placeholder="Buscar otro profesor"> <br>
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
    <div class="card" style="background-color: #cecabc;">
        <div class="card-body">
            <h4 class="card-title fw-bold" style="color: #433d2c;">{{ $profesor->nombre }} {{ $profesor->apellido_paterno }} {{ $profesor->apellido_materno }}</h4>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <h5 class="fw-bold">DATOS GENERALES:</h5>
                    <p class="fw-bold d-inline">Centro Universitario:</p>
                    <p class="d-inline">{{ $profesor->cu }}</p>
                    <br>
                    <p class="fw-bold d-inline">Profesor verificado:</p>
                    <p class="d-inline">{{ ($profesor->verificado) ? 'Sí' : 'No' }}</p>
                    <br>
                    <p class="fw-bold">Materias que imparte:</p>
                    <table class="table table-hover table-striped shadow-lg p-3 rounded display responsive nowrap" id="profesores" style="background-color: #e5d9b0; border-color: #89826a; width: 100%;">
                        <thead>
                            <tr>
                                <th>Materia</th>
                                <th>NRC</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($materias as $materia)
                                <tr>
                                    <td>{{ $materia->materia }}</td>
                                    <td>{{ $materia->nrc }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                    <h5 class="fw-bold">CALIFICACIONES:</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="fw-bold d-inline">Puntualidad:</p>
                            <p class="d-inline">100</p>
                            <br>
                            <p class="fw-bold d-inline">Personalidad:</p>
                            <p class="d-inline">100</p>
                            <br>
                            <p class="fw-bold d-inline">Aprendizaje obtenido:</p>
                            <p class="d-inline">100</p>
                        </div>
                        <div class="col-md-6">
                            <p class="fw-bold d-inline">Manera de evaluar:</p>
                            <p class="d-inline">100</p>
                            <br>
                            <p class="fw-bold d-inline">Calificación obtenida:</p>
                            <p class="d-inline">100</p>
                            <br>
                            <p class="fw-bold d-inline">Conocimiento del tema:</p>
                            <p class="d-inline">100</p>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="d-flex justify-content-center">
                <a href="#"><button class="btn btn-primary px-5 py-3">Evaluar Profesor</button></a>
            </div>
            <hr>
            <div class="card" style="background-color: #908d84;">
                <div class="card-body">
                    <h5 class="d-inline">Evaluaciones</h5>
                    <div class="d-inline float-end">
                        <button class="btn btn-primary me-2">Verificados</button>
                        <button class="btn btn-primary">No Verificados</button>
                    </div>
                </div>
            </div>
            <hr>
            <h5>Comentarios</h5>
        </div>
    </div>
    <br>
</x-navbar>

<x-footer>
</x-footer>