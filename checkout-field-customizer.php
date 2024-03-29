<?php
/*
Plugin Name: Checkout Field Customizer
Plugin URI: https://wordpress.org/plugins/wc-checkout-customizer
Description: Customize your checkout fields easily !!
Version: 1.0.1
Author: SpringDevs
Author URI: https://springdevs.com/
License: GPLv2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: sdevs_cfc
Domain Path: /languages
*/

/**
 * Copyright (c) 2021 SpringDevs (email: contact@springdevs.com). All rights reserved.
 *
 * Released under the GPL license
 * http://www.opensource.org/licenses/gpl-license.php
 *
 * This is an add-on for WordPress
 * http://wordpress.org/
 *
 * **********************************************************************
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 * **********************************************************************
 */

// don't call the file directly
if (!defined('ABSPATH')) {
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';

/**
 * Sdevs_acfc class
 *
 * @class Sdevs_acfc The class that holds the entire Sdevs_cfc plugin
 */
final class Sdevs_acfc
{
    /**
     * Plugin version
     *
     * @var string
     */
    const version = '1.0.1';

    /**
     * Holds various class instances
     *
     * @var array
     */
    private $container = [];

    /**
     * Constructor for the Sdevs_cfc class
     *
     * Sets up all the appropriate hooks and actions
     * within our plugin.
     */
    private function __construct()
    {
        $this->define_constants();

        register_activation_hook(__FILE__, [$this, 'activate']);
        register_deactivation_hook(__FILE__, [$this, 'deactivate']);

        add_action('plugins_loaded', [$this, 'init_plugin']);
    }

    /**
     * Initializes the Sdevs_cfc() class
     *
     * Checks for an existing Sdevs_cfc() instance
     * and if it doesn't find one, creates it.
     *
     * @return Sdevs_cfc|bool
     */
    public static function init()
    {
        static $instance = false;

        if (!$instance) {
            $instance = new Sdevs_acfc();
        }

        return $instance;
    }

    /**
     * Magic getter to bypass referencing plugin.
     *
     * @param $prop
     *
     * @return mixed
     */
    public function __get($prop)
    {
        if (array_key_exists($prop, $this->container)) {
            return $this->container[$prop];
        }

        return $this->{$prop};
    }

    /**
     * Magic isset to bypass referencing plugin.
     *
     * @param $prop
     *
     * @return mixed
     */
    public function __isset($prop)
    {
        return isset($this->{$prop}) || isset($this->container[$prop]);
    }

    /**
     * Define the constants
     *
     * @return void
     */
    public function define_constants()
    {
        define('ACFC_ASSETS_VERSION', self::version);
        define('ACFC_ASSETS_FILE', __FILE__);
        define('ACFC_ASSETS_PATH', dirname(ACFC_ASSETS_FILE));
        define('ACFC_ASSETS_INCLUDES', ACFC_ASSETS_PATH . '/includes');
        define('ACFC_ASSETS_URL', plugins_url('', ACFC_ASSETS_FILE));
        define('ACFC_ASSETS_ASSETS', ACFC_ASSETS_URL . '/assets');
    }

    /**
     * Load the plugin after all plugis are loaded
     *
     * @return void
     */
    public function init_plugin()
    {
        $this->includes();
        $this->init_hooks();
    }

    /**
     * Placeholder for activation function
     *
     * Nothing being called here yet.
     */
    public function activate()
    {
        $installer = new \SpringDevs\ACfc\Installer();
        $installer->run();
    }

    /**
     * Placeholder for deactivation function
     *
     * Nothing being called here yet.
     */
    public function deactivate()
    {
    }

    /**
     * Include the required files
     *
     * @return void
     */
    public function includes()
    {
        if ($this->is_request('admin')) {
            $this->container['admin'] = new SpringDevs\ACfc\Admin();
        }

        if ($this->is_request('frontend')) {
            $this->container['frontend'] = new SpringDevs\ACfc\Frontend();
        }

        if ($this->is_request('ajax')) {
            // require_once ACFC_ASSETS_INCLUDES . '/class-ajax.php';
        }
    }

    /**
     * Initialize the hooks
     *
     * @return void
     */
    public function init_hooks()
    {
        add_action('init', [$this, 'init_classes']);

        // Localize our plugin
        add_action('init', [$this, 'localization_setup']);
    }

    /**
     * Instantiate the required classes
     *
     * @return void
     */
    public function init_classes()
    {
        if ($this->is_request('ajax')) {
            $this->container['ajax'] =  new SpringDevs\ACfc\Ajax();
        }

        $this->container['api']    = new SpringDevs\ACfc\Api();
        $this->container['assets'] = new SpringDevs\ACfc\Assets();
    }

    /**
     * Initialize plugin for localization
     *
     * @uses load_plugin_textdomain()
     */
    public function localization_setup()
    {
        load_plugin_textdomain('sdevs_cfc', false, dirname(plugin_basename(__FILE__)) . '/languages/');
    }

    /**
     * What type of request is this?
     *
     * @param string $type admin, ajax, cron or frontend.
     *
     * @return bool
     */
    private function is_request($type)
    {
        switch ($type) {
            case 'admin':
                return is_admin();

            case 'ajax':
                return defined('DOING_AJAX');

            case 'rest':
                return defined('REST_REQUEST');

            case 'cron':
                return defined('DOING_CRON');

            case 'frontend':
                return (!is_admin() || defined('DOING_AJAX')) && !defined('DOING_CRON');
        }
    }
} // Sdevs_acfc

/**
 * Initialize the main plugin
 *
 * @return \Sdevs_acfc|bool
 */
function sdevs_acfc()
{
    return Sdevs_acfc::init();
}

/**
 *  kick-off the plugin
 */
sdevs_acfc();
