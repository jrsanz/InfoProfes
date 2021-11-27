<x-dashboard>
    <x-slot name="title">
        Datos Personales De Los Profesores
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
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Centro Universitario</th>
                    <th>¿Verificado?</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($profesores as $profesor)
                    <tr>
                        <td>{{ $profesor->nombre }}</td>
                        <td>{{ $profesor->apellido_paterno }}</td>
                        <td>{{ $profesor->apellido_materno }}</td>
                        <td>{{ $profesor->cu }}</td>
                        <td>{{ ($profesor->verificado) ? 'Sí' : 'No' }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('admin.profesorEdit', $profesor->id) }}"><button class="btn btn-primary me-2">Editar</button></a>
                                <form action="{{ route('admin.profesorDelete', $profesor) }}" class="profesor_delete" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <x-slot name="script">
        <x-profesores-show-script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
            <script>
                $('.profesor_delete').submit(function(e){
                    e.preventDefault();

                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: "El registro se eliminará",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        cancelButtonText: 'Cancelar',
                        confirmButtonText: 'Sí, eliminar'
                        }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire(
                            'Eliminado!',
                            'El registro ha sido eliminado con éxito',
                            'success'
                            ).then((result) => {
                                if(result.value)
                                    this.submit();
                            })
                        }
                    })
                });
            </script>
        </x-profesores-show-script>
    </x-slot>
</x-dashboard>