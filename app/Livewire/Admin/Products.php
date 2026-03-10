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
    public $currentProduct;
    public $productCategories = [];

    public function obtainProductId($productId) {
        if (!$productId) {
            return;
        }

        // 1. Încărcăm produsul cu relația de categorii deja existentă
        $this->currentProduct = Product::with('categories')->findOrFail($productId);

        // Luăm fiecare categorie pe care o are deja produsul
        foreach ($this->currentProduct->categories as $category) {
            // Adăugăm ID-ul în array-ul nostru de selecții (ca text/string)
            $this->productCategories[] = (string) $category->id;
        }
    }

    public function setProductCategories()
    {
        $this->currentProduct->categories()->sync($this->productCategories);

        // Închide modalul
        $this->dispatch('close-modal');

        // Trimitem datele către SweetAlert, inclusiv numele produsului
        $this->dispatch('swal:modal', [
            'type'  => 'success',
            'title' => 'Actualizare reușită!',
            'text'  => "Categoriile pentru produsul '" . $this->currentProduct->name . "' au fost salvate.",
        ]);
    }

    public function render()
    {
        $this->products = Product::query()->orderBy('created_at', 'desc')->paginate();
        return view('livewire.admin.products', [
            'products' => $this->products
        ]);
    }
}
