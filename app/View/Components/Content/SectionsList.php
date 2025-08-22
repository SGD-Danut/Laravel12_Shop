<?php

namespace App\View\Components\Content;

use App\Models\Content\Section;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SectionsList extends Component
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
        $sections = Section::where('active', 1)->orderBy('position')->get();
        return view('components.content.sections-list')->with('sections', $sections);
    }
}
