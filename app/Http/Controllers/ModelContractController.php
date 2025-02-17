<?php

namespace App\Http\Controllers;

use App\Models\ModelContract;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class ModelContractController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $modelContracts = ModelContract::where('owner_id', auth()->id())->get();
        return view('models.index', ['modelContracts' => $modelContracts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('models.form', ['modelContract' => new ModelContract()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validateRequest($request);
        $modelContract = new ModelContract();
        $this->saveData($modelContract, $request->all());
        return redirect()->route('modelContract.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(ModelContract $modelContract)
    {
        return view('models.show', ['modelContract' => $modelContract]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ModelContract $modelContract)
    {
        return view('models.form', ['modelContract' => $modelContract]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ModelContract $modelContract)
    {
        $data = $this->validateRequest($request);
        $this->saveData($modelContract, $data);
        return redirect()->route('modelContract.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ModelContract $modelContract): RedirectResponse
    {
        $modelContract->delete();
        return redirect()->route('modelContract.index');
    }

    private function saveData(ModelContract $modelContract, $data): void
    {
        $modelContract->name = $data['name'];
        $modelContract->content = $data['content'];
        $modelContract->owner()->associate(auth()->user());
        $modelContract->save();
    }

    private function validateRequest(Request $request): array
    {
        return $request->validate([
            'name' => 'required|string|max:64',
            'content' => 'required',
        ]);
    }
}
