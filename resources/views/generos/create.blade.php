@extends('layouts.app')

@section('conteudo')
    <h2>Novo Gênero</h2>

    <form action="{{ route('generos.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="nome" class="form-control @error('nome') is-invalid @enderror" value="{{ old('nome') }}">
            @error('nome') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Descrição</label>
            <textarea name="descricao" class="form-control" rows="4">{{ old('descricao') }}</textarea>
        </div>

        <button class="btn btn-success" type="submit">Salvar</button>
        <a href="{{ route('generos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection
