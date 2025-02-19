<?php

namespace App\Exports;


use App\Models\Tenant;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;

class TenantExport implements FromCollection
{
    protected $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    public function collection()
    {
        return Tenant::where('owner_id', $this->userId)->get();
    }

    public function headings(): array
    {
        return ["Nom", "Email", "Adresse", "Date de création"];
    }

    public function map($row): array
    {
        return [
            $row->name,
            $row->mail,
            $row->address,
            $row->created_at,
        ];
    }

    public function csv(): array
    {
        return [
            'delimiter' => ';'
        ];
    }
}
