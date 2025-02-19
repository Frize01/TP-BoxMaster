<?php
namespace App\Exports;

use App\Models\Bill;
use App\Models\Box;
use App\Models\Contract;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PaymentsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        $boxs = Box::where('owner_id', auth()->id())->pluck('id')->toArray();
        $contract = Contract::whereIn('box_id', $boxs)->pluck('id')->toArray();
        return Bill::whereNotNull('payment_date')->whereIn('contract_id', $contract)->get(); // Filtre uniquement les paiements reçus
    }

    public function headings(): array
    {
        return [
            'ID',
            'Contrat',
            'Montant',
            'Date de paiement',
            'Année',
        ];
    }

    public function map($bill): array
    {
        return [
            $bill->id,
            $bill->contract_id,
            $bill->paiement_montant,
            $bill->payment_date->format('d/m/Y'),
            $bill->payment_date->year,
        ];
    }
}