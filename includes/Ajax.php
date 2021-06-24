<?php

namespace SpringDevs\ACfc;

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
        add_action('wp_ajax_cfc_delete_field', [$this, 'cfc_delete_field']);
    }

    public function cfc_get_admin_fields()
    {
        wp_send_json(get_option('cfc_admin_form_fields', []));
    }

    public function cfc_create_field()
    {
        if (isset($_POST['action']) && isset($_POST['nonce']) && wp_verify_nonce($_POST['nonce'], 'cfc_ajax_nonce') && isset($_POST['data'])) {
            $fields = $this->sanitize_array_field($_POST['data']);
            if (empty($fields['label'])) {
                return wp_send_json([
                    "type" => "error",
                    "msg" => __("Label field is required !!", "sdevs_cfc")
                ]);
            }
            if (empty($fields['key'])) {
                return wp_send_json([
                    "type" => "error",
                    "msg" => __("Name field is required !!", "sdevs_cfc")
                ]);
            }
            $option_key = sanitize_text_field($_POST['target']);
            $all_fields = get_option($option_key, []);
            array_push($all_fields, [
                "key" => sanitize_text_field($fields['key']),
                "type" => sanitize_text_field($fields['type']),
                "label" => sanitize_text_field($fields['label']),
                "required" => sanitize_text_field($fields['required']),
                "class" => sanitize_text_field($fields['class']),
                "placeholder" => sanitize_text_field($fields['placeholder']),
                "value" => sanitize_text_field($fields['value']),
                "options" => (isset($fields['options']) && is_array($fields['options'])) ? $fields['options'] : [],
                "display_in_email" => sanitize_text_field($fields['display_in_email']),
                "display_in_order" => sanitize_text_field($fields['display_in_order']),
                "status" => sanitize_text_field($fields['status']),
                "priority" => 0,
                "from" => "custom"
            ]);
            update_option($option_key, $all_fields);
            wp_send_json([
                "type" => "success",
                "msg" => "Created successfully !!"
            ]);
        }
    }

    public function cfc_update_field()
    {
        if (isset($_POST['action']) && isset($_POST['nonce']) && wp_verify_nonce($_POST['nonce'], 'cfc_ajax_nonce') && isset($_POST['data'])) {
            $fields = $this->sanitize_array_field($_POST['data']);
            $option_key = sanitize_text_field($_POST['target']);
            if (empty($fields['key'])) {
                return wp_send_json([
                    "type" => "error",
                    "msg" => __("Name field is required !!", "sdevs_cfc")
                ]);
            }
            $all_fields = get_option($option_key, []);
            $index = $_POST['index'];
            foreach ($all_fields as $key => $all_field) {
                if ($key == $index) {
                    $all_fields[$key]["key"] = sanitize_text_field($fields['key']);
                    $all_fields[$key]["type"] = sanitize_text_field($fields['type']);
                    $all_fields[$key]["label"] = sanitize_text_field($fields['label']);
                    $all_fields[$key]["required"] = sanitize_text_field($fields['required']);
                    $all_fields[$key]["class"] = sanitize_text_field($fields['class']);
                    $all_fields[$key]["placeholder"] = sanitize_text_field($fields['placeholder']);
                    $all_fields[$key]["value"] = sanitize_text_field($fields['value']);
                    $all_fields[$key]["options"] = (isset($fields['options']) && is_array($fields['options'])) ? $fields['options'] : [];
                    $all_fields[$key]["display_in_email"] = sanitize_text_field($fields['display_in_email']);
                    $all_fields[$key]["display_in_order"] = sanitize_text_field($fields['display_in_order']);
                    $all_fields[$key]["status"] = sanitize_text_field($fields['status']);
                }
            }
            update_option($option_key, $all_fields);
            wp_send_json([
                "type" => "success",
                "msg" => "Updated successfully !!"
            ]);
        }
    }

    public function cfc_get_fields()
    {
        wp_send_json(get_option(sanitize_text_field($_POST['target']), []));
    }

    public function cfc_update_fields()
    {
        if (is_array($_POST['fields'])) {
            update_option(sanitize_text_field($_POST['target']), $this->sanitize_array_field($_POST['fields']));
            wp_send_json([
                "type" => "success",
                "msg" => "saved successfully !!"
            ]);
        }
    }

    public function cfc_delete_field()
    {
        if (
            isset($_POST['action']) &&
            isset($_POST['nonce']) &&
            wp_verify_nonce($_POST['nonce'], 'cfc_ajax_nonce')
        ) {
            $option_key = sanitize_text_field($_POST['target']);
            $all_fields = get_option($option_key, []);
            unset($all_fields[sanitize_text_field($_POST['index'])]);
            update_option($option_key, $all_fields);
            wp_send_json([
                "type" => "success",
                "msg" => "Successfully Removed !!"
            ]);
        }
    }

    /**
     * Recursive sanitation an array
     * 
     * @param $array
     * @since  1.0.0
     * @return mixed
     */
    public function sanitize_array_field(array $arrays)
    {
        $sanitized_array = [];
        foreach ($arrays as $key => $array) {
            $value = false;
            if (is_array($array)) {
                $value = $this->sanitize_array_field($array);
            } else {
                $value = sanitize_text_field($array);
            }
            $sanitized_array[$key] = $value;
        }
        return $sanitized_array;
    }
}
