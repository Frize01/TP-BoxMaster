<?php

namespace App\Http\Middleware;

use App\Models\Bill;
use App\Models\Box;
use App\Models\Contract;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OwnerBill
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $boxs = Box::where('owner_id', auth()->id())->pluck('id')->toArray();
        $contract = Contract::whereIn('box_id', $boxs)->where('id', $request->contract->id);
        if(!$contract->exist()){
            return abort(403);
        }

        if(!Bill::whereIn('contract_id', $contract->pluck('id')->toArray())->where('id', $request->bill->id)->exists()){
            return abort(403);
        }

        return $next($request);
    }
}
