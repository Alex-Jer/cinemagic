<?php

namespace App\View\Components\Dashboard;

use Illuminate\View\Component;

class CartTable extends Component
{
    public $cart;
    public $config;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($cart, $config)
    {
        $this->cart = $cart;
        $this->config = $config;
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
