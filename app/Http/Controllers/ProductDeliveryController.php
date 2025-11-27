<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductDelivery;
use App\Models\Provider;
use Illuminate\Http\Request;

class ProductDeliveryController extends Controller
{
    public function index()
    {
        $deliveries = ProductDelivery::with(['product', 'provider'])->get();
        return view('product_deliveries.index', compact('deliveries'));
    }

    public function create()
    {
        return view('product_deliveries.create', [
            'products'  => Product::all(),
            'providers' => Provider::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'date'             => 'required|date',
            'delivered_amount' => 'required|integer|min:1',
            'product_id'       => 'required|exists:products,id',
            'provider_id'      => 'required|exists:providers,id',
        ]);

        ProductDelivery::create($request->only('date', 'delivered_amount', 'product_id', 'provider_id'));

        return redirect()->route('product_deliveries.index')->with('ok', 'Entrega creada');
    }

    public function show(ProductDelivery $productDelivery)
    {
        $productDelivery->load(['product', 'provider']);
        return view('product_deliveries.show', compact('productDelivery'));
    }

    public function edit(ProductDelivery $productDelivery)
    {
        return view('product_deliveries.edit', [
            'delivery'  => $productDelivery,
            'products'  => Product::all(),
            'providers' => Provider::all(),
        ]);
    }

    public function update(Request $request, ProductDelivery $productDelivery)
    {
        $request->validate([
            'date'             => 'required|date',
            'delivered_amount' => 'required|integer|min:1',
            'product_id'       => 'required|exists:products,id',
            'provider_id'      => 'required|exists:providers,id',
        ]);

        $productDelivery->update($request->only('date', 'delivered_amount', 'product_id', 'provider_id'));

        return redirect()->route('product_deliveries.index')->with('ok', 'Entrega actualizada');
    }

    public function destroy(ProductDelivery $productDelivery)
    {
        $productDelivery->delete();
        return redirect()->route('product_deliveries.index')->with('ok', 'Entrega eliminada');
    }
}
