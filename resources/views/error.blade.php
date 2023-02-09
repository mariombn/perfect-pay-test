<!DOCTYPE html>
<html>
<head>
    <title>Compra Finalizada</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
</head>
<body>
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h3>Exceção</h3>
        </div>
        <div class="card-body">
            <h5>Código:</h5>
            <p>{{ $exception->getCode() }}</p>
            <h5>Mensagem:</h5>
            <p>{{ $exception->getMessage() }}</p>
            <h5>Arquivo:</h5>
            <p>{{ $exception->getFile() }}</p>
            <h5>Linha:</h5>
            <p>{{ $exception->getLine() }}</p>
        </div>
    </div>
</div>
</body>
</html>
