<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->isAdmin()){
            abort(404);
        }
//         abort_if(auth()->user()->isAdmin(), 404);

        return $next($request);
    }
}
