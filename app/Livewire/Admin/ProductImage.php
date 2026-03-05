<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads; // Pentru incarcare fisier
use Livewire\Attributes\Validate; // Pentru validare fisier daca se foloseste sintaxa noua livewire

class ProductImage extends Component
{
    use WithFileUploads; // Pentru incarcare fisier

    public $model;
    public $productImage;
    public $defaultProductImageName;
    public $productImageDirectoryForSaving;

    public function updatedProductImage($value) {
        // Validăm imaginea
        $this->validate([
            'productImage' => 'image|max:1024'
        ]);

        // Ștergem imaginea veche de pe HDD:
        if (!($this->model->image == $this->defaultProductImageName)) {
            Storage::disk('images2')->delete($this->productImageDirectoryForSaving . '/' . $this->model->image);
        }

        // Setăm numele noii imagini + extensia:
        $newProductImageName = Str::slug($this->model->name) . '_' . $this->model->id . '.' . $value->getClientOriginalExtension();

        // Salvăm noua imagine pe HDD:
        $value->storeAs($this->productImageDirectoryForSaving, $newProductImageName, 'images2');

        // Salvăm numele noii imagini in baza de date:
        $this->model->image = $newProductImageName;
        $this->model->save();

        // Curățăm cache-ul:
        $this->productImage = null;
    }

    public function render()
    {
        return view('livewire.admin.product-image');
    }
}
