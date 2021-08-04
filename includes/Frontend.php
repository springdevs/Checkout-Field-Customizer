<?php

namespace SpringDevs\ACfc;

use SpringDevs\ACfc\Frontend\Checkout;
use SpringDevs\ACfc\Frontend\Order;
use SpringDevs\ACfc\Illuminate\Email;

/**
 * Frontend handler class
 */
class Frontend
{
    /**
     * Frontend constructor.
     */
    public function __construct()
    {
        new Checkout();
        new Order();
        new Email();
    }
}
