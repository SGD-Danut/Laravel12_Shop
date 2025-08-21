<?php

namespace App\Http\Controllers\Admin\Content;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Content\Section;
use App\Http\Controllers\Controller;
use App\Http\Requests\Content\AddSectionRequest;

class SectionController extends Controller
{
    public function showSections() {
        $sections = Section::all()->sortBy('position');
        return view('admin.content.sections.sections')->with('sections', $sections);
    }

    public function showNewSectionForm() {
        return view('admin.content.sections.new-section');
    }

    public function createNewSection(AddSectionRequest $request) {
        $section = new Section();

        if ($request->hasFile('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $imageName = str_replace(' ', '', $request->name) . '_' . time() . '.' . $extension;
            $request->file('image')->move('storage/images/admin/content/sections' , $imageName);
            $section->image = $imageName;
        }

        $section->name = $request->name;
        $section->slug = Str::slug($request->slug);
        $section->description = $request->description;
        $section->icon = $request->icon;
        $section->position = $request->position;
        $section->active = $request->active;
        $section->promoted = $request->promoted;
        $section->meta_title = $request->meta_title;
        $section->meta_description = $request->meta_description;
        $section->meta_keywords = $request->meta_keywords;
        $section->save();

        return redirect(route('show-sections'))->with('success', "Secțiunea: " . $request->name . ' a fost creată!');
    }
}
