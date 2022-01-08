<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Button extends Component
{
    public $variant;
    public $color;
    public $tag;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($variant = "", $color = "primary")
    {
        $this->variant = $variant;
        $this->color = $color;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.button');
    }
}
