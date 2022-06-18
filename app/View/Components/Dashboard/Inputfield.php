<?php

namespace App\View\Components\Dashboard;

use Illuminate\View\Component;

class Inputfield extends Component
{
    public $label;
    public $name;
    public $placeholder;
    public $value;
    public $attr;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label, $name, $placeholder = null, $value = null, $attr = null)
    {
        $this->label = $label;
        $this->name = $name;
        $this->placeholder = $placeholder;
        $this->value = $value;
        $this->attr = $attr;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dashboard.inputfield');
    }
}
