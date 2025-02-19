<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Box;
use App\Models\Contract;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PaymentsExport;

class DashboardController extends Controller
{
    public function view()
    {
        $boxs = Box::where('owner_id', auth()->id())->pluck('id')->toArray();
        $contract = Contract::whereIn('box_id', $boxs)->pluck('id')->toArray();

        $bills = Bill::whereIn('contract_id', $contract)->get();

        $currentYear = now()->year;

        $billByYear = Bill::whereYear('payment_date', $currentYear)
            ->whereNotNull('payment_date')
            ->sum('paiement_montant');
        return view('dashboard', ['bills' => $bills, 'billByYear' => $billByYear, 'currentYear' => $currentYear]);
    }

    public function exportPayments()
    {
        return Excel::download(new PaymentsExport, 'paiements.xlsx');
    }
}
