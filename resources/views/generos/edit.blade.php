@extends('layouts.app')

@section('conteudo')
    <h2>Editar Gênero</h2>

    <form action="{{ route('generos.update', \App\Services\Operations::encryptId($genero->id)) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="nome" class="form-control @error('nome') is-invalid @enderror" value="{{ old('nome', $genero->nome) }}">
            @error('nome') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Descrição</label>
            <textarea name="descricao" class="form-control" rows="4">{{ old('descricao', $genero->descricao) }}</textarea>
        </div>

        <button class="btn btn-primary" type="submit">Atualizar</button>
        <a href="{{ route('generos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection
