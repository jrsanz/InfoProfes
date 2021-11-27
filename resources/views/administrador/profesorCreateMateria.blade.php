<x-dashboard>
    <div class="container">
        <form class="shadow-lg p-3 my-5 rounded create_profesor" action="{{ route('admin.storeMateria', $profesor) }}" method="POST" style="background-color: #e5d9b0;" novalidate>
            @csrf
            <h1 class="text-center my-3">ASIGNAR NUEVA MATERIA AL PROFESOR</h1>
            <div class="row mt-3">
                <div class="col">
                    <label class="form-label" for="materia">Materia</label>
                    <input type="text" class="form-control @error('materia') is-invalid @enderror" name="materia" minlength="5" maxlength="10" value="{{ old('materia') }}" required>
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
            <br>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-success px-4 py-2">Agregar</button>
            </div>
        </form>
    </div>
</x-dashboard>