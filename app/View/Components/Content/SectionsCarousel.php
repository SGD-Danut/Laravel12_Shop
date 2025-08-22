<?php

namespace App\View\Components\Content;

use Closure;
use Illuminate\View\Component;
use App\Models\Content\Section;
use Illuminate\Contracts\View\View;

class SectionsCarousel extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $sections = Section::where('active', 1)->where('promoted', 1)->orderBy('position')->get();
        return view('components.content.sections-carousel')->with('sections', $sections);
    }
}
