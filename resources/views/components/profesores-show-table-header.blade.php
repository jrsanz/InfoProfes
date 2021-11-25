<br>
    <h5>¿Qué tipo de datos deseas ver del profesor?</h5>
    <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
        <a href="{{ route('profesor.showAllDP') }}"><button type="button" class="btn btn-primary me-2" name="datos">Personales</button></a>
        <a href="{{ route('profesor.showAllDE') }}"><button type="button" class="btn btn-primary me-2" name="datos">Escolares</button></a>
        <a href="{{ route('profesor.showAllDC') }}"><button type="button" class="btn btn-primary" name="datos">Calificaciones</button></a>
    </div>
    <br><br>
    <table class="table table-hover table-striped shadow-lg p-3 rounded display responsive nowrap" id="profesores" style="background-color: #e5d9b0; border-color: #89826a; width: 100%;">
        <thead>
            {{ $slot }}
        </thead>