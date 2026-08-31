<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckIsLogged
{
    // Bloqueia o acesso de quem NÃO está logado
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->has('usuario_id')) {
            return redirect()->route('login')->with('erro', 'Você precisa estar logado para acessar essa página.');
        }

        return $next($request);
    }
}