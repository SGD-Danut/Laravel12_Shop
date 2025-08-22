<?php

namespace App\Http\Controllers\Front\Content;

use Illuminate\Http\Request;
use App\Models\Content\Section;
use App\Http\Controllers\Controller;

class SectionController extends Controller
{
    public function showSection($sectionSlug) {
        $section = Section::where('slug', $sectionSlug)->first();
        return view('front.content.show-section')->with('section', $section);
    }
}
