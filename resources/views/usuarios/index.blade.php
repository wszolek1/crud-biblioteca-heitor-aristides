@extends('layouts.app')

@section('conteudo')
    <h2>Usuários</h2>
    <a href="{{ route('register') }}" class="btn btn-success mb-3">+ Novo Usuário</a>

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Cadastrado em</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($usuarios as $usuario)
                <tr>
                    <td>
                        {{ $usuario->name }}
                        @if($usuario->id == session('usuario_id'))
                            <span class="badge bg-secondary">você</span>
                        @endif
                    </td>
                    <td>{{ $usuario->email }}</td>
                    <td>{{ $usuario->created_at ? $usuario->created_at->format('d/m/Y H:i') : '' }}</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="{{ route('usuarios.edit', \App\Services\Operations::encryptId($usuario->id)) }}">Editar</a>
                        @if($usuario->id != session('usuario_id'))
                            <form action="{{ route('usuarios.destroy', \App\Services\Operations::encryptId($usuario->id)) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este usuário?')">Excluir</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center">Nenhum usuário cadastrado.</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection