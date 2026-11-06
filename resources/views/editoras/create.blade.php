@extends('layouts.app')

@section('conteudo')
    <h2>Nova Editora</h2>

    <form action="{{ route('editoras.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="nome" class="form-control @error('nome') is-invalid @enderror" value="{{ old('nome') }}">
            @error('nome') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">CNPJ</label>
            <input type="text" name="cnpj" class="form-control @error('cnpj') is-invalid @enderror" value="{{ old('cnpj') }}">
            @error('cnpj') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Cidade</label>
            <input type="text" name="cidade" class="form-control @error('cidade') is-invalid @enderror" value="{{ old('cidade') }}">
            @error('cidade') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Telefone</label>
            <input type="text" name="telefone" class="form-control @error('telefone') is-invalid @enderror" value="{{ old('telefone') }}">
            @error('telefone') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <button class="btn btn-success" type="submit">Salvar</button>
        <a href="{{ route('editoras.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection
