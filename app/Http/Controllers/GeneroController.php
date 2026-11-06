<?php

namespace App\Http\Controllers;

use App\Models\Genero;
use App\Services\Operations;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GeneroController extends Controller
{
    public function index()
    {
        $generos = Genero::orderBy('nome')->get();
        return view('generos.index', compact('generos'));
    }

    public function create()
    {
        return view('generos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255|unique:generos,nome',
            'descricao' => 'nullable|string',
        ], [
            'nome.required' => 'O nome do gênero é obrigatório.',
            'nome.unique' => 'Já existe um gênero com este nome.',
        ]);

        Genero::create($request->all());

        return redirect()->route('generos.index')->with('sucesso', 'Gênero cadastrado com sucesso!');
    }

    public function edit($idCriptografado)
    {
        $id = Operations::decryptId($idCriptografado);

        if (!$id) {
            return redirect()->route('generos.index')->with('erro', 'Link inválido.');
        }

        $genero = Genero::findOrFail($id);
        return view('generos.edit', compact('genero'));
    }

    public function update(Request $request, $idCriptografado)
    {
        $id = Operations::decryptId($idCriptografado);

        if (!$id) {
            return redirect()->route('generos.index')->with('erro', 'Link inválido.');
        }

        $request->validate([
            'nome' => ['required', 'string', 'max:255', Rule::unique('generos', 'nome')->ignore($id)],
            'descricao' => 'nullable|string',
        ], [
            'nome.required' => 'O nome do gênero é obrigatório.',
            'nome.unique' => 'Já existe um gênero com este nome.',
        ]);

        $genero = Genero::findOrFail($id);
        $genero->update($request->all());

        return redirect()->route('generos.index')->with('sucesso', 'Gênero atualizado com sucesso!');
    }

    public function destroy($idCriptografado)
    {
        $id = Operations::decryptId($idCriptografado);

        if (!$id) {
            return redirect()->route('generos.index')->with('erro', 'Link inválido.');
        }

        $genero = Genero::findOrFail($id);

        if ($genero->livros()->exists()) {
            return redirect()->route('generos.index')->with('erro', 'Este gênero possui livros cadastrados e não pode ser excluído.');
        }

        $genero->delete();

        return redirect()->route('generos.index')->with('sucesso', 'Gênero excluído com sucesso!');
    }
}
