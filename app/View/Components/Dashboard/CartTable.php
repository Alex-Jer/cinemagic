<?php

namespace App\View\Components\Dashboard;

use Illuminate\View\Component;

class CartTable extends Component
{
    public $cart;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($cart)
    {
        $this->cart = $cart;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dashboard.cart-table');
    }
}
