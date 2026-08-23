<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckIsNotLogged
{
    // Bloqueia quem JÁ está logado de acessar a tela de login novamente
    public function handle(Request $request, Closure $next): Response
    {
        if (session()->has('usuario_id')) {
            return redirect()->route('livros.index');
        }

        return $next($request);
    }
}