<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ErrorPage extends Component
{

    public $errorCode;
    public $errorTitle;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($errorCode, $errorTitle = "Error")
    {
        $this->errorCode = $errorCode;
        $this->errorTitle = $errorTitle;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.error-page');
    }
}
