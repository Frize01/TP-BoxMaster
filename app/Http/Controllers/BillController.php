<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Contract;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Jobs\GenerationFacture;
use Illuminate\Support\Str;


class BillController extends Controller
{
    public function generateBills()
    {

        GenerationFacture::dispatch(auth()->id());

        return redirect()->back()->with('success', 'la générartion des factures a été lancée');
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
