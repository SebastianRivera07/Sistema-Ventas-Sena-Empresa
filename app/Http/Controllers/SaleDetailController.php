<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetail;
use Illuminate\Http\Request;

class SaleDetailController extends Controller
{
    public function index()
    {
        $details = SaleDetail::with(['sale', 'product'])->get();
        return view('sale_details.index', compact('details'));
    }

    public function create()
    {
        return view('sale_details.create', [
            'sales'    => Sale::all(),
            'products' => Product::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'quantity'   => 'required|integer|min:1',
            'product_id' => 'required|exists:products,id',
            'sale_id'    => 'required|exists:sales,id',
        ]);

        SaleDetail::create($request->only('quantity', 'product_id', 'sale_id'));

        return redirect()->route('sale_details.index')->with('ok', 'Detalle de venta creado');
    }

    public function show(SaleDetail $saleDetail)
    {
        $saleDetail->load(['sale', 'product']);
        return view('sale_details.show', compact('saleDetail'));
    }

    public function edit(SaleDetail $saleDetail)
    {
        return view('sale_details.edit', [
            'detail'   => $saleDetail,
            'sales'    => Sale::all(),
            'products' => Product::all(),
        ]);
    }

    public function update(Request $request, SaleDetail $saleDetail)
    {
        $request->validate([
            'quantity'   => 'required|integer|min:1',
            'product_id' => 'required|exists:products,id',
            'sale_id'    => 'required|exists:sales,id',
        ]);

        $saleDetail->update($request->only('quantity', 'product_id', 'sale_id'));

        return redirect()->route('sale_details.index')->with('ok', 'Detalle de venta actualizado');
    }

    public function destroy(SaleDetail $saleDetail)
    {
        $saleDetail->delete();
        return redirect()->route('sale_details.index')->with('ok', 'Detalle de venta eliminado');
    }
}
