<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Content\AddProductRequest;
use App\Models\Content\Brand;
use App\Models\Content\Product;
use App\Models\Content\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    public function showProducts() {
        return view('admin.content.products.products');
    }

    public function showNewProductForm() {
        // Obtinem toate secțiunile, dar alegem să obținem doar id-ul și numele lor, secțiunile sunt sortate după nume:
        $sections = Section::all(['id', 'name'])->sortBy('name');
        // Obtinem toate brand-urile, dar alegem să obținem doar id-ul și numele lor, brand-urile sunt sortate după nume:
        $brands = Brand::all(['id', 'name'])->sortBy('name');
        if ($sections->count() < 1) {
            return back()->with('error', 'Nu există nici-o secțiune disponibilă, nu se poate adăuga un produs fără selelectarea unei secțiuni!');
        }
        return view('admin.content.products.new-product')->with('sections', $sections)->with('brands', $brands);
    }

    public function createNewProduct(AddProductRequest $request) {
        $request->validate([
            'slug' => 'required|max:255|unique:products,slug',
        ]);

        $product = new Product();

        if ($request->hasFile('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $imageName = Str::slug($request->name) . '_' . $request->id . '.' . $extension;
            $request->file('image')->move('storage/images/admin/content/products' , $imageName);
            $product->image = $imageName;
        }

        $product->section_id = $request->section;
        $product->brand_id = $request->brand;
        $product->name = $request->name;
        $product->slug = Str::slug($request->slug);
        $product->position = $request->position;
        $product->price = $request->price;
        $product->discount = $request->discount;
        $product->stock = $request->stock;
        $product->description = $request->description;
        $product->active = $request->active;
        $product->promoted = $request->promoted;
        $product->meta_title = $request->meta_title;
        $product->meta_description = $request->meta_description;
        $product->meta_keywords = $request->meta_keywords;
        $product->save();

        Alert::success('A fost creat un nou product', 'Produsul ' . $request->name . ' a fost creat cu succes!')->persistent(true, false);

        return redirect(route('show-products'))->with('success', "Produsul: " . $request->name . ' a fost creat cu succes!');
    }

    public function showEditProductForm($productId) {
        // Obtinem toate secțiunile, dar alegem să obținem doar id-ul și numele lor, secțiunile sunt sortate după nume:
        $sections = Section::all(['id', 'name'])->sortBy('name');
        // Obtinem toate brand-urile, dar alegem să obținem doar id-ul și numele lor, brand-urile sunt sortate după nume:
        $brands = Brand::all(['id', 'name'])->sortBy('name');
        $product = product::findOrFail($productId);
        return view('admin.content.products.edit-product')->with('product', $product)->with('sections', $sections)->with('brands', $brands);
    }

    public function updateProduct(AddProductRequest $request, $productId) {
        $request->validate([ 
            'slug' => 'required|max:255|unique:products,slug,' . $productId,
        ]);

        $product = Product::findOrFail($productId);

        if ($request->hasFile('image')) {
            if (!($product->image == 'product.png')) {
                File::delete($product->imagePath());
            }
            
            $extension = $request->file('image')->getClientOriginalExtension();
            $imageName = Str::slug($request->name) . '_' . $request->id . '.' . $extension;
            $request->file('image')->move('storage/images/admin/content/products' , $imageName);
            $product->image = $imageName;
        }

        $product->section_id = $request->section;
        $product->brand_id = $request->brand;
        $product->name = $request->name;
        $product->slug = Str::slug($request->slug);
        $product->position = $request->position;
        $product->price = $request->price;
        $product->discount = $request->discount;
        $product->stock = $request->stock;
        $product->description = $request->description;
        $product->active = $request->active;
        $product->promoted = $request->promoted;
        $product->meta_title = $request->meta_title;
        $product->meta_description = $request->meta_description;
        $product->meta_keywords = $request->meta_keywords;
        $product->save();

        $successUpdateMessage = 'Produsul: <strong>' . $request->name . '</strong> a fost actualizat cu succes!';
        Alert::success('Modificările au fost salvate', $successUpdateMessage)->toHtml()->persistent(true, false);

        return redirect()->back()->with('success', $successUpdateMessage);
    }
}
