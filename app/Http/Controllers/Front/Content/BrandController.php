<?php

namespace App\Http\Controllers\Front\Content;

use App\Http\Controllers\Controller;
use App\Models\Content\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function showAllBrands() {
        $brands = Brand::all()->where('active', true)->sortBy('position');
        return view('front.content.brands.show-all-brands')->with('brands', $brands);
    }

    public function showBrand($brandSlug) {
        $brand = Brand::where('slug', $brandSlug)->first();
        return view('front.content.brands.show-brand')->with('brand', $brand);
    }
}
