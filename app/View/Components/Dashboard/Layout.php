<?php

namespace App\View\Components\Dashboard;

use Illuminate\View\Component;

class Layout extends Component
{
    public $title;
    public $header;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $header = null)
    {
        $this->title = $title;
        $this->header  = $header;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dashboard.layout');
    }
}
