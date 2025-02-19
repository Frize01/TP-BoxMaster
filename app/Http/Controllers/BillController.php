<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Box;
use App\Models\Contract;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Jobs\GenerationFacture;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;


class BillController extends Controller
{
    public function generateBills()
    {
        $boxs = Box::where('owner_id', auth()->id())->pluck('id')->toArray();
        $currentPeriod = Carbon::now()->format('m-Y');

        $contracts = Contract::whereIn('box_id', $boxs)
            ->whereDoesntHave('bills', function ($query) use ($currentPeriod) {
                $query->where('period_number', $currentPeriod);
            })
            ->get();

        foreach ($contracts as $contract) {
            Bill::create([
                'contract_id' => $contract->id,
                'paiement_montant' => $contract->price,
                'payment_date' => null,
                'period_number' => $currentPeriod,
            ]);
        }

        // GenerationFacture::dispatch(auth()->id());

        return redirect()->back()->with('success', 'La générartion des factures a été lancée');
    }

    public function pay(Request $request, Bill $bill){
        $data = $request->validate([
            'payment_date' => 'required|date',
        ]);

        if(!$bill->payment_date){
            $bill->payment_date = $data['payment_date'];
            $bill->save();
            return redirect()->route('contract.show', $bill->contract_id);
        }

        return abort(403);
    }

    public function generatePdf(Bill $bill)
    {
        $data = [
            'bill' => $bill,
        ];
        $pdf = Pdf::loadView('pdf.bill', $data);
        return $pdf->download('bill-' . $bill->contract_id . '-' . $bill->period_number . '.pdf');
    }
}
