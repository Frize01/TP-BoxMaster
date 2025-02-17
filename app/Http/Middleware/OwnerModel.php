<?php

namespace App\Http\Middleware;

use App\Models\ModelContract;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class OwnerModel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (!ModelContract::where('id', $request->modelContract->id)->where('owner_id', Auth::user()->id)->exists()) {
            return abort(403, 'Accès non autorisé');
        }
        return $next($request);
    }
}
