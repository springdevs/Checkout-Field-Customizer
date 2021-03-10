<?php

namespace SpringDevs\Cfc;

use SpringDevs\Cfc\Frontend\Checkout;

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
    }
}
