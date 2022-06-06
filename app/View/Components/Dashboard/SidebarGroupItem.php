<?php

namespace App\View\Components\Dashboard;

use Illuminate\View\Component;

class SidebarGroupItem extends Component
{
    public $label;
    public $route;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label, $route = null)
    {
        $this->label = $label;
        $this->route = $route;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dashboard.sidebar-group-item');
    }
}
