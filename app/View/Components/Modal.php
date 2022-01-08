<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Modal extends Component
{
    public $title;
    public $form;
    public $action;
    public $method;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $form = false, $action = "", $method = "POST")
    {
        $this->title = $title;
        $this->form = $form;
        $this->action = $action;
        $this->method = $method;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modal');
    }
}
