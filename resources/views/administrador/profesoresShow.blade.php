<x-dashboard>
    <x-slot name="title">
        {{ $profesor->nombre }} {{ $profesor->apellido_paterno }} {{ $profesor->apellido_materno }}
    </x-slot>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12">
                <form action="{{ route('admin.find') }}" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control me-3" name="nombre" placeholder="Buscar otro profesor"> <br>
                        <button type="submit" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                            </svg>
                        </button> 
                    </div>
                </form>
            </div>
        </div>
        <br>
        <div class="card" style="background-color: #cecabc;">
            <div class="card-body">
                <h4 class="card-title fw-bold" style="color: #433d2c;">{{ $profesor->nombre }} {{ $profesor->apellido_paterno }} {{ $profesor->apellido_materno }}</h4>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="fw-bold">DATOS GENERALES:</h5>
                        <p class="fw-bold d-inline">Centro Universitario:</p>
                        <p class="d-inline">{{ $profesor->cu }}</p>
                        <br>
                        <p class="fw-bold d-inline">Profesor verificado:</p>
                        <p class="d-inline">{{ ($profesor->verificado) ? 'Sí' : 'No' }}</p>
                        <br>
                        <p class="fw-bold">Materias que imparte:</p>
                        <table class="table table-hover table-striped shadow-lg p-3 rounded display responsive nowrap" id="profesores" style="background-color: #e5d9b0; border-color: #89826a; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Materia</th>
                                    <th>NRC</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($materias as $materia)
                                    <tr>
                                        <td>{{ $materia->materia }}</td>
                                        <td>{{ $materia->nrc }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h5 class="fw-bold">CALIFICACIONES:</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <p class="fw-bold d-inline">Puntualidad:</p>
                                <p class="d-inline">
                                    @foreach($puntualidad as $punt)
                                        @foreach($punt as $key=>$dato)
                                            {{ intval($dato) }}
                                        @endforeach
                                    @endforeach
                                </p>
                                <br>
                                <p class="fw-bold d-inline">Personalidad:</p>
                                <p class="d-inline">
                                    @foreach($personalidad as $pers)
                                        @foreach($pers as $key=>$dato)
                                            {{ intval($dato) }}
                                        @endforeach
                                    @endforeach
                                </p>
                                <br>
                                <p class="fw-bold d-inline">Aprendizaje obtenido:</p>
                                <p class="d-inline">
                                    @foreach($aprendizaje_obtenido as $aprenobt)
                                        @foreach($aprenobt as $key=>$dato)
                                            {{ intval($dato) }}
                                        @endforeach
                                    @endforeach
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="fw-bold d-inline">Manera de evaluar:</p>
                                <p class="d-inline">
                                    @foreach($manera_evaluar as $maneval)
                                        @foreach($maneval as $key=>$dato)
                                            {{ intval($dato) }}
                                        @endforeach
                                    @endforeach
                                </p>
                                <br>
                                <p class="fw-bold d-inline">Calificación obtenida:</p>
                                <p class="d-inline">
                                    @foreach($calificacion_obtenida as $calobt)
                                        @foreach($calobt as $key=>$dato)
                                            {{ intval($dato) }}
                                        @endforeach
                                    @endforeach
                                </p>
                                <br>
                                <p class="fw-bold d-inline">Conocimiento del tema:</p>
                                <p class="d-inline">
                                    @foreach($conocimiento as $conoc)
                                        @foreach($conoc as $key=>$dato)
                                            {{ intval($dato) }}
                                        @endforeach
                                    @endforeach
                                </p>
                            </div>
                            <br>
                            <div class="col-12 mt-3" id="grafico">

                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="d-flex justify-content-center">
                    <a href="{{ route('admin.createMateria', $profesor) }}"><button class="btn btn-primary px-5 py-3 me-5">Asignarle Otra Materia</button></a>
                    <a href="{{ route('admin.evaluate', $profesor) }}"><button class="btn btn-primary px-5 py-3">Evaluar Profesor</button></a>
                </div>
                <hr>
                <div class="card" style="background-color: #908d84;">
                    <div class="card-body">
                        <h5 class="text-center">Evaluaciones</h5>
                    </div>
                </div>
                <hr>
                <h5>Comentarios</h5>
                @foreach($calificaciones as $calificacion)
                    <div class="card mt-3">
                        <div class="card-header d-flex justify-content-between" style="background-color: #c8c6c2;">
                            <h5>
                                @foreach($usuarios as $usuario)
                                    @if($usuario->id == $calificacion->user_id)
                                        {{ $usuario->name }} @break;
                                    @endif
                                @endforeach
                            </h5>
                            <h5>{{ date_format($calificacion->created_at, 'd-m-Y') }}</h5>
                        </div>
                        <div class="card-body" style="background-color: #908d84;">
                            <h5 class="card-title"></h5>
                            <p> {{ $calificacion->comentario }} </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <x-slot name="script">
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/accessibility.js"></script>

        <script>
            Highcharts.chart('grafico', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: 'Puntos Fuertes Del Profesor'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                accessibility: {
                    point: {
                        valueSuffix: '%'
                    }
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                        }
                    }
                },
                series: [{
                    name: 'Brands',
                    colorByPoint: true,
                    data: <?= $data ?>
                }]
            });
        </script>
    </x-slot>
</x-dashboard>