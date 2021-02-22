<?php

namespace SpringDevs\Cfc;

/**
 * The ajax class
 */
class Ajax
{

    /**
     * Initialize the class
     */
    public function __construct()
    {
        add_action('wp_ajax_cfc_create_field', [$this, 'cfc_create_field']);
        add_action('wp_ajax_cfc_get_fields', [$this, 'cfc_get_fields']);
        add_action('wp_ajax_cfc_update_fields', [$this, 'cfc_update_fields']);
    }

    public function cfc_create_field()
    {
        if (isset($_POST['action']) && isset($_POST['nonce']) && wp_verify_nonce($_POST['nonce'], 'cfc_ajax_nonce') && isset($_POST['data'])) {
            $fields = $_POST['data'];
            if (empty($fields['cfc-admin-label'])) {
                return wp_send_json([
                    "type" => "error",
                    "msg" => __("Label field is required !!", "sdevs_wea")
                ]);
            }
            if (empty($fields['cfc-admin-name'])) {
                return wp_send_json([
                    "type" => "error",
                    "msg" => __("Name field is required !!", "sdevs_wea")
                ]);
            }
            wp_send_json($fields);
        }
    }

    public function cfc_get_fields()
    {
        wp_send_json(get_option('cfc_billing_fields', []));
    }

    public function cfc_update_fields()
    {
        if (is_array($_POST['fields'])) {
            update_option('cfc_billing_fields', $_POST['fields']);
            wp_send_json([
                "type" => "success",
                "msg" => "saved successfully !!"
            ]);
        }
    }
}
