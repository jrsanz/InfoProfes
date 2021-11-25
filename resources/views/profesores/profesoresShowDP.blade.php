<x-profesores-show-header>
</x-profesores-show-header>

<x-navbar>
    <x-profesores-show-table-header>
        <tr>
            <th>Nombre</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>Centro Universitario</th>
            <th>¿Verificado?</th>
            <th>Acciones</th>
        </tr>
    </x-profesores-show-table-header>
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
    <x-profesores-show-script>
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
</x-footer>