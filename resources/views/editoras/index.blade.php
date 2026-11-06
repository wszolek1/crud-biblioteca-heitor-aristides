@extends('layouts.app')

@section('conteudo')
    <h2>Editoras</h2>
    <a href="{{ route('editoras.create') }}" class="btn btn-success mb-3">+ Nova Editora</a>

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Nome</th>
                <th>CNPJ</th>
                <th>Cidade</th>
                <th>Telefone</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($editoras as $editora)
                <tr>
                    <td>{{ $editora->nome }}</td>
                    <td>{{ $editora->cnpj }}</td>
                    <td>{{ $editora->cidade }}</td>
                    <td>{{ $editora->telefone }}</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="{{ route('editoras.edit', \App\Services\Operations::encryptId($editora->id)) }}">Editar</a>
                        <form action="{{ route('editoras.destroy', \App\Services\Operations::encryptId($editora->id)) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center">Nenhuma editora cadastrada.</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection
