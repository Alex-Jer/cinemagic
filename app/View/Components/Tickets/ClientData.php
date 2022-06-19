<?php

namespace App\View\Components\Tickets;

use Illuminate\View\Component;

class ClientData extends Component
{
    public $ticket;
    public $email;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($ticket, $email = true)
    {
        $this->ticket = $ticket;
        $this->email = $email;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.tickets.client-data');
    }
}
