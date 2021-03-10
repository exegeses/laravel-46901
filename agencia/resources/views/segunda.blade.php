<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>
<body>
<main class="container">
    <h1>Directivas Blade</h1>
    <p>
        Blade es el motor de plantillas que trae laravel.
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi libero perspiciatis quisquam vel? Delectus dignissimos fugit itaque quod repellendus rerum?
    </p>

    <h2>Imprimir</h2>

    {{ time() }}

    <h2>Directivas Blade</h2>

    @if( $nombre == 'marcos' )
        bienvenido {{ $nombre }}
    @endif

    <ul>
    @for( $n = 0; $n < $limite; $n++ )
        <li>{{ $n }}</li>
    @endfor
    </ul>

    <ul class="list-group">
    @foreach( $alemanes as $aleman )
        <li class="list-group-item">
            {{ $aleman }}
        </li>
    @endforeach
    </ul>

</main>

</body>
</html>
