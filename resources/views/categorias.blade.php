<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorias</title>
</head>
<body>
    <h1>Categorias</h1>

    @if($categorias->isEmpty())
        <p>Nenhuma categoria encontrada.</p>
    @else
        <ul>
            @foreach($categorias as $categoria)
                <li>{{ $categoria->id }} - {{ $categoria->name }}</li>
            @endforeach
        </ul>
    @endif

    <p><a href="/">Voltar</a></p>
</body>
</html>
