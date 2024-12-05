<?php

namespace App\View\Components\header;

use App\Models\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class navbar extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
       $categories=Category::select('id','title')->get();  
        return view('components.header.navbar',compact('categories'));
    }
}
