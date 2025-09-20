<?php

namespace App\Http\Controllers\Admin\Content;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Content\Brand;
use App\Http\Controllers\Controller;
use App\Http\Requests\Content\AddBrandRequest;
use RealRashid\SweetAlert\Facades\Alert;

class BrandController extends Controller
{
    public function showBrands() {
        $brands = Brand::all()->sortBy('position');
        return view('admin.content.brands.brands')->with('brands', $brands);
    }

    public function showNewBrandForm() {
        return view('admin.content.brands.new-brand');
    }

    public function createNewBrand(AddBrandRequest $request) {
        $request->validate([
            'slug' => 'required|max:255|unique:brands,slug',
        ]);

        $brand = new Brand();

        if ($request->hasFile('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $imageName = str_replace(' ', '', $request->name) . '_' . time() . '.' . $extension;
            $request->file('image')->move('storage/images/admin/content/brands' , $imageName);
            $brand->image = $imageName;
        }

        $brand->name = $request->name;
        $brand->slug = Str::slug($request->slug);
        $brand->description = $request->description;
        $brand->position = $request->position;
        $brand->active = $request->active;
        $brand->promoted = $request->promoted;
        $brand->meta_title = $request->meta_title;
        $brand->meta_description = $request->meta_description;
        $brand->meta_keywords = $request->meta_keywords;
        $brand->save();

        Alert::success('A fost creat un nou brand', 'Brand-ul ' . $request->name . ' a fost creat cu succes!')->persistent(true, false);

        return redirect(route('show-brands'))->with('success', "Brand-ul: " . $request->name . ' a fost creat cu succes!');
    }
}
