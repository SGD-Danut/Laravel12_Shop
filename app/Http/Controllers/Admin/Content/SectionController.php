<?php

namespace App\Http\Controllers\Admin\Content;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Content\Section;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;
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
        $request->validate([
            'slug' => 'required|max:255|unique:sections,slug',
        ]);

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

        Alert::success('A fost creata o noua sectiune', 'Secțiunea ' . $request->name . ' a fost creată cu succes!')->persistent(true, false);

        return redirect(route('show-sections'))->with('success', "Secțiunea: " . $request->name . ' a fost creată cu succes!');
    }

    public function showEditSectionForm($sectionId) {
        $section = Section::findOrFail($sectionId);
        return view('admin.content.sections.edit-section')->with('section', $section);
    }

    public function updateSection(AddSectionRequest $request, $sectionId) {
        $request->validate([ 
            'slug' => 'required|max:255|unique:sections,slug,' . $sectionId,
        ]);

        $section = Section::findOrFail($sectionId);

        if ($request->hasFile('image')) {
            if (!($section->image == 'section.png')) {
                File::delete($section->imagePath());
            }
            
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

        $successUpdateMessage = 'Secțiunea: <strong>' . $request->name . '</strong> a fost actualizată cu succes!';
        Alert::success('Modificările au fost salvate', $successUpdateMessage)->toHtml()->persistent(true, false);

        return redirect()->back()->with('success', $successUpdateMessage);
    }
}
