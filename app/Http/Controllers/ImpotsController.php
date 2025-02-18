<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Box;
use App\Models\Contract;
use Illuminate\Http\Request;

class ImpotsController extends Controller
{
    public function index() {
        $boxs = Box::where('owner_id', auth()->id())->pluck('id')->toArray();
        $contract = Contract::whereIn('box_id', $boxs)->pluck('id')->toArray();

        $bills = Bill::whereIn('contract_id', $contract)->get();

        $billByYear = $bills->whereNotNull('payment_date')
        ->groupBy(fn($item) => $item->payment_date->year)
        ->map(fn($facturesAnnee) => $facturesAnnee->sum('paiement_montant'));

        return view('impots', ['billByYear' => $billByYear]);
    }
}
