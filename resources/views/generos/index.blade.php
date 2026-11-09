@extends('layouts.app')

@section('conteudo')
    <h2>Gêneros</h2>
    <a href="{{ route('generos.create') }}" class="btn btn-success mb-3">+ Novo Gênero</a>

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($generos as $genero)
                <tr>
                    <td>{{ $genero->nome }}</td>
                    <td>{{ $genero->descricao }}</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="{{ route('generos.edit', \App\Services\Operations::encryptId($genero->id)) }}">Editar</a>
                        <form action="{{ route('generos.destroy', \App\Services\Operations::encryptId($genero->id)) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="3" class="text-center">Nenhum gênero cadastrado.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $generos->links('vendor.pagination.biblioteca') }}
@endsection
