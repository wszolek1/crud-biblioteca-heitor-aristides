@extends('layouts.app')

@section('conteudo')
    <h2>Novo Autor</h2>

    <form action="{{ route('autores.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="nome" class="form-control @error('nome') is-invalid @enderror" value="{{ old('nome') }}">
            @error('nome') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Nacionalidade</label>
            <input type="text" name="nacionalidade" class="form-control @error('nacionalidade') is-invalid @enderror" value="{{ old('nacionalidade') }}">
            @error('nacionalidade') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Data de Nascimento</label>
            <input type="date" name="data_nascimento" class="form-control @error('data_nascimento') is-invalid @enderror" value="{{ old('data_nascimento') }}">
            @error('data_nascimento') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Biografia</label>
            <textarea name="biografia" class="form-control" rows="4">{{ old('biografia') }}</textarea>
        </div>

        <button class="btn btn-success" type="submit">Salvar</button>
        <a href="{{ route('autores.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection