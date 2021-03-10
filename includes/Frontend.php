<?php

namespace SpringDevs\Cfc;

use SpringDevs\Cfc\Frontend\Checkout;
use SpringDevs\Cfc\Frontend\Order;

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
//         new Frontend\Shortcode();
        new Checkout();
        new Order();
    }
}
