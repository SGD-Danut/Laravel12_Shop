<?php

namespace App\Livewire\Admin;

use App\Models\Content\Brand;
use App\Models\Content\Category;
use App\Models\Content\Product;
use App\Models\Content\Section;
use Livewire\Component;
use Livewire\WithPagination; // Specificăm că folosim paginația

class Products extends Component
{
    use WithPagination; // Specificăm că folosim paginația și în clasă

    protected $paginationTheme = 'bootstrap'; // Specificăm că folosim paginația cu Bootstrap

    private $products = null;
    private $sections;
    public $currentProduct;
    public $productCategories = [];
    public $selectedSectionId = null;
    public $selectedCategories = null;
    public $selectedCategoryId = null;

    public $selectedSectionTitle = null;
    public $selectedCategoryTitle = null;

    public $brands;
    public $selectedBrandId = null;
    public $selectedBrandTitle = null;

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

    public function selectSection($sectionId) {
        if ($this->selectedSectionId == $sectionId) {
            $this->selectedSectionId = null;
            $this->selectedCategories = null;
            $this->selectedSectionTitle = null;
        } else {
            $this->selectedSectionId = $sectionId;
            $this->selectedCategories = Section::findOrFail($sectionId)->categories->sortBy('name');
            $this->selectedSectionTitle = Section::findOrFail($sectionId)->name;
        }

        $this->selectedCategoryId = null; // Resetăm categoria dacă schimbăm secțiunea
        $this->resetPage(); // Trecem la pagina 1
    }

    public function selectCategory($categoryId) {
        if ($this->selectedCategoryId == $categoryId) {
            $this->selectedCategoryId = null;
            $this->selectedCategoryTitle = null;
        } else {
            $this->selectedCategoryId = $categoryId;
            $this->selectedCategoryTitle = Category::findOrFail($categoryId)->name;
        }

        $this->resetPage(); // Trecem la pagina 1
    }

    public function selectBrand($brandId) {
        if ($this->selectedBrandId == $brandId) {
            $this->selectedBrandId = null;
            $this->selectedBrandTitle = null;
        } else {
            $this->selectedBrandId = $brandId;
            $this->selectedBrandTitle = Brand::findOrFail($brandId)->name;
        }

        $this->resetPage(); // Trecem la pagina 1
    }

    public function render()
    {
        if ($this->selectedSectionId == null && $this->selectedCategoryId == null && $this->selectedBrandId == null) { // Daca nu se selecteaza nimic
            $this->products = Product::query()->orderBy('created_at', 'desc')->paginate();
        } else if ($this->selectedSectionId == null && $this->selectedCategoryId == null && $this->selectedBrandId != null) { // La selectare brand
            $this->products = Product::query()->where('brand_id', '=', $this->selectedBrandId)->orderBy('created_at', 'desc')->paginate();
        } else if ($this->selectedSectionId == null && $this->selectedCategoryId != null && $this->selectedBrandId != null) { // La selectare categorie si brand
            $category = Category::findOrFail($this->selectedCategoryId);
            $this->products = $category->products()->where('brand_id', '=', $this->selectedBrandId)->orderBy('created_at', 'desc')->paginate();
        } else if ($this->selectedSectionId == null && $this->selectedCategoryId != null && $this->selectedBrandId == null) { // La selectare categorie
            $category = Category::findOrFail($this->selectedCategoryId);
            $this->products = $category->products()->orderBy('created_at', 'desc')->paginate();
        } else if ($this->selectedSectionId != null && $this->selectedCategoryId == null && $this->selectedBrandId != null) { // La selectare sectiune si brand
            $this->products = Product::query()->where('section_id', '=', $this->selectedSectionId)->where('brand_id', '=', $this->selectedBrandId)->orderBy('created_at', 'desc')->paginate();
        } else if ($this->selectedSectionId != null && $this->selectedCategoryId != null && $this->selectedBrandId != null) { // La selectare sectiune, categorie si brand
            $category = Category::findOrFail($this->selectedCategoryId);
            $this->products = $category->products()->where('brand_id', '=', $this->selectedBrandId)->orderBy('created_at', 'desc')->paginate();
        } else if ($this->selectedSectionId != null && $this->selectedCategoryId != null && $this->selectedBrandId == null) { // La selectare sectiune si categorie
            $category = Category::findOrFail($this->selectedCategoryId);
            $this->products = $category->products()->orderBy('created_at', 'desc')->paginate();
        } else if ($this->selectedSectionId != null && $this->selectedCategoryId == null && $this->selectedBrandId == null) { // La selectare sectiune
            $this->products = Product::query()->where('section_id', '=', $this->selectedSectionId)->orderBy('created_at', 'desc')->paginate();
        }
        
        $this->sections = Section::all()->sortBy('position');
        $this->brands = Brand::all('name', 'id')->sortBy('position');
        return view('livewire.admin.products', [
            'products' => $this->products,
            'sections' => $this->sections,
            'brands' => $this->brands
        ]);
    }
}
