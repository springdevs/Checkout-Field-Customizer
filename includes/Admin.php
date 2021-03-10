<?php

namespace SpringDevs\Cfc;

use SpringDevs\Cfc\Admin\Order;

/**
 * The admin class
 */
class Admin {

    /**
     * Initialize the class
     */
    public function __construct() {
        $this->dispatch_actions();
        new Admin\Menu();
        new Order();
    }

    /**
     * Dispatch and bind actions
     *
     * @return void
     */
    public function dispatch_actions() {

    }

}
