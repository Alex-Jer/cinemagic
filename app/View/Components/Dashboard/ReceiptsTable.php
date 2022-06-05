<?php

namespace App\View\Components\Dashboard;

use Illuminate\View\Component;

class ReceiptsTable extends Component
{
    public $receipts;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($receipts)
    {
        $this->receipts = $receipts;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dashboard.receipts-table');
    }
}
