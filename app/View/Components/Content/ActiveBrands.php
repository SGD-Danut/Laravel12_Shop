<?php

namespace App\View\Components\Content;

use App\Models\Content\Brand;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ActiveBrands extends Component
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
        // Obținem toate brand-urile dar doar cu colanele specificate în funcția all():
        $brands = Brand::all('image', 'slug', 'active')->where('active', true);
        // Punem la dispoziție vederii brand-urile cu colanele specificate în funcția all() de mai sus:
        return view('components.content.active-brands')->with('brands', $brands);
    }
}
