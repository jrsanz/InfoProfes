<x-profesores-show-header>
</x-profesores-show-header>

<x-navbar>
    <x-profesores-show-table-header>
        <tr>
            <th>Nombre Completo</th>
            <th>Puntualidad</th>
            <th>Personalidad</th>
            <th>Aprendizaje Obtenido</th>
            <th>Manera de evaluar</th>
            <th>Calificación obtenida</th>
            <th>Conocimiento</th>
            <th>Categoría</th>
        </tr>
    </x-profesores-show-table-header>
    <tbody>
        @foreach($profesores as $profesor)
            @foreach($profesor->grades as $grade)
                <tr>
                    <td>{{ $profesor->nombre }} {{ $profesor->apellido_paterno }} {{ $profesor->apellido_materno }}</td>
                    <td>{{ $grade->puntualidad }}</td>
                    <td>{{ $grade->personalidad }}</td>
                    <td>{{ $grade->aprendizaje_obtenido }}</td>
                    <td>{{ $grade->manera_evaluar }}</td>
                    <td>{{ $grade->calificacion_obtenida }}</td>
                    <td>{{ $grade->conocimiento }}</td>
                    <td>{{ $grade->categoria }}</td>
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