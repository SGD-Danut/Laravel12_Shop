<?php

namespace App\Livewire\Admin;

use App\Models\Content\Product;
use Livewire\Component;
use Livewire\WithPagination; // Specificăm că folosim paginația

class Products extends Component
{
    use WithPagination; // Specificăm că folosim paginația și în clasă

    protected $paginationTheme = 'bootstrap'; // Specificăm că folosim paginația cu Bootstrap

    private $products = null;

    public function render()
    {
        $this->products = Product::query()->orderBy('name')->paginate();
        return view('livewire.admin.products', [
            'products' => $this->products
        ]);
    }
}
