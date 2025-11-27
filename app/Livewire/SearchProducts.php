<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class SearchProducts extends Component
{
    public $search = '';
    public $products = [];

    protected $listeners = ['open-search-products' => 'open'];

    public $show = false;

    public function open()
    {
        $this->show = true;
    }

    public function updatedSearch()
    {
        $this->products = Product::where('name', 'like', "%{$this->search}%")->limit(10)->get();
    }

    public function selectProduct($id)
    {
        $product = Product::find($id);

        // Enviar datos al JavaScript
    //     $this->dispatch('product-selected', [
    //     'id' => $product->id,
    //     'name' => $product->name,
    //     'price' => $product->price,
    // ]);
        $this->dispatch(
            'product-selected',
            id: $product->id,
            name: $product->name,
            price: $product->price,
        )->self(); // evita que Livewire re-renderice el componente completo


        $this->reset(['search', 'products']);
        $this->show = false;
    }

    public function render()
    {
        return view('livewire.search-products');
    }
}
