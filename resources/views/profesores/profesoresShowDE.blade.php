<x-profesores-show-header>
</x-profesores-show-header>

<x-navbar>
    <x-profesores-show-table-header>
        <tr>
            <th>Nombre Completo</th>
            <th>Materia</th>
            <th>NRC</th>
        </tr>
    </x-profesores-show-table-header>
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
    <br>
</x-navbar>

<x-footer>
    <x-profesores-show-script>
    </x-profesores-show-script>
</x-footer>