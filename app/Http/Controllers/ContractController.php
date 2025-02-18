<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Box;
use App\Models\Contract;
use App\Models\ModelContract;
use App\Models\Tenant;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $boxs = Box::where('owner_id', auth()->id())->pluck('id')->toArray();
        $contracts = Contract::whereIn('box_id', $boxs)->with('tenant')->get();
        return view('contracts.index', ['contracts' => $contracts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Box $box = null)
    {
        return view('contracts.form', [
            'tenants' => Tenant::where('owner_id', auth()->id())->get(),
            'boxes' => Box::where('owner_id', auth()->id())->get(),
            'modelContracts' => ModelContract::where('owner_id', auth()->id())->get(),
            'contract' => new Contract(
                [
                    'box_id' => $box->id ?? null,
                    'price' => $box->default_price ?? null,
                    'resiliation_delay' => '1 mois',
                    'deposit' => $box->default_deposit ?? null
                ]
            ),
            'box' => $box
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $box = null)
    {
        $data = $this->validateRequest($request);
        $contract = new Contract();
        $this->saveData($contract, $data);
        return redirect()->route('box.show', $data['box_id'])->with('success', 'Contrat créé avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contract $contract)
    {
        $bills = Bill::where('contract_id', $contract->id)->get();
        return view('contracts.show', ['contract' => $contract, 'bills' => $bills]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contract $contract)
    {

        return view('contracts.form', [
            'contract' => $contract,
            'tenants' => Tenant::where('owner_id', auth()->id())->get(),
            'boxes' => Box::where('owner_id', auth()->id())->get(),
            'modelContracts' => ModelContract::where('owner_id', auth()->id())->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contract $contract)
    {
        $data = $this->validateRequest($request);
        $this->saveData($contract, $data);
        return redirect()->route('contract.index')->with('success', 'Contrat modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contract $contract)
    {
        $contract->delete();
        return redirect()->route('contract.index')->with('success', 'Contrat supprimé avec succès');
    }

    private function validateRequest($request): array
    {
        $data = $request->validate([
            'tenant_id' => 'required|integer|exists:tenants,id',
            'box_id' => 'required|integer|exists:boxs,id',
            'price' => 'required|numeric',
            'date_start' => 'required|date',
            'date_end' => 'required|date',
            'resiliation_delay' => 'required|string',
            'localisation' => 'required|string',
            'model_contract_id' => 'required|integer|exists:contract_models,id',
            'deposit' => 'required|integer',
        ]);

        $this->isAutorized($data);

        return $data;

    }

    private function isAutorized($contract)
    {
        if (Tenant::where('owner_id', auth()->id())->where('id', $contract['tenant_id'])->doesntExist()) {
            abort(403, 'Accès non autorisé');
        }

        if (Box::where('owner_id', auth()->id())->where('id', $contract['box_id'])->doesntExist()) {
            abort(403, 'Accès non autorisé');
        }

    }

    private function saveData(Contract $contract, $data): void
    {
        $contract->tenant()->associate($data['tenant_id']);
        $contract->box()->associate($data['box_id']);
        $contract->price = $data['price'];
        $contract->resiliation_delay = $data['resiliation_delay'];
        $contract->localisation = $data['localisation'];
        $contract->model()->associate($data['model_contract_id']);
        $contract->date_start = $data['date_start'];
        $contract->date_end = $data['date_end'];
        $contract->deposit = $data['deposit'];
        $contract->save();
    }

    public function generatePdf(Contract $contract)
    {
        $content = $contract->model->generateContent($contract);
        $data = [
            'content' => $content,
        ];
        $pdf = Pdf::loadView('pdf.contract', $data);
        return $pdf->download('contract-' . $contract->id . '.pdf');
    }
}
