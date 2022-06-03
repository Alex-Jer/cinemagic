<?php

namespace App\View\Components\Dashboard;

use Illuminate\View\Component;

class Input extends Component
{
    public $label;
    public $placeholder;
    public $name;
    public $attr;
    public $color;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label, $placeholder = null, $name, $attr = null, $color = null)
    {
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->name = $name;
        $this->attr = $attr;
        $this->color = $color;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dashboard.input');
    }
}
