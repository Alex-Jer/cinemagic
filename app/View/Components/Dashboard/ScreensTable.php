<?php

namespace App\View\Components\Dashboard;

use Illuminate\View\Component;

class ScreensTable extends Component
{
    public $screens;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($screens)
    {
        $this->screens = $screens;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dashboard.screens-table');
    }
}
