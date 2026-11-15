@extends('layouts.app')

@section('conteudo')
    <h2>Editar usuário</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $erro)
                <div>{{ $erro }}</div>
            @endforeach
        </div>
    @endif

    <form action="{{ route('usuarios.update', \App\Services\Operations::encryptId($usuario->id)) }}" method="POST" style="max-width: 400px;">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $usuario->name) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">E-mail</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $usuario->email) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Nova senha <small class="text-muted">(deixe em branco para manter a atual)</small></label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Confirmar nova senha</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>

        <button type="submit" class="btn btn-dark">Salvar</button>
        <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection