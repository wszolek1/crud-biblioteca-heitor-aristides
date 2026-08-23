<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use App\Models\Autor;
use App\Services\Operations;
use Illuminate\Http\Request;

class LivroController extends Controller
{
    public function index()
    {
        // carrega os livros já trazendo o autor relacionado (evita consultas repetidas)
        $livros = Livro::with('autor')->orderBy('titulo')->get();
        return view('livros.index', compact('livros'));
    }

    public function create()
    {
        $autores = Autor::orderBy('nome')->get();
        return view('livros.create', compact('autores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'genero' => 'required|string|max:100',
            'ano_publicacao' => 'required|integer|min:1000|max:' . date('Y'),
            'quantidade_estoque' => 'required|integer|min:0',
            'autor_id' => 'required|exists:autores,id',
        ], [
            'titulo.required' => 'O título do livro é obrigatório.',
            'genero.required' => 'O gênero é obrigatório.',
            'ano_publicacao.required' => 'O ano de publicação é obrigatório.',
            'ano_publicacao.integer' => 'Informe um ano válido.',
            'quantidade_estoque.required' => 'Informe a quantidade em estoque.',
            'autor_id.required' => 'Selecione um autor.',
            'autor_id.exists' => 'O autor selecionado não existe.',
        ]);

        Livro::create($request->all());

        return redirect()->route('livros.index')->with('sucesso', 'Livro cadastrado com sucesso!');
    }

    public function edit($idCriptografado)
    {
        $id = Operations::decryptId($idCriptografado);

        if (!$id) {
            return redirect()->route('livros.index')->with('erro', 'Link inválido.');
        }

        $livro = Livro::findOrFail($id);
        $autores = Autor::orderBy('nome')->get();

        return view('livros.edit', compact('livro', 'autores'));
    }

    public function update(Request $request, $idCriptografado)
    {
        $id = Operations::decryptId($idCriptografado);

        if (!$id) {
            return redirect()->route('livros.index')->with('erro', 'Link inválido.');
        }

        $request->validate([
            'titulo' => 'required|string|max:255',
            'genero' => 'required|string|max:100',
            'ano_publicacao' => 'required|integer|min:1000|max:' . date('Y'),
            'quantidade_estoque' => 'required|integer|min:0',
            'autor_id' => 'required|exists:autores,id',
        ], [
            'titulo.required' => 'O título do livro é obrigatório.',
            'genero.required' => 'O gênero é obrigatório.',
            'ano_publicacao.required' => 'O ano de publicação é obrigatório.',
            'quantidade_estoque.required' => 'Informe a quantidade em estoque.',
            'autor_id.required' => 'Selecione um autor.',
        ]);

        $livro = Livro::findOrFail($id);
        $livro->update($request->all());

        return redirect()->route('livros.index')->with('sucesso', 'Livro atualizado com sucesso!');
    }

    public function destroy($idCriptografado)
    {
        $id = Operations::decryptId($idCriptografado);

        if (!$id) {
            return redirect()->route('livros.index')->with('erro', 'Link inválido.');
        }

        $livro = Livro::findOrFail($id);
        $livro->delete(); // Soft Delete: só marca deleted_at, não apaga do banco

        return redirect()->route('livros.index')->with('sucesso', 'Livro excluído com sucesso!');
    }
}