<?php

namespace App\View\Components\Receipts;

use Illuminate\View\Component;

class Table extends Component
{
    public $receipt;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($receipt)
    {
        $this->receipt = $receipt;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.receipts.table');
    }
}
