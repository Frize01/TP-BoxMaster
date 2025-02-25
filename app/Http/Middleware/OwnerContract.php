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
        $boxs = Box::where('owner_id', auth()->id())->pluck('id')->toArray();
        if(!Contract::whereIn('box_id', $boxs)->where('id', $request->contract->id)->exists()){
            return abort(403);
        }

        return $next($request);
    }
}
