<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materiais</title>
</head>
<body>
    <h1>Materiais</h1>

    @if($materiais->isEmpty())
        <p>Nenhum material encontrado.</p>
    @else
        <ul>
            @foreach($materiais as $material)
                <li>
                    {{ $material->id }} - {{ $material->name }}
                    @if($material->categoria)
                        (Categoria: {{ $material->categoria->name }})
                    @endif
                </li>
            @endforeach
        </ul>
    @endif

    <p><a href="/">Voltar</a></p>
</body>
</html>
