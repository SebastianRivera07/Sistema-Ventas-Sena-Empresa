<?php

namespace App\Livewire\ProductDeliveries;

use App\Models\ProductDelivery;
use Livewire\WithPagination;
use Livewire\Component;

class Index extends Component
{
    use WithPagination;

    public $delivery;

    public function mount(){
        $delivery = ProductDelivery::with('provider', 'product')->get();
    }

    public function render()
    {
        return view('livewire.product-deliveries.index', [
            'deliveries' => ProductDelivery::latest()->paginate(10),
        ]);
    }
}
