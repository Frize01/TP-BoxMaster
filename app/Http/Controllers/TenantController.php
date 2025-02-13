<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tenant = Tenant::where('owner_id', auth()->id())->get();
        return  view('tenants.index', ['tenants' => $tenant]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tenants.form', ['tenant' => new Tenant()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateData($request);

        $tenant = new Tenant();
        $this->saveData($tenant, $data);
        return redirect()->route('tenant.index')->with('success', 'Tenant created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tenant $tenant): View
    {
        return view('tenants.show', ['tenant' => $tenant]);
    }

    public function edit(Tenant $tenant): View
    {
        return view('tenants.form', ['tenant' => $tenant]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tenant $tenant): RedirectResponse
    {
        $data = $this->validateData($request);
        $this->saveData($tenant, $data);
        return redirect()->route('tenant.index')->with('success', 'Tenant updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tenant $tenant): RedirectResponse
    {
        $tenant->delete();
        return redirect()->route('tenant.index')->with('success', 'Tenant deleted successfully');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'name' => 'required|string',
            'tel' => 'required|string|max:13|min:10',
            'mail' => 'required|email|max:255',
            'address' => 'required|string|max:255',
            'rib' => 'required|string|max:34|min:34',
        ]);
    }

    private function saveData(Tenant $tenant, $data): void
    {
        $tenant->name = $data['name'];
        $tenant->tel = $data['tel'];
        $tenant->mail = $data['mail'];
        $tenant->address = $data['address'];
        $tenant->rib = $data['rib'];
        $tenant->owner()->associate(Auth::user());
        $tenant->save();
    }
}
