<?php

namespace App\Http\Controllers;

use App\Models\Editora;
use App\Services\Operations;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EditoraController extends Controller
{
    public function index()
    {
        $editoras = Editora::orderBy('nome')->get();
        return view('editoras.index', compact('editoras'));
    }

    public function create()
    {
        return view('editoras.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'cnpj' => 'required|string|max:18|unique:editoras,cnpj',
            'cidade' => 'required|string|max:100',
            'telefone' => 'required|string|max:20',
        ], [
            'nome.required' => 'O nome da editora é obrigatório.',
            'cnpj.required' => 'O CNPJ é obrigatório.',
            'cnpj.unique' => 'Já existe uma editora com este CNPJ.',
            'cidade.required' => 'A cidade é obrigatória.',
            'telefone.required' => 'O telefone é obrigatório.',
        ]);

        Editora::create($request->all());

        return redirect()->route('editoras.index')->with('sucesso', 'Editora cadastrada com sucesso!');
    }

    public function edit($idCriptografado)
    {
        $id = Operations::decryptId($idCriptografado);

        if (!$id) {
            return redirect()->route('editoras.index')->with('erro', 'Link inválido.');
        }

        $editora = Editora::findOrFail($id);
        return view('editoras.edit', compact('editora'));
    }

    public function update(Request $request, $idCriptografado)
    {
        $id = Operations::decryptId($idCriptografado);

        if (!$id) {
            return redirect()->route('editoras.index')->with('erro', 'Link inválido.');
        }

        $request->validate([
            'nome' => 'required|string|max:255',
            'cnpj' => ['required', 'string', 'max:18', Rule::unique('editoras', 'cnpj')->ignore($id)],
            'cidade' => 'required|string|max:100',
            'telefone' => 'required|string|max:20',
        ], [
            'nome.required' => 'O nome da editora é obrigatório.',
            'cnpj.required' => 'O CNPJ é obrigatório.',
            'cnpj.unique' => 'Já existe uma editora com este CNPJ.',
            'cidade.required' => 'A cidade é obrigatória.',
            'telefone.required' => 'O telefone é obrigatório.',
        ]);

        $editora = Editora::findOrFail($id);
        $editora->update($request->all());

        return redirect()->route('editoras.index')->with('sucesso', 'Editora atualizada com sucesso!');
    }

    public function destroy($idCriptografado)
    {
        $id = Operations::decryptId($idCriptografado);

        if (!$id) {
            return redirect()->route('editoras.index')->with('erro', 'Link inválido.');
        }

        $editora = Editora::findOrFail($id);

        if ($editora->livros()->exists()) {
            return redirect()->route('editoras.index')->with('erro', 'Esta editora possui livros cadastrados e não pode ser excluída.');
        }

        $editora->delete();

        return redirect()->route('editoras.index')->with('sucesso', 'Editora excluída com sucesso!');
    }
}
