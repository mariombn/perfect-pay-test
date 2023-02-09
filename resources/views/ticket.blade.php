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
<main>
    <div class="content">
        <center>
            <h1>Sucesso</h1>
            <p><a href="{{ $ticketMLUrl }}">Clique para acessar o Boleto</a></p>

            <iframe src="{{ $ticketMLUrl }}" width="90%" height="500px"></iframe>

            <p><a href="{{ url('/') }}">Voltar</a></p>
        </center>
    </div>
</main>
</body>
</html>
