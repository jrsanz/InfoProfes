<x-dashboard>
    <x-slot name="title">
        Editar permisos de usuario
    </x-slot>
    <div class="container">
        <form class="shadow-lg p-3 my-5 rounded create_profesor" action="{{ route('admin.usuarioUpdate', $usuario) }}" method="POST" style="background-color: #e5d9b0;" novalidate>
            @method('PATCH')
            @csrf
            <h1 class="text-center my-3">EDITAR PERMISOS DE USUARIO</h1>
            <hr>
            <h5>DATOS BÁSICOS</h5>
            <div class="row mt-3">
                <div class="col">
                    <label class="form-label" for="name">Nombre</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $usuario->name }}" required>
                    @error('name')
                        <div class="invalid-feedback">
                            <strong> {{ $message }} </strong>
                        </div>
                    @enderror
                </div>
                <div class="col">
                    <label class="form-label" for="email">Apellido Paterno</label>
                    <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $usuario->email }}" required>
                    @error('email')
                        <div class="invalid-feedback">
                            <strong> {{ $message }} </strong>
                        </div>
                    @enderror
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col">
                    <label class="form-label" for="type_of_user">Centro Universitario</label>
                    <select class="form-select" name="type_of_user" required>
                        <option value="user" {{ ($usuario->type_of_user == "user") ? 'selected' : '' }}>Usuario</option>
                        <option value="admin" {{ ($usuario->type_of_user == "admin") ? 'selected' : '' }}>Administrador</option>
                    </select>
                </div>
            </div>
            <br>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-success px-4 py-2">Editar</button>
            </div>
        </form>
    </div>
</x-dashboard>