@extends('layouts.app')

@section('conteudo')
    <h2>Novo Livro</h2>

    <form action="{{ route('livros.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Título</label>
            <input type="text" name="titulo" class="form-control @error('titulo') is-invalid @enderror" value="{{ old('titulo') }}">
            @error('titulo') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Gênero</label>
            <input type="text" name="genero" class="form-control @error('genero') is-invalid @enderror" value="{{ old('genero') }}">
            @error('genero') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Ano de Publicação</label>
            <input type="number" name="ano_publicacao" class="form-control @error('ano_publicacao') is-invalid @enderror" value="{{ old('ano_publicacao') }}">
            @error('ano_publicacao') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Quantidade em Estoque</label>
            <input type="number" name="quantidade_estoque" class="form-control @error('quantidade_estoque') is-invalid @enderror" value="{{ old('quantidade_estoque') }}">
            @error('quantidade_estoque') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Autor</label>
            <select name="autor_id" class="form-select @error('autor_id') is-invalid @enderror">
                <option value="">Selecione</option>
                @foreach ($autores as $autor)
                    <option value="{{ $autor->id }}" {{ old('autor_id') == $autor->id ? 'selected' : '' }}>
                        {{ $autor->nome }}
                    </option>
                @endforeach
            </select>
            @error('autor_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <button class="btn btn-success" type="submit">Salvar</button>
        <a href="{{ route('livros.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection