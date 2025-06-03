<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Breadcrumb extends Component
{
    public $links;

    /**
     * Create a new component instance.
     *
     * @param array $links Array of breadcrumb links with 'url' and 'text' keys
     * @return void
     */
    public function __construct(array $links = [])
    {
        $this->links = $links;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.breadcrumb');
    }
}
