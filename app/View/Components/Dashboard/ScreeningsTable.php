<?php

namespace App\View\Components\Dashboard;

use Illuminate\View\Component;

class ScreeningsTable extends Component
{
    public $film;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($film)
    {
        $this->film = $film;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dashboard.screenings-table');
    }
}
