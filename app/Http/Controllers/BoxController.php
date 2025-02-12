<?php

namespace App\Http\Controllers;

use App\Models\Box;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BoxController extends Controller
{
    public function index()
    {
        $boxs = Box::where('owner_id', Auth::user()->id)->get();
        return view('boxs.index', ['boxs' => $boxs]);
    }

    public function show(Box $box)
    {
        $locations = Location::where('box_id', $box->id)->with('tenant')->get();
        return view('boxs.show', ['box' => $box, 'locations' => $locations]);
    }

    public function create()
    {
        return view('boxs.form', ['box' => new Box()]);
    }

    public function edit(Box $box)
    {
        return view('boxs.form', ['box' => $box]);
    }

    public function update(Box $box, Request $request)
    {
        $data = $this->validateBox($request);
        $this->saveData($box, $data);
        return redirect()->route('box.show', $box->id)->with('success', 'Box modifiée avec succès');
    }

    public function store(Request $request)
    {
        $data = $this->validateBox($request);

        $this->saveData(new Box(), $data);
        return redirect()->route('box.index')->with('success', 'Box créée avec succès');
    }

    public function destroy(Box $box)
    {
        $box->delete();
        return redirect()->route('box.index')->with('success', 'Box supprimée avec succès');
    }

    private function validateBox(Request $request): array
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'surface' => 'required|integer|min:0',
            'volume' => 'nullable|integer|min:0',
            'default_price' => 'required|numeric|min:1',
        ]);

        return $data;
    }

    private function saveData(Box $box, array $data): void
    {
        $box->name = $data['name'];
        $box->description = $data['description'];
        $box->surface = $data['surface'];
        $box->volume = $data['volume'];
        $box->default_price = $data['default_price'];
        $box->owner()->associate(Auth::user());
        $box->save();
    }
}
