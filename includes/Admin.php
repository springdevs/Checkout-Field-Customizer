<?php

namespace SpringDevs\ACfc;

use SpringDevs\ACfc\Admin\Order;
use SpringDevs\ACfc\Illuminate\Email;

/**
 * The admin class
 */
class Admin
{

    /**
     * Initialize the class
     */
    public function __construct()
    {
        $this->dispatch_actions();
        new Admin\Menu();
        new Order();
        new Email();
    }

    /**
     * Dispatch and bind actions
     *
     * @return void
     */
    public function dispatch_actions()
    {
    }
}
