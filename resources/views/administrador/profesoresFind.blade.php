<x-dashboard>
    <x-slot name="title">
        Buscar profesores
    </x-slot>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 mt-5">
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
        @foreach($profesores as $profesor)
            @php $a = 1; $aa = false; @endphp
            @php $b = 1; $bb = false; @endphp
            @php $c = 1; $cc = false; @endphp
            @php $d = 1; $dd = false; @endphp
            @php $e = 1; $ee = false; @endphp
            @php $f = 1; $ff = false; @endphp
            <a href="{{ route('admin.profesorShow', $profesor) }}" class="text-decoration-none">
                <div class="card" style="background-color: #cecabc;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title fw-bold" style="color: #433d2c;">{{ $profesor->nombre }} {{ $profesor->apellido_paterno }} {{ $profesor->apellido_materno }}</h5>
                            <button type="button" class="btn btn-success" disabled>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calculator" viewBox="0 0 16 16">
                                <path d="M12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h8zM4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4z"/>
                                <path d="M4 2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-2zm0 4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-4z"/>
                                </svg>
                                @foreach($promedios as $promedio)
                                    @foreach($promedio as $prom)
                                        @if($prom->profesor_id == $profesor->id)
                                            {{ round($prom->promedio, 2) }}
                                        @endif
                                    @endforeach
                                @endforeach
                            </button>
                        </div>
                        <h6 class="card-subtitle d-inline" style="color: #433d2c;">UNIVERSIDAD: </h6>
                        <h6 class="card-subtitle text-muted d-inline" style="color: #433d2c;">{{ $profesor->cu }}</h6>
                        <br>
                        <div>
                            <button type="button" class="btn btn-primary d-inline me-2 my-2" disabled>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-alarm" viewBox="0 0 16 16">
                                    <path d="M8.5 5.5a.5.5 0 0 0-1 0v3.362l-1.429 2.38a.5.5 0 1 0 .858.515l1.5-2.5A.5.5 0 0 0 8.5 9V5.5z"/>
                                    <path d="M6.5 0a.5.5 0 0 0 0 1H7v1.07a7.001 7.001 0 0 0-3.273 12.474l-.602.602a.5.5 0 0 0 .707.708l.746-.746A6.97 6.97 0 0 0 8 16a6.97 6.97 0 0 0 3.422-.892l.746.746a.5.5 0 0 0 .707-.708l-.601-.602A7.001 7.001 0 0 0 9 2.07V1h.5a.5.5 0 0 0 0-1h-3zm1.038 3.018a6.093 6.093 0 0 1 .924 0 6 6 0 1 1-.924 0zM0 3.5c0 .753.333 1.429.86 1.887A8.035 8.035 0 0 1 4.387 1.86 2.5 2.5 0 0 0 0 3.5zM13.5 1c-.753 0-1.429.333-1.887.86a8.035 8.035 0 0 1 3.527 3.527A2.5 2.5 0 0 0 13.5 1z"/>
                                </svg>
                                @foreach($puntualidad as $punt)
                                    @if($aa) @break @endif
                                    @foreach($punt as $key=>$datos)
                                        @if($datos == $profesor->id) @php $a++; @endphp
                                        @elseif($a == 2) {{ round($datos, 2) }} @php $aa = true; @endphp @break
                                        @endif
                                    @endforeach
                                @endforeach
                            </button>
                            <button type="button" class="btn btn-primary d-inline me-2" disabled>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-emoji-smile" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="M4.285 9.567a.5.5 0 0 1 .683.183A3.498 3.498 0 0 0 8 11.5a3.498 3.498 0 0 0 3.032-1.75.5.5 0 1 1 .866.5A4.498 4.498 0 0 1 8 12.5a4.498 4.498 0 0 1-3.898-2.25.5.5 0 0 1 .183-.683zM7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5zm4 0c0 .828-.448 1.5-1 1.5s-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5z"/>
                                </svg>
                                @foreach($personalidad as $perso)
                                    @if($bb) @break @endif
                                    @foreach($perso as $key=>$datos)
                                        @if($datos == $profesor->id) @php $b++; @endphp
                                        @elseif($b == 2) {{ round($datos, 2) }} @php $bb = true; @endphp @break
                                        @endif
                                    @endforeach
                                @endforeach
                            </button>
                            <button type="button" class="btn btn-primary d-inline me-2" disabled>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-mortarboard-fill" viewBox="0 0 16 16">
                                    <path d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917l-7.5-3.5Z"/>
                                    <path d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466 4.176 9.032Z"/>
                                </svg>
                                @foreach($aprendizaje_obtenido as $aprend)
                                    @if($cc) @break @endif
                                    @foreach($aprend as $key=>$datos)
                                        @if($datos == $profesor->id) @php $c++; @endphp
                                        @elseif($c == 2) {{ round($datos, 2) }} @php $cc = true; @endphp @break
                                        @endif
                                    @endforeach
                                @endforeach
                            </button>
                            <button type="button" class="btn btn-primary d-inline me-2" disabled>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-ui-checks" viewBox="0 0 16 16">
                                    <path d="M7 2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-1zM2 1a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2H2zm0 8a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2v-2a2 2 0 0 0-2-2H2zm.854-3.646a.5.5 0 0 1-.708 0l-1-1a.5.5 0 1 1 .708-.708l.646.647 1.646-1.647a.5.5 0 1 1 .708.708l-2 2zm0 8a.5.5 0 0 1-.708 0l-1-1a.5.5 0 0 1 .708-.708l.646.647 1.646-1.647a.5.5 0 0 1 .708.708l-2 2zM7 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-1zm0-5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 8a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
                                </svg>
                                @foreach($manera_evaluar as $maneval)
                                    @if($dd) @break @endif
                                    @foreach($maneval as $key=>$datos)
                                        @if($datos == $profesor->id) @php $d++; @endphp
                                        @elseif($d == 2) {{ round($datos, 2) }} @php $dd = true; @endphp @break
                                        @endif
                                    @endforeach
                                @endforeach
                            </button>
                            <button type="button" class="btn btn-primary d-inline me-2" disabled>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-graph-up" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M0 0h1v15h15v1H0V0Zm14.817 3.113a.5.5 0 0 1 .07.704l-4.5 5.5a.5.5 0 0 1-.74.037L7.06 6.767l-3.656 5.027a.5.5 0 0 1-.808-.588l4-5.5a.5.5 0 0 1 .758-.06l2.609 2.61 4.15-5.073a.5.5 0 0 1 .704-.07Z"/>
                                </svg>
                                @foreach($calificacion_obtenida as $colobt)
                                    @if($ee) @break @endif
                                    @foreach($colobt as $key=>$datos)
                                        @if($datos == $profesor->id) @php $e++; @endphp
                                        @elseif($e == 2) {{ round($datos, 2) }} @php $ee = true; @endphp @break
                                        @endif
                                    @endforeach
                                @endforeach
                            </button>
                            <button type="button" class="btn btn-primary d-inline me-2" disabled>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle-fill" viewBox="0 0 16 16">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z"/>
                                </svg>
                                @foreach($conocimiento as $conocim)
                                    @if($ff) @break @endif
                                    @foreach($conocim as $key=>$datos)
                                        @if($datos == $profesor->id) @php $f++; @endphp
                                        @elseif($f == 2) {{ round($datos, 2) }} @php $ff = true; @endphp @break
                                        @endif
                                    @endforeach
                                @endforeach
                            </button>
                        </div>
                    </div>
                </div>
            </a>
            <br>
        @endforeach
    </div>
</x-dashboard>