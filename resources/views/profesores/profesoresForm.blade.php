<x-header>
    <x-slot name="title">
        Agregar profesor
    </x-slot>
</x-header>

<x-navbar>
    <form class="shadow-lg p-3 my-5 rounded create_profesor" action="{{ route('profesor.store') }}" method="POST" style="background-color: #e5d9b0;" novalidate>
        @csrf
        <h1 class="text-center my-3">AGREGAR PROFESOR</h1>
        <hr>
        <h5>DATOS BÁSICOS</h5>
        <div class="row mt-3">
            <div class="col">
                <label class="form-label" for="nombre">Nombre(s)</label>
                <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" required>
                @error('nombre')
                    <div class="invalid-feedback">
                        <strong> {{ $message }} </strong>
                    </div>
                @enderror
            </div>
            <div class="col">
                <label class="form-label" for="apellido_paterno">Apellido Paterno</label>
                <input type="text" class="form-control @error('apellido_paterno') is-invalid @enderror" name="apellido_paterno" value="{{ old('apellido_paterno') }}" required>
                @error('apellido_paterno')
                    <div class="invalid-feedback">
                        <strong> {{ $message }} </strong>
                    </div>
                @enderror
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                <label class="form-label" for="apellido_materno">Apellido Materno</label>
                <input type="text" class="form-control @error('apellido_materno') is-invalid @enderror" name="apellido_materno" value="{{ old('apellido_materno') }}" required>
                @error('apellido_materno')
                    <div class="invalid-feedback">
                        <strong> {{ $message }} </strong>
                    </div>
                @enderror
            </div>
            <div class="col">
                <label class="form-label" for="cu">Centro Universitario</label>
                <select class="form-select @error('cu') is-invalid @enderror" name="cu" required>
                    <option value="CUCEI" selected>CUCEI</option>
                    <option value="CUCEA">CUCEA</option>
                    <option value="CUCS">CUCS</option>
                    <option value="CUAAD">CUAAD</option>
                    <option value="CUCBA">CUCBA</option>
                    <option value="CUCSH">CUCSH</option>
                </select>
                @error('cu')
                    <div class="invalid-feedback">
                        <strong> {{ $message }} </strong>
                    </div>
                @enderror
            </div>
        </div>
        <hr>
        <h5>DATOS ESCOLARES</h5>
        <div class="row mt-3">
            <div class="col">
                <label class="form-label" for="materia">Clave de la materia</label>
                <input type="text" class="form-control @error('materia') is-invalid @enderror" minlength="5" maxlength="10" name="materia" value="{{ old('materia') }}" required>
                @error('materia')
                    <div class="invalid-feedback">
                        <strong> {{ $message }} </strong>
                    </div>
                @enderror
            </div>
            <div class="col">
                <label class="form-label" for="nrc">NRC</label>
                <input type="text" class="form-control @error('nrc') is-invalid @enderror" name="nrc" minlength="5" maxlength="6" value="{{ old('nrc') }}" required>
                @error('nrc')
                    <div class="invalid-feedback">
                        <strong> {{ $message }} </strong>
                    </div>
                @enderror
            </div>
        </div>
        <hr>
        <h5 class="d-inline">CALIFICACIÓN.</h5> <p class="d-inline">Apoyanos siendo el primero en evaluar a este profesor. La calificación va de 0 a 100.</p>
        <div class="row mt-3">
            <div class="col">
                <label class="form-label" for="puntualidad">Puntualidad</label>
                <input type="number" class="form-control @error('puntualidad') is-invalid @enderror" name="puntualidad" min="0" max="100" step="10" value="{{ old('puntualidad') }}" required>
                @error('puntualidad')
                    <div class="invalid-feedback">
                        <strong> {{ $message }} </strong>
                    </div>
                @enderror
            </div>
            <div class="col">
                <label class="form-label" for="personalidad">Personalidad</label>
                <input type="number" class="form-control @error('personalidad') is-invalid @enderror" name="personalidad" min="0" max="100" step="10" value="{{ old('personalidad') }}" required>
                @error('personalidad')
                    <div class="invalid-feedback">
                        <strong> {{ $message }} </strong>
                    </div>
                @enderror
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                <label class="form-label" for="aprendizaje_obtenido">Aprendizaje Obtenido</label>
                <input type="number" class="form-control @error('aprendizaje_obtenido') is-invalid @enderror" name="aprendizaje_obtenido" min="0" max="100" step="10" value="{{ old('aprendizaje_obtenido') }}" required>
                @error('aprendizaje_obtenido')
                    <div class="invalid-feedback">
                        <strong> {{ $message }} </strong>
                    </div>
                @enderror
            </div>
            <div class="col">
                <label class="form-label" for="manera_evaluar">Manera de evaluar/calificar</label>
                <input type="number" class="form-control @error('manera_evaluar') is-invalid @enderror" name="manera_evaluar" min="0" max="100" step="10" value="{{ old('manera_evaluar') }}" required>
                @error('manera_evaluar')
                    <div class="invalid-feedback">
                        <strong> {{ $message }} </strong>
                    </div>
                @enderror
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                <label class="form-label" for="calificacion_obtenida">Calificación Obtenida</label>
                <input type="number" class="form-control @error('calificacion_obtenida') is-invalid @enderror" name="calificacion_obtenida" min="0" max="100" step="10" value="{{ old('calificacion_obtenida') }}" required>
                @error('calificacion_obtenida')
                    <div class="invalid-feedback">
                        <strong> {{ $message }} </strong>
                    </div>
                @enderror
            </div>
            <div class="col">
                <label class="form-label" for="conocimiento">Conocimiento del tema</label>
                <input type="number" class="form-control @error('conocimiento') is-invalid @enderror" name="conocimiento" min="0" max="100" step="10" value="{{ old('conocimiento') }}" required>
                @error('conocimiento')
                    <div class="invalid-feedback">
                        <strong> {{ $message }} </strong>
                    </div>
                @enderror
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                <label class="form-label" for="categoria">¿Cómo categorizarías a este profesor?  Es un profe...</label>
                <select class="form-select @error('categoria') is-invalid @enderror"" name="categoria" required>
                    <option value="EXCELENTE">EXCELENTE</option>
                    <option value="BARCO">BARCO</option>
                    <option value="ESTRICTO">ESTRICTO</option>
                    <option value="FANTASMA">FANTASMA</option>
                    <option value="TERRIBLE">TERRIBLE</option>
                    <option value="FLEXIBLE">FLEXIBLE</option>
                    <option value="INTERACTIVO">INTERACTIVO</option>
                    <option value="REGULAR">REGULAR</option>
                    <option value="RELAJADO">RELAJADO</option>
                    <option value="GROSERO">GROSERO</option>
                </select>
                @error('categoria')
                    <div class="invalid-feedback">
                        <strong> {{ $message }} </strong>
                    </div>
                @enderror
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                <label class="form-label" for="comentario">Comentarios</label>
                <textarea class="form-control @error('comentario') is-invalid @enderror" name="comentario" value="{{ old('comentario') }}" style="height: 100px;"></textarea>
                @error('comentario')
                    <div class="invalid-feedback">
                        <strong> {{ $message }} </strong>
                    </div>
                @enderror
            </div>
        </div>
        <br>
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-success px-4 py-2">Agregar</button>
        </div>
    </form>
</x-navbar>

<x-footer>
</x-footer>