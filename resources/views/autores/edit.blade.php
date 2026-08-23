@extends('layouts.app')

@section('conteudo')
    <h2>Editar Autor</h2>

    <form action="{{ route('autores.update', \App\Services\Operations::encryptId($autor->id)) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="nome" class="form-control @error('nome') is-invalid @enderror" value="{{ old('nome', $autor->nome) }}">
            @error('nome') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Nacionalidade</label>
            <input type="text" name="nacionalidade" class="form-control @error('nacionalidade') is-invalid @enderror" value="{{ old('nacionalidade', $autor->nacionalidade) }}">
            @error('nacionalidade') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Data de Nascimento</label>
            <input type="date" name="data_nascimento" class="form-control @error('data_nascimento') is-invalid @enderror" value="{{ old('data_nascimento', $autor->data_nascimento) }}">
            @error('data_nascimento') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Biografia</label>
            <textarea name="biografia" class="form-control" rows="4">{{ old('biografia', $autor->biografia) }}</textarea>
        </div>

        <button class="btn btn-primary" type="submit">Atualizar</button>
        <a href="{{ route('autores.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection