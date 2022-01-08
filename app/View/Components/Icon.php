<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Icon extends Component
{
    public $icon;
    public $size;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($icon, $size = "sm")
    {
        $this->icon = $icon;
        $this->size = $size;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.icon');
    }
}
