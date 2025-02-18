<?php

namespace App\Http\Middleware;

use App\Models\Box;
use App\Models\Contract;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OwnerContract
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }
}
