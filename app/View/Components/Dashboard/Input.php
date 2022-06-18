<?php

namespace App\View\Components\Dashboard;

use Illuminate\View\Component;

class Input extends Component
{
    public $label;
    public $placeholder;
    public $value;
    public $name;
    public $attr;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label, $placeholder = null, $name, $attr = null)
    {
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->value = "";
        $this->name = $name;
        $this->attr = $attr;
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
