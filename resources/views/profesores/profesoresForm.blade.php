<x-header>
    <x-slot name="title">
        Agregar profesor
    </x-slot>
</x-header>

<x-navbar>
    <form class="shadow-lg p-3 my-5 rounded create_profesor" action="{{ route('profesor.store') }}" method="POST" style="background-color: #e5d9b0;">
        @csrf
        <h1 class="text-center my-3">AGREGAR PROFESOR</h1>
        <hr>
        <h5>DATOS BÁSICOS</h5>
        <div class="row mt-3">
            <div class="col">
                <label class="form-label" for="nombre">Nombre(s)</label>
                <input type="text" class="form-control" name="nombre" required>
            </div>
            <div class="col">
                <label class="form-label" for="apellido_paterno">Apellido Paterno</label>
                <input type="text" class="form-control" name="apellido_paterno" required>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                <label class="form-label" for="apellido_materno">Apellido Materno</label>
                <input type="text" class="form-control" name="apellido_materno" required>
            </div>
            <div class="col">
                <label class="form-label" for="cu">Centro Universitario</label>
                <select class="form-select" name="cu" required>
                    <option value="CUCEI" selected>CUCEI</option>
                    <option value="CUCEA">CUCEA</option>
                    <option value="CUCS">CUCS</option>
                    <option value="CUAAD">CUAAD</option>
                    <option value="CUCBA">CUCBA</option>
                    <option value="CUCSH">CUCSH</option>
                </select>
            </div>
        </div>
        <hr>
        <h5>DATOS ESCOLARES</h5>
        <div class="row mt-3">
            <div class="col">
                <label class="form-label" for="materia">Clave de la materia</label>
                <input type="text" class="form-control" minlength="3" maxlength="8" name="materia" required>
            </div>
            <div class="col">
                <label class="form-label" for="nrc">NRC</label>
                <input type="text" class="form-control" name="nrc" minlength="1" maxlength="8" required>
            </div>
        </div>
        <hr>
        <h5 class="d-inline">CALIFICACIÓN.</h5> <p class="d-inline">Apoyanos siendo el primero en evaluar a este profesor</p>
        <div class="row mt-3">
            <div class="col">
                <label class="form-label" for="puntualidad">Puntualidad</label>
                <input type="number" class="form-control" name="puntualidad" min="0" max="100" step="10" required>
            </div>
            <div class="col">
                <label class="form-label" for="personalidad">Personalidad</label>
                <input type="number" class="form-control" name="personalidad" min="0" max="100" step="10" required>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                <label class="form-label" for="aprendizaje_obtenido">Aprendizaje Obtenido</label>
                <input type="number" class="form-control" name="aprendizaje_obtenido" min="0" max="100" step="10" required>
            </div>
            <div class="col">
                <label class="form-label" for="manera_evaluar">Manera de evaluar/calificar</label>
                <input type="number" class="form-control" name="manera_evaluar" min="0" max="100" step="10" required>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                <label class="form-label" for="calificacion_obtenida">Calificación Obtenida</label>
                <input type="number" class="form-control" name="calificacion_obtenida" min="0" max="100" step="10" required>
            </div>
            <div class="col">
                <label class="form-label" for="conocimiento">Conocimiento del tema</label>
                <input type="number" class="form-control" name="conocimiento" min="0" max="100" step="10" required>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                <label class="form-label" for="profe_categoria">¿Cómo categorizarías a este profesor?  Es un profe...</label>
                <select class="form-select" name="profe_categoria" required>
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