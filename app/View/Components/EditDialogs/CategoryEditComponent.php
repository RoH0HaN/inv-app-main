<?php

namespace App\View\Components\EditDialogs;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CategoryEditComponent extends Component
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
        return view('components.edit-dialogs.category-edit-component');
    }
}
