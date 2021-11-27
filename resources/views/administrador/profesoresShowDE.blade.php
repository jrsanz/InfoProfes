<x-dashboard>
    <x-slot name="title">
        Datos Escolares De Los Profesores
    </x-slot>
    <x-slot name="styles">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.3/r-2.2.9/datatables.min.css"/>
    </x-slot>
    <div class="container my-5">
        <table class="table table-hover table-striped shadow-lg p-3 rounded display responsive nowrap" id="profesores" style="background-color: #f0f0f0; border-color: #e9e9e9; width: 100%;">
            <thead>
                <tr>
                    <th>Nombre Completo</th>
                    <th>Materia</th>
                    <th>NRC</th>
                </tr>
            </thead>
            <tbody>
                @foreach($profesores as $profesor)
                    @foreach($profesor->subjects as $subject)
                        <tr>
                            <td>{{ $profesor->nombre }} {{ $profesor->apellido_paterno }} {{ $profesor->apellido_materno }}</td>
                            <td>{{ $subject->materia }}</td>
                            <td>{{ $subject->nrc }}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
    <x-slot name="script">
        <x-profesores-show-script>
        </x-profesores-show-script>
    </x-slot>
</x-dashboard>