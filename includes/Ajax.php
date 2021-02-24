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
            $all_fields = get_option("cfc_billing_fields", []);
            array_push($all_fields, [
                "key" => sanitize_text_field($fields['cfc-admin-name']),
                "type" => sanitize_text_field($fields['cfc-admin-type']),
                "label" => sanitize_text_field($fields['cfc-admin-label']),
                "required" => sanitize_text_field($fields['cfc-admin-required']),
                "class" => sanitize_text_field($fields['cfc-admin-class']),
                "desc" => sanitize_text_field($fields['cfc-admin-desc']),
                "placeholder" => sanitize_text_field($fields['cfc-admin-placeholder']),
                "value" => sanitize_text_field($fields['cfc-admin-value']),
                "display_in_email" => sanitize_text_field($fields['cfc-admin-display-email']),
                "display_in_order" => sanitize_text_field($fields['cfc-admin-display-order']),
                "status" => sanitize_text_field($fields['cfc-admin-status']),
                "priority" => 0,
                "from" => "custom"
            ]);
            update_option("cfc_billing_fields", $all_fields);
            wp_send_json([
                "type" => "success",
                "msg" => "Created successfully !!"
            ]);
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
