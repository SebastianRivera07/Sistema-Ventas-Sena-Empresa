<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        $ventas = Sale::with(['user', 'client'])->get();
        return view('sales.index', compact('ventas'));
    }

    public function create()
    {
        return view('sales.create', [
            'usuarios' => User::all(),
            'clientes' => Client::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'total_value' => 'required|numeric|min:0',
            'date'        => 'required|date',
            'user_id'     => 'required|exists:users,id',
            'client_id'   => 'required|exists:clients,id',
        ]);

        Sale::create($request->all());

        return redirect()->route('sales.index')->with('ok', 'Venta creada');
    }

    public function show(Sale $sale)
    {
        $sale->load(['user', 'client']);
        return view('sales.show', compact('sale'));
    }

    public function edit(Sale $sale)
    {
        return view('sales.edit', [
            'sale'     => $sale,
            'usuarios' => User::all(),
            'clientes' => Client::all(),
        ]);
    }

    public function update(Request $request, Sale $sale)
    {
        $request->validate([
            'total_value' => 'required|numeric|min:0',
            'date'        => 'required|date',
            'user_id'     => 'required|exists:users,id',
            'client_id'   => 'required|exists:clients,id',
        ]);

        $sale->update($request->all());

        return redirect()->route('sales.index')->with('ok', 'Venta actualizada');
    }

    public function destroy(Sale $sale)
    {
        $sale->delete();
        return redirect()->route('sales.index')->with('ok', 'Venta eliminada');
    }
}
