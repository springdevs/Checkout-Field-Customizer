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
        add_action('wp_ajax_cfc_update_field', [$this, 'cfc_update_field']);
        add_action('wp_ajax_cfc_get_fields', [$this, 'cfc_get_fields']);
        add_action('wp_ajax_cfc_get_admin_fields', [$this, 'cfc_get_admin_fields']);
        add_action('wp_ajax_cfc_update_fields', [$this, 'cfc_update_fields']);
        // add_action('wp_ajax_cfc_test_fields', function () {
        //     update_option("cfc_admin_form_fields", $_POST['tabs']);
        //     wp_send_json($_POST);
        // });
    }

    public function cfc_get_admin_fields()
    {
        wp_send_json(get_option('cfc_admin_form_fields', []));
    }

    public function cfc_create_field()
    {
        if (isset($_POST['action']) && isset($_POST['nonce']) && wp_verify_nonce($_POST['nonce'], 'cfc_ajax_nonce') && isset($_POST['data'])) {
            $fields = $_POST['data'];
            if (empty($fields['label'])) {
                return wp_send_json([
                    "type" => "error",
                    "msg" => __("Label field is required !!", "sdevs_wea")
                ]);
            }
            if (empty($fields['key'])) {
                return wp_send_json([
                    "type" => "error",
                    "msg" => __("Name field is required !!", "sdevs_wea")
                ]);
            }
            $all_fields = get_option("cfc_billing_fields", []);
            array_push($all_fields, [
                "key" => sanitize_text_field($fields['key']),
                "type" => sanitize_text_field($fields['type']),
                "label" => sanitize_text_field($fields['label']),
                "required" => sanitize_text_field($fields['required']),
                "class" => sanitize_text_field($fields['class']),
                "desc" => sanitize_text_field($fields['desc']),
                "placeholder" => sanitize_text_field($fields['placeholder']),
                "value" => sanitize_text_field($fields['value']),
                "options" => (isset($fields['options']) && is_array($fields['options'])) ? $fields['options'] : [],
                "display_in_email" => sanitize_text_field($fields['display_in_email']),
                "display_in_order" => sanitize_text_field($fields['display_in_order']),
                "status" => sanitize_text_field($fields['status']),
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

    public function cfc_update_field()
    {
        if (isset($_POST['action']) && isset($_POST['nonce']) && wp_verify_nonce($_POST['nonce'], 'cfc_ajax_nonce') && isset($_POST['data'])) {
            $fields = $_POST['data'];
            if (empty($fields['label'])) {
                return wp_send_json([
                    "type" => "error",
                    "msg" => __("Label field is required !!", "sdevs_wea")
                ]);
            }
            if (empty($fields['key'])) {
                return wp_send_json([
                    "type" => "error",
                    "msg" => __("Name field is required !!", "sdevs_wea")
                ]);
            }
            $all_fields = get_option('cfc_billing_fields', []);
            $index = $_POST['index'];
            foreach ($all_fields as $key => $all_field) {
                if ($key == $index) {
                    $all_fields[$key]["key"] = sanitize_text_field($fields['key']);
                    $all_fields[$key]["type"] = sanitize_text_field($fields['type']);
                    $all_fields[$key]["label"] = sanitize_text_field($fields['label']);
                    $all_fields[$key]["required"] = sanitize_text_field($fields['required']);
                    $all_fields[$key]["class"] = sanitize_text_field($fields['class']);
                    $all_fields[$key]["desc"] = sanitize_text_field($fields['desc']);
                    $all_fields[$key]["placeholder"] = sanitize_text_field($fields['placeholder']);
                    $all_fields[$key]["value"] = sanitize_text_field($fields['value']);
                    $all_fields[$key]["options"] = (isset($fields['options']) && is_array($fields['options'])) ? $fields['options'] : [];
                    $all_fields[$key]["display_in_email"] = sanitize_text_field($fields['display_in_email']);
                    $all_fields[$key]["display_in_order"] = sanitize_text_field($fields['display_in_order']);
                    $all_fields[$key]["status"] = sanitize_text_field($fields['status']);
                }
            }
            update_option("cfc_billing_fields", $all_fields);
            wp_send_json([
                "type" => "success",
                "msg" => "Updated successfully !!"
            ]);
        }
    }

    public function cfc_get_fields()
    {
        wp_send_json(get_option($_POST['target'], []));
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
