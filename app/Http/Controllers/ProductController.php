<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Provider;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $productos = Product::with(['category', 'provider'])->get();
        return view('products.index', compact('productos'));
    }

    public function create()
    {
        return view('products.create', [
            'categorias' => Category::all(),
            'proveedores' => Provider::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'stock'       => 'required|integer|min:0',
            'price'       => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'provider_id' => 'required|exists:providers,id',
        ]);

        Product::create($request->all());

        return redirect()->route('products.index')->with('ok', 'Producto creado');
    }

    public function show(Product $product)
    {
        $product->load(['category', 'provider']);
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('products.edit', [
            'product'     => $product,
            'categorias'  => Category::all(),
            'proveedores' => Provider::all(),
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'stock'       => 'required|integer|min:0',
            'price'       => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'provider_id' => 'required|exists:providers,id',
        ]);

        $product->update($request->all());

        return redirect()->route('products.index')->with('ok', 'Producto actualizado');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('ok', 'Producto eliminado');
    }
}
