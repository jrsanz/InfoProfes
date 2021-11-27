<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <style>
        img {
            width: 25%;
            height: auto;
        }

        h1 {
            text-align: center;
        }

        h3, h5 {
            text-align: right;
        }

        h3 {
            margin-bottom: 0;
        }

        h5 {
            margin-top: 10px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        table th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
        }

        table tr:nth-child(even){background-color: #f2f2f2;}
    </style>
</head>
<body>
    <div style="display: inline-flex;">
        <img src="{{ asset('img/InfoProfes Logo.JPG') }}">
        <div>
            <h3>Fecha: {{ date('d-m-Y') }}</h3>
            <h5>Reporte generado por: {{ Auth::user()->name }}</h5>
        </div>
    </div>
    <hr>
    <h1>Reporte de Profesores</h1>
    <hr>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>Centro Universitario</th>
            </tr>
        </thead>
        <tbody>
            @foreach($profesores as $profesor)
                <tr>
                    <td>{{ $profesor->nombre }}</td>
                    <td>{{ $profesor->apellido_paterno }}</td>
                    <td>{{ $profesor->apellido_materno }}</td>
                    <td>{{ $profesor->cu }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>