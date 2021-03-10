<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>
<body>
<main class="container">
    <h1>Formulario de envío</h1>

    <div class="alert bg-light col-6 mx-auto shadow">
        <form action="/procesa" method="post">
        @csrf
            Nombre: <br>
            <input type="text" name="nombre"
                   class="form-control">
            <br>
            <button class="btn btn-dark">Enviar</button>
        </form>
    </div>

</main>

</body>
</html>
