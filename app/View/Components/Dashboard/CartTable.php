<?php

namespace App\View\Components\Dashboard;

use Illuminate\View\Component;

class CartTable extends Component
{
    public $cart;
    public $price;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($cart, $price)
    {
        $this->cart = $cart;
        $this->price = $price;
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
