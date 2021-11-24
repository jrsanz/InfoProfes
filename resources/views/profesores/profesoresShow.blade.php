<x-header>
    <x-slot name="title">
        Mostrar profesores
    </x-slot>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.3/r-2.2.9/datatables.min.css"/>
</x-header>

<x-navbar>
    <br>
    <h5>¿Qué tipo de datos deseas ver del profesor?</h5>
    <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
        <input type="radio" class="btn-check" name="datos" id="personales" autocomplete="off" checked>
        <label class="btn btn-outline-light" for="personales">Personales</label>

        <input type="radio" class="btn-check" name="datos" id="escolares" autocomplete="off">
        <label class="btn btn-outline-light" for="escolares">Escolares</label>

        <input type="radio" class="btn-check" name="datos" id="calificaciones" autocomplete="off">
        <label class="btn btn-outline-light" for="calificaciones">Calificaciones</label>
    </div>
    <br><br>
    <table class="table table-hover table-striped shadow-lg p-3 rounded display responsive nowrap" id="profesores" style="background-color: #e5d9b0; border-color: #89826a; width: 100%;">
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
                            <a href="{{ route('profesor.edit', $profesor->id) }}"><button class="btn btn-primary me-2">Editar</button></a>
                            <form action="{{ route('profesor.destroy', $profesor) }}" class="profesor_delete" method="POST">
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
    <br>
</x-navbar>

<x-footer>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        $(document).ready(function() {
            $('#profesores').DataTable({
                responsive: true,
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.11.3/i18n/es-mx.json'
                }
            });
        });

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
    </script>
</x-footer>