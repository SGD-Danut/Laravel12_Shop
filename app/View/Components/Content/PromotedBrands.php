<?php

namespace App\View\Components\Content;

use App\Models\Content\Brand;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PromotedBrands extends Component
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
        $brands = Brand::where('promoted', true)->where('active', true)->inRandomOrder()->take(2)->get();
        return view('components.content.promoted-brands')->with('brands', $brands);
    }
}
