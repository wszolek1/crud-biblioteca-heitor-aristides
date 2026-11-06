<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use App\Models\Autor;
use App\Models\Genero;
use App\Models\Editora;
use App\Services\Operations;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LivroController extends Controller
{
    public function index()
    {
        $livros = Livro::with(['autor', 'genero', 'editora'])->orderBy('titulo')->get();
        return view('livros.index', compact('livros'));
    }

        public function pdf()
    {
        $livros = Livro::with(['autor', 'genero', 'editora'])
            ->orderBy('titulo')
            ->get();

        $pdf = Pdf::loadView('livros.pdf', compact('livros'))
            ->setPaper('a4', 'landscape');

        return $pdf->stream('livros.pdf');
    }

    public function create()
    {
        $autores = Autor::orderBy('nome')->get();
        $generos = Genero::orderBy('nome')->get();
        $editoras = Editora::orderBy('nome')->get();
        return view('livros.create', compact('autores', 'generos', 'editoras'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'ano_publicacao' => 'required|integer|min:1000|max:' . date('Y'),
            'quantidade_estoque' => 'required|integer|min:0',
            'autor_id' => 'required|exists:autores,id',
            'genero_id' => 'required|exists:generos,id',
            'editora_id' => 'required|exists:editoras,id',
        ], [
            'titulo.required' => 'O título do livro é obrigatório.',
            'ano_publicacao.required' => 'O ano de publicação é obrigatório.',
            'ano_publicacao.integer' => 'Informe um ano válido.',
            'quantidade_estoque.required' => 'Informe a quantidade em estoque.',
            'autor_id.required' => 'Selecione um autor.',
            'genero_id.required' => 'Selecione um gênero.',
            'editora_id.required' => 'Selecione uma editora.',
            'autor_id.exists' => 'O autor selecionado não existe.',
            'genero_id.exists' => 'O gênero selecionado não existe.',
            'editora_id.exists' => 'A editora selecionada não existe.',
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
        $generos = Genero::orderBy('nome')->get();
        $editoras = Editora::orderBy('nome')->get();

        return view('livros.edit', compact('livro', 'autores', 'generos', 'editoras'));
    }

    public function update(Request $request, $idCriptografado)
    {
        $id = Operations::decryptId($idCriptografado);

        if (!$id) {
            return redirect()->route('livros.index')->with('erro', 'Link inválido.');
        }

        $request->validate([
            'titulo' => 'required|string|max:255',
            'ano_publicacao' => 'required|integer|min:1000|max:' . date('Y'),
            'quantidade_estoque' => 'required|integer|min:0',
            'autor_id' => 'required|exists:autores,id',
            'genero_id' => 'required|exists:generos,id',
            'editora_id' => 'required|exists:editoras,id',
        ], [
            'titulo.required' => 'O título do livro é obrigatório.',
            'ano_publicacao.required' => 'O ano de publicação é obrigatório.',
            'quantidade_estoque.required' => 'Informe a quantidade em estoque.',
            'autor_id.required' => 'Selecione um autor.',
            'genero_id.required' => 'Selecione um gênero.',
            'editora_id.required' => 'Selecione uma editora.',
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
        $livro->delete();

        return redirect()->route('livros.index')->with('sucesso', 'Livro excluído com sucesso!');
    }
}