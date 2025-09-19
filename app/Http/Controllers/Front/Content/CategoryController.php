<?php

namespace App\Http\Controllers\Front\Content;

use Illuminate\Http\Request;
use App\Models\Content\Category;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function showcategory($categorySlug) {
        $category = Category::where('slug', $categorySlug)->first();
        return view('front.content.show-category')->with('category', $category);
    }
}
