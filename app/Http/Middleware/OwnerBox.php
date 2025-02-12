<?php

namespace App\Http\Middleware;

use App\Models\Box;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OwnerBox
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {

        if (!Box::where('id', $request->box->id)->where('owner_id', Auth::user()->id)->exists()) {
            return abort(403, 'Accès non autorisé');
        }
        return $next($request);
    }
}
