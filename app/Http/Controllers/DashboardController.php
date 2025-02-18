<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Box;
use App\Models\Contract;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function view() {
        $boxs = Box::where('owner_id', auth()->id())->pluck('id')->toArray();
        $contract = Contract::whereIn('box_id', $boxs)->pluck('id')->toArray();

        $bills = Bill::whereIn('contract_id', $contract)->get();
        return view('dashboard', ['bills' => $bills]);
    }
}
