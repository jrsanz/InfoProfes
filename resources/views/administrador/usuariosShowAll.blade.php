<x-dashboard>
    <x-slot name="title">
        Usuarios
    </x-slot>
    <x-slot name="styles">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.3/r-2.2.9/datatables.min.css"/>
    </x-slot>
    <div class="container my-5">
        <table class="table table-hover table-striped shadow-lg p-3 rounded display responsive nowrap" id="profesores" style="background-color: #f0f0f0; border-color: #e9e9e9; width: 100%;">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Correo electrónico</th>
                    <th>Tipo de usuario</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usuarios as $usuario)
                    <tr>
                        <td>{{ $usuario->name }}</td>
                        <td>{{ $usuario->email }}</td>
                        @if($usuario->type_of_user == "admin")
                            <td>Administrador</td>
                        @else
                            <td>Usuario</td>
                        @endif
                        <td>
                            <a href="@if(Auth::user()->id == $usuario->id || $usuario->id == 1) # @else {{ route('admin.usuarioEdit', $usuario->id) }} @endif"><button class="btn btn-primary me-2" @if(Auth::user()->id == $usuario->id || $usuario->id == 1) disabled @endif }} >Editar Permisos</button></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <x-slot name="script">
        <x-profesores-show-script>
        </x-profesores-show-script>
    </x-slot>
</x-dashboard>