<?php

namespace App\Http\Controllers\Admin\Content;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Content\Section;
use App\Models\Content\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\Content\AddCategoryRequest;

class CategoryController extends Controller
{
    public function showCategories() {
        $sections = Section::with('categories')->orderBy('position')->get();
        return view('admin.content.categories.categories')->with('sections', $sections);
    }

    public function showNewCategoryForm($sectionId) {
        $section = Section::findOrFail($sectionId);
        return view('admin.content.categories.new-category')->with('section', $section);
    }

    public function createNewCategory(AddCategoryRequest $request, $sectionId) {
        $request->validate([
            'slug' => 'required|max:255|unique:categories,slug',
        ]);

        $category = new Category();

        if ($request->hasFile('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $imageName = str_replace(' ', '', $request->name) . '_' . time() . '.' . $extension;
            $request->file('image')->move('storage/images/admin/content/categories' , $imageName);
            $category->image = $imageName;
        }

        $category->section_id = $sectionId;
        $category->name = $request->name;
        $category->slug = Str::slug($request->slug);
        $category->description = $request->description;
        $category->icon = $request->icon;
        $category->position = $request->position;
        $category->active = $request->active;
        $category->promoted = $request->promoted;
        $category->meta_title = $request->meta_title;
        $category->meta_description = $request->meta_description;
        $category->meta_keywords = $request->meta_keywords;
        $category->save();

        Alert::success('A fost creata o noua categorie', 'Categoria ' . $request->name . ' a fost creată cu succes!')->persistent(true, false);

        return redirect(route('show-categories'))->with('success', "Categoria: " . $request->name . ' a fost creată cu succes!');
    }

    public function showEditCategoryForm($categoryId) {
        $category = Category::findOrFail($categoryId);
        return view('admin.content.categories.edit-category')->with('category', $category);
    }

    public function updateCategory(AddCategoryRequest $request, $categoryId) {
        $request->validate([ 
            'slug' => 'required|max:255|unique:categories,slug,' . $categoryId,
        ]);

        $category = Category::findOrFail($categoryId);

        if ($request->hasFile('image')) {
            if (!($category->image == 'category.png')) {
                File::delete($category->imagePath());
            }
            
            $extension = $request->file('image')->getClientOriginalExtension();
            $imageName = str_replace(' ', '', $request->name) . '_' . time() . '.' . $extension;
            $request->file('image')->move('storage/images/admin/content/categories' , $imageName);
            $category->image = $imageName;
        }

        $category->name = $request->name;
        $category->slug = Str::slug($request->slug);
        $category->description = $request->description;
        $category->icon = $request->icon;
        $category->position = $request->position;
        $category->active = $request->active;
        $category->promoted = $request->promoted;
        $category->meta_title = $request->meta_title;
        $category->meta_description = $request->meta_description;
        $category->meta_keywords = $request->meta_keywords;
        $category->save();

        $successUpdateMessage = 'Categoria: <strong>' . $request->name . '</strong> a fost actualizată cu succes!';
        Alert::success('Modificările au fost salvate', $successUpdateMessage)->toHtml()->persistent(true, false);

        return redirect()->back()->with('success', $successUpdateMessage);
    }

    public function showCategoryImagesForm($categoryId) {
        $category = Category::findOrFail($categoryId);
        $uploadImagesFor = "Category";
        return view('admin.content.categories.upload-and-edit-category-images')->with('category', $category)->with('uploadImagesFor', $uploadImagesFor);
    }
}
