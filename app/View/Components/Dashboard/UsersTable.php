<?php

namespace App\View\Components\Dashboard;

use Illuminate\View\Component;

class UsersTable extends Component
{
    public $users;
    public $authUser;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($users, $authUser)
    {
        $this->users = $users;
        $this->authUser = $authUser;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dashboard.users-table');
    }
}
