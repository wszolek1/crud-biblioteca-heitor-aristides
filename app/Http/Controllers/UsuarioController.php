<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Operations;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = User::orderBy('name')->get();

        return view('usuarios.index', compact('usuarios'));
    }

    public function edit($idCriptografado)
    {
        $id = Operations::decryptId($idCriptografado);

        if (!$id) {
            return redirect()->route('usuarios.index')->with('erro', 'Link inválido.');
        }

        $usuario = User::findOrFail($id);

        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, $idCriptografado)
    {
        $id = Operations::decryptId($idCriptografado);

        if (!$id) {
            return redirect()->route('usuarios.index')->with('erro', 'Link inválido.');
        }

        $usuario = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($usuario->id)],
            'password' => 'nullable|min:6|confirmed',
        ], [
            'name.required' => 'Informe o nome.',
            'email.required' => 'Informe o e-mail.',
            'email.email' => 'Informe um e-mail válido.',
            'email.unique' => 'Este e-mail já está cadastrado.',
            'password.min' => 'A senha deve ter no mínimo 6 caracteres.',
            'password.confirmed' => 'A confirmação da senha não confere.',
        ]);

        $usuario->name = $request->name;
        $usuario->email = $request->email;

        // Só troca a senha se algo foi digitado (o model já faz o hash)
        if ($request->filled('password')) {
            $usuario->password = $request->password;
        }

        $usuario->save();

        // Se editou a si mesmo, atualiza o nome mostrado na barra superior
        if ($usuario->id == session('usuario_id')) {
            session(['usuario_nome' => $usuario->name]);
        }

        return redirect()->route('usuarios.index')->with('sucesso', 'Usuário atualizado com sucesso!');
    }

    public function destroy($idCriptografado)
    {
        $id = Operations::decryptId($idCriptografado);

        if (!$id) {
            return redirect()->route('usuarios.index')->with('erro', 'Link inválido.');
        }

        if ($id == session('usuario_id')) {
            return redirect()->route('usuarios.index')->with('erro', 'Você não pode excluir o seu próprio usuário.');
        }

        if (User::count() <= 1) {
            return redirect()->route('usuarios.index')->with('erro', 'Não é possível excluir o último usuário.');
        }

        User::findOrFail($id)->delete();

        return redirect()->route('usuarios.index')->with('sucesso', 'Usuário excluído com sucesso!');
    }
}