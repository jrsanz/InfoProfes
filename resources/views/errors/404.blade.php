<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">

    <title>Página No Encontrada</title>
</head>
<body style="background-image: url(http://infoprofes.test:8000/img/Error%20404.jpg); background-position: center center; background-repeat: no-repeat; background-attachment: fixed; background-size: cover;">
    <div class="w-100 h-100">
        <div class="d-block position-absolute text-center text-wrap" style="width: 100%; height: 55%; bottom: 0;">
            <div class="badge bg-black bg-gradient text-wrap" style="width: auto;">
                <h1 style="color: white;">404</h1>
                <h5 style="color: white;">Disculpa, no encontramos el sitio que estabas buscando</h5>
                <br>
                <a href="{{ route('profesor.index') }}">
                    <button class="btn btn-warning">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6zm5-.793V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
                            <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
                        </svg>
                        Ir al inicio
                    </button>
                </a>
                <br><br>
            </div>
        </div>
    </div>
</body>
</html>