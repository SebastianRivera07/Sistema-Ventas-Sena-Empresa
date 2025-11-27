<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    public function index()
    {
        $proveedores = Provider::all();
        return view('providers.index', compact('proveedores'));
    }

    public function create()
    {
        return view('providers.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        Provider::create($request->only('name'));

        return redirect()->route('providers.index')->with('ok', 'Proveedor creado');
    }

    public function show(Provider $provider)
    {
        return view('providers.show', compact('provider'));
    }

    public function edit(Provider $provider)
    {
        return view('providers.edit', compact('provider'));
    }

    public function update(Request $request, Provider $provider)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $provider->update($request->only('name'));

        return redirect()->route('providers.index')->with('ok', 'Proveedor actualizado');
    }

    public function destroy(Provider $provider)
    {
        $provider->delete();
        return redirect()->route('providers.index')->with('ok', 'Proveedor eliminado');
    }
}
