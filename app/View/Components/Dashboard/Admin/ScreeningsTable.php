<?php

namespace App\View\Components\Dashboard\Admin;

use Illuminate\View\Component;

class ScreeningsTable extends Component
{
    public $screenings;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($screenings)
    {
        $this->screenings = $screenings;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dashboard.admin.screenings-table');
    }
}
