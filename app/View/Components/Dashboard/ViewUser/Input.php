<?php

namespace App\View\Components\Dashboard\ViewUser;

use Illuminate\View\Component;

class Input extends Component
{
    public $label;
    public $content;
    public $value;
    public $name;
    public $attr;
    public $mode;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label, $content = null, $value = null, $name, $attr = null, $mode = 'edit')
    {
        $this->label = $label;
        $this->content = $content;
        $this->value = $value;
        $this->name = $name;
        $this->attr = $attr;
        $this->mode = $mode;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dashboard.view-user.input');
    }
}
