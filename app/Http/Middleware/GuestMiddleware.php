<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Verifica se o token de login do SUAP já foi gerado.
 * Se foi gerado, significa que o usuário já está logado e, logo, não deve logar de novo.
 * Então é redirecionado painel de controle.
 */
class GuestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // TODO: Reativar. Desativado temporariamente porque estava entrando em loop de redirecionamento.
        // if (isset($_COOKIE['suapToken'])) {
        //     return back();
        // }
        return $next($request);
    }
}
