<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Livros</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 11px; }
        h2 { text-align: center; margin-bottom: 4px; }
        .data { text-align: center; color: #666; margin-bottom: 14px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #999; padding: 5px; text-align: left; }
        th { background-color: #222; color: #fff; }
        tr:nth-child(even) td { background-color: #f2f2f2; }
        .rodape { margin-top: 10px; text-align: right; }
    </style>
</head>
<body>
    <h2>Relatório de Livros</h2>
    <div class="data">Gerado em {{ now()->format('d/m/Y H:i') }}</div>

    <table>
        <thead>
            <tr>
                <th>Título</th>
                <th>Autor</th>
                <th>Gênero</th>
                <th>Editora</th>
                <th>Ano</th>
                <th>Estoque</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($livros as $livro)
                <tr>
                    <td>{{ $livro->titulo }}</td>
                    <td>{{ $livro->autor->nome ?? '' }}</td>
                    <td>{{ $livro->genero->nome ?? '' }}</td>
                    <td>{{ $livro->editora->nome ?? '' }}</td>
                    <td>{{ $livro->ano_publicacao }}</td>
                    <td>{{ $livro->quantidade_estoque }}</td>
                </tr>
            @empty
                <tr><td colspan="6" style="text-align:center;">Nenhum livro cadastrado.</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="rodape">Total de livros: {{ $livros->count() }}</div>
</body>
</html>