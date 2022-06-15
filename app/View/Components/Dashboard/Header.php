<?php

namespace App\View\Components\Dashboard;

use Illuminate\View\Component;

class Header extends Component
{
    public $simpleLayout;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($simpleLayout = false)
    {
        $this->simpleLayout = $simpleLayout;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dashboard.header');
    }
}
