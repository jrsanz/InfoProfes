<x-header>
    <x-slot name="title">
        Editar profesor
    </x-slot>
</x-header>

<x-navbar>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form class="shadow-lg p-3 my-5 rounded create_profesor" action="{{ route('profesor.update', $profesor) }}" method="POST" style="background-color: #e5d9b0;">
        @method('PATCH')
        @csrf
        <h1 class="text-center my-3">EDITAR PROFESOR</h1>
        <hr>
        <h5>DATOS BÁSICOS</h5>
        <div class="row mt-3">
            <div class="col">
                <label class="form-label" for="nombre">Nombre(s)</label>
                <input type="text" class="form-control" name="nombre" value="{{ $profesor->nombre }}" required>
            </div>
            <div class="col">
                <label class="form-label" for="apellido_paterno">Apellido Paterno</label>
                <input type="text" class="form-control" name="apellido_paterno" value="{{ $profesor->apellido_paterno }}" required>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                <label class="form-label" for="apellido_materno">Apellido Materno</label>
                <input type="text" class="form-control" name="apellido_materno" value="{{ $profesor->apellido_materno }}" required>
            </div>
            <div class="col">
                <label class="form-label" for="cu">Centro Universitario</label>
                <select class="form-select" name="cu" required>
                    <option value="CUCEI" {{ ($profesor->cu == "CUCEI") ? 'selected' : '' }}>CUCEI</option>
                    <option value="CUCEA" {{ ($profesor->cu == "CUCEA") ? 'selected' : '' }}>CUCEA</option>
                    <option value="CUCS" {{ ($profesor->cu == "CUCS") ? 'selected' : '' }}>CUCS</option>
                    <option value="CUAAD" {{ ($profesor->cu == "CUAAD") ? 'selected' : '' }}>CUAAD</option>
                    <option value="CUCBA" {{ ($profesor->cu == "CUCBA") ? 'selected' : '' }}>CUCBA</option>
                    <option value="CUCSH" {{ ($profesor->cu == "CUCSH") ? 'selected' : '' }}>CUCSH</option>
                </select>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                <label class="form-label" for="verificado">Verificado</label>
                <select class="form-select" name="verificado" required>
                    <option value=0 {{ ($profesor->verificado) ? '' : 'selected' }}>No</option>
                    <option value=1 {{ ($profesor->verificado) ? 'selected' : '' }}>Sí</option>
                </select>
            </div>
        </div>
        <br>
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-success px-4 py-2">Editar</button>
        </div>
    </form>
</x-navbar>

<x-footer>
</x-footer>