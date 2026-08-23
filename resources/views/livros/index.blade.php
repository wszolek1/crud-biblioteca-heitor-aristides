@extends('layouts.app')

@section('conteudo')
    <h2>Livros</h2>
    <a href="{{ route('livros.create') }}" class="btn btn-success mb-3">+ Novo Livro</a>

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Título</th>
                <th>Gênero</th>
                <th>Ano</th>
                <th>Estoque</th>
                <th>Autor</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($livros as $livro)
                <tr>
                    <td>{{ $livro->titulo }}</td>
                    <td>{{ $livro->genero }}</td>
                    <td>{{ $livro->ano_publicacao }}</td>
                    <td>{{ $livro->quantidade_estoque }}</td>
                    <td>
                        @if($livro->autor)
                            {{ $livro->autor->nome }}
                        @else
                            <em>sem autor</em>
                        @endif
                    </td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="{{ route('livros.edit', \App\Services\Operations::encryptId($livro->id)) }}">Editar</a>
                        <form action="{{ route('livros.destroy', \App\Services\Operations::encryptId($livro->id)) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center">Nenhum livro cadastrado.</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection