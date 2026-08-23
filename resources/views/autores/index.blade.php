@extends('layouts.app')

@section('conteudo')
    <h2>Autores</h2>
    <a href="{{ route('autores.create') }}" class="btn btn-success mb-3">+ Novo Autor</a>

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Nome</th>
                <th>Nacionalidade</th>
                <th>Nascimento</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($autores as $autor)
                <tr>
                    <td>{{ $autor->nome }}</td>
                    <td>{{ $autor->nacionalidade }}</td>
                    <td>{{ \Carbon\Carbon::parse($autor->data_nascimento)->format('d/m/Y') }}</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="{{ route('autores.edit', \App\Services\Operations::encryptId($autor->id)) }}">Editar</a>
                        <form action="{{ route('autores.destroy', \App\Services\Operations::encryptId($autor->id)) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center">Nenhum autor cadastrado.</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection