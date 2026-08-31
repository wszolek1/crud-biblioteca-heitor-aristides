<nav class="navbar navbar-dark bg-dark px-3">
    @if(session('usuario_id'))
        <a class="navbar-brand" href="{{ route('livros.index') }}">Biblioteca</a>
        <div>
            <a class="btn btn-outline-light btn-sm" href="{{ route('livros.index') }}">Livros</a>
            <a class="btn btn-outline-light btn-sm" href="{{ route('autores.index') }}">Autores</a>
            <span class="text-white ms-3">Olá, {{ session('usuario_nome') }}</span>
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-outline-danger btn-sm">Sair</button>
            </form>
        </div>
    @endif
</nav>