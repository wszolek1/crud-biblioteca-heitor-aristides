<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Informe o e-mail.',
            'email.email' => 'Informe um e-mail válido.',
            'password.required' => 'Informe a senha.',
        ]);

        $usuario = User::where('email', $request->email)->first();

        if (!$usuario || !Hash::check($request->password, $usuario->password)) {
            return back()->withErrors(['login' => 'E-mail ou senha inválidos.'])->withInput();
        }

        session(['usuario_id' => $usuario->id, 'usuario_nome' => $usuario->name]);

        return redirect()->route('livros.index');
    }

    public function logout()
    {
        session()->forget(['usuario_id', 'usuario_nome']);
        return redirect()->route('login');
    }
}