<?php

namespace App\View\Components\Card;

use Illuminate\View\Component;

class Counter extends Component
{
    public $icon;
    public $color;
    public $title;
    public $total;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($icon, $color = "primary", $title, $total)
    {
        $this->icon = $icon;
        $this->color = $color;
        $this->title = $title;
        $this->total = $total;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.card.counter');
    }
}
