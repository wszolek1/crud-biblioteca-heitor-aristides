<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use App\Services\Operations;
use Illuminate\Http\Request;

class AutorController extends Controller
{
    public function index()
    {
        $autores = Autor::orderBy('nome')->get();
        return view('autores.index', compact('autores'));
    }

    public function create()
    {
        return view('autores.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'nacionalidade' => 'required|string|max:100',
            'data_nascimento' => 'required|date',
            'biografia' => 'nullable|string',
        ], [
            'nome.required' => 'O nome do autor é obrigatório.',
            'nacionalidade.required' => 'A nacionalidade é obrigatória.',
            'data_nascimento.required' => 'A data de nascimento é obrigatória.',
            'data_nascimento.date' => 'Informe uma data válida.',
        ]);

        Autor::create($request->all());

        return redirect()->route('autores.index')->with('sucesso', 'Autor cadastrado com sucesso!');
    }

    public function edit($idCriptografado)
    {
        $id = Operations::decryptId($idCriptografado);

        if (!$id) {
            return redirect()->route('autores.index')->with('erro', 'Link inválido.');
        }

        $autor = Autor::findOrFail($id);
        return view('autores.edit', compact('autor'));
    }

    public function update(Request $request, $idCriptografado)
    {
        $id = Operations::decryptId($idCriptografado);

        if (!$id) {
            return redirect()->route('autores.index')->with('erro', 'Link inválido.');
        }

        $request->validate([
            'nome' => 'required|string|max:255',
            'nacionalidade' => 'required|string|max:100',
            'data_nascimento' => 'required|date',
            'biografia' => 'nullable|string',
        ], [
            'nome.required' => 'O nome do autor é obrigatório.',
            'nacionalidade.required' => 'A nacionalidade é obrigatória.',
            'data_nascimento.required' => 'A data de nascimento é obrigatória.',
        ]);

        $autor = Autor::findOrFail($id);
        $autor->update($request->all());

        return redirect()->route('autores.index')->with('sucesso', 'Autor atualizado com sucesso!');
    }

    public function destroy($idCriptografado)
    {
        $id = Operations::decryptId($idCriptografado);

        if (!$id) {
            return redirect()->route('autores.index')->with('erro', 'Link inválido.');
        }

        $autor = Autor::findOrFail($id);
        $autor->delete(); // autor não tem soft delete, é exclusão real

        return redirect()->route('autores.index')->with('sucesso', 'Autor excluído com sucesso!');
    }
}