<?php

namespace SpringDevs\Cfc;

/**
 * Class Installer
 * @package SpringDevs\Cfc
 */
class Installer
{
    /**
     * Run the installer
     *
     * @return void
     */
    public function run()
    {
        $this->requirements();
        $this->create_tables();
    }

    /**
     * some requirement actions
     */
    public function requirements()
    {
        // Create Option
        if (!get_option('cfc_billing_fields') && !get_option('cfc_default_billing_fields')) {
            $default_billing_fields = 'a:11:{i:0;a:13:{s:3:"key";s:18:"billing_first_name";s:4:"type";s:4:"text";s:5:"label";s:10:"First name";s:8:"required";s:3:"yes";s:5:"class";s:14:"form-row-first";s:8:"priority";i:10;s:4:"from";s:7:"default";s:6:"status";s:6:"enable";s:11:"placeholder";s:0:"";s:5:"value";s:0:"";s:7:"options";a:0:{}s:16:"display_in_email";s:0:"";s:16:"display_in_order";s:0:"";}i:1;a:8:{s:3:"key";s:17:"billing_last_name";s:4:"type";s:4:"text";s:5:"label";s:9:"Last name";s:8:"required";s:3:"yes";s:5:"class";s:13:"form-row-last";s:8:"priority";i:20;s:4:"from";s:7:"default";s:6:"status";s:6:"enable";}i:2;a:8:{s:3:"key";s:15:"billing_company";s:4:"type";s:4:"text";s:5:"label";s:12:"Company name";s:8:"required";s:3:"yes";s:5:"class";s:13:"form-row-wide";s:8:"priority";i:30;s:4:"from";s:7:"default";s:6:"status";s:6:"enable";}i:3;a:8:{s:3:"key";s:15:"billing_country";s:4:"type";s:7:"country";s:5:"label";s:16:"Country / Region";s:8:"required";s:3:"yes";s:5:"class";s:51:"form-row-wide,address-field,update_totals_on_change";s:8:"priority";i:40;s:4:"from";s:7:"default";s:6:"status";s:6:"enable";}i:4;a:8:{s:3:"key";s:17:"billing_address_1";s:4:"type";s:4:"text";s:5:"label";s:14:"Street address";s:8:"required";s:3:"yes";s:5:"class";s:27:"form-row-wide,address-field";s:8:"priority";i:50;s:4:"from";s:7:"default";s:6:"status";s:6:"enable";}i:5;a:13:{s:3:"key";s:17:"billing_address_2";s:4:"type";s:4:"text";s:5:"label";s:0:"";s:8:"required";s:2:"no";s:5:"class";s:27:"form-row-wide,address-field";s:8:"priority";i:60;s:4:"from";s:7:"default";s:6:"status";s:6:"enable";s:11:"placeholder";s:0:"";s:5:"value";s:0:"";s:7:"options";a:0:{}s:16:"display_in_email";s:0:"";s:16:"display_in_order";s:0:"";}i:6;a:8:{s:3:"key";s:12:"billing_city";s:4:"type";s:4:"text";s:5:"label";s:11:"Town / City";s:8:"required";s:3:"yes";s:5:"class";s:27:"form-row-wide,address-field";s:8:"priority";i:70;s:4:"from";s:7:"default";s:6:"status";s:6:"enable";}i:7;a:8:{s:3:"key";s:13:"billing_state";s:4:"type";s:5:"state";s:5:"label";s:8:"District";s:8:"required";s:3:"yes";s:5:"class";s:27:"form-row-wide,address-field";s:8:"priority";i:80;s:4:"from";s:7:"default";s:6:"status";s:6:"enable";}i:8;a:8:{s:3:"key";s:16:"billing_postcode";s:4:"type";s:4:"text";s:5:"label";s:14:"Postcode / ZIP";s:8:"required";s:3:"yes";s:5:"class";s:27:"form-row-wide,address-field";s:8:"priority";i:90;s:4:"from";s:7:"default";s:6:"status";s:6:"enable";}i:9;a:8:{s:3:"key";s:13:"billing_phone";s:4:"type";s:3:"tel";s:5:"label";s:5:"Phone";s:8:"required";s:3:"yes";s:5:"class";s:13:"form-row-wide";s:8:"priority";i:100;s:4:"from";s:7:"default";s:6:"status";s:6:"enable";}i:10;a:8:{s:3:"key";s:13:"billing_email";s:4:"type";s:5:"email";s:5:"label";s:13:"Email address";s:8:"required";s:3:"yes";s:5:"class";s:13:"form-row-wide";s:8:"priority";i:110;s:4:"from";s:7:"default";s:6:"status";s:6:"enable";}}';

            $default_billing_fields = unserialize($default_billing_fields);

            update_option('cfc_billing_fields', $default_billing_fields);
            update_option('cfc_default_billing_fields', $default_billing_fields);
        }


        // Create Option
        if (!get_option('cfc_shipping_fields') && !get_option('cfc_default_shipping_fields')) {
            $default_shipping_fields = 'a:9:{i:0;a:8:{s:3:"key";s:19:"shipping_first_name";s:4:"type";s:4:"text";s:5:"label";s:10:"First name";s:8:"required";s:3:"yes";s:5:"class";s:14:"form-row-first";s:8:"priority";i:10;s:4:"from";s:7:"default";s:6:"status";s:6:"enable";}i:1;a:8:{s:3:"key";s:18:"shipping_last_name";s:4:"type";s:4:"text";s:5:"label";s:9:"Last name";s:8:"required";s:3:"yes";s:5:"class";s:13:"form-row-last";s:8:"priority";i:20;s:4:"from";s:7:"default";s:6:"status";s:6:"enable";}i:2;a:8:{s:3:"key";s:16:"shipping_company";s:4:"type";s:4:"text";s:5:"label";s:12:"Company name";s:8:"required";s:3:"yes";s:5:"class";s:13:"form-row-wide";s:8:"priority";i:30;s:4:"from";s:7:"default";s:6:"status";s:6:"enable";}i:3;a:8:{s:3:"key";s:16:"shipping_country";s:4:"type";s:7:"country";s:5:"label";s:16:"Country / Region";s:8:"required";s:3:"yes";s:5:"class";s:51:"form-row-wide,address-field,update_totals_on_change";s:8:"priority";i:40;s:4:"from";s:7:"default";s:6:"status";s:6:"enable";}i:4;a:8:{s:3:"key";s:18:"shipping_address_1";s:4:"type";s:4:"text";s:5:"label";s:14:"Street address";s:8:"required";s:3:"yes";s:5:"class";s:27:"form-row-wide,address-field";s:8:"priority";i:50;s:4:"from";s:7:"default";s:6:"status";s:6:"enable";}i:5;a:8:{s:3:"key";s:18:"shipping_address_2";s:4:"type";s:4:"text";s:5:"label";N;s:8:"required";s:3:"yes";s:5:"class";s:27:"form-row-wide,address-field";s:8:"priority";i:60;s:4:"from";s:7:"default";s:6:"status";s:6:"enable";}i:6;a:8:{s:3:"key";s:13:"shipping_city";s:4:"type";s:4:"text";s:5:"label";s:11:"Town / City";s:8:"required";s:3:"yes";s:5:"class";s:27:"form-row-wide,address-field";s:8:"priority";i:70;s:4:"from";s:7:"default";s:6:"status";s:6:"enable";}i:7;a:8:{s:3:"key";s:14:"shipping_state";s:4:"type";s:5:"state";s:5:"label";s:8:"District";s:8:"required";s:3:"yes";s:5:"class";s:27:"form-row-wide,address-field";s:8:"priority";i:80;s:4:"from";s:7:"default";s:6:"status";s:6:"enable";}i:8;a:8:{s:3:"key";s:17:"shipping_postcode";s:4:"type";s:4:"text";s:5:"label";s:14:"Postcode / ZIP";s:8:"required";s:3:"yes";s:5:"class";s:27:"form-row-wide,address-field";s:8:"priority";i:90;s:4:"from";s:7:"default";s:6:"status";s:6:"enable";}}';

            $default_shipping_fields = unserialize($default_shipping_fields);

            update_option('cfc_shipping_fields', $default_shipping_fields);
            update_option('cfc_default_shipping_fields', $default_shipping_fields);
        }


        // Create Option
        if (!get_option('cfc_order_fields') && !get_option('cfc_default_order_fields')) {
            $default_order_fields = 'a:1:{i:0;a:8:{s:3:"key";s:14:"order_comments";s:4:"type";s:8:"textarea";s:5:"label";s:11:"Order notes";s:8:"required";s:2:"no";s:5:"class";s:5:"notes";s:8:"priority";i:0;s:4:"from";s:7:"default";s:6:"status";s:6:"enable";}}';

            $default_order_fields = unserialize($default_order_fields);

            update_option('cfc_order_fields', $default_order_fields);
            update_option('cfc_default_order_fields', $default_order_fields);
        }

        // Create Option
        if (!get_option('cfc_admin_form_fields')) {
            $default_admin_fields = 'a:3:{i:0;a:3:{s:5:"label";s:6:"Labels";s:3:"key";s:22:"cfc_checkout_label_tab";s:6:"fields";a:2:{i:0;a:1:{s:3:"row";a:2:{i:0;a:5:{s:5:"label";s:5:"Label";s:4:"type";s:4:"text";s:4:"name";s:5:"label";s:11:"placeholder";s:11:"Enter Label";s:5:"value";s:0:"";}i:1;a:5:{s:5:"label";s:22:"Placeholder (optional)";s:4:"type";s:4:"text";s:4:"name";s:11:"placeholder";s:11:"placeholder";s:17:"Enter placeholder";s:5:"value";s:0:"";}}}i:1;a:5:{s:5:"label";s:24:"Default Value (optional)";s:4:"type";s:4:"text";s:4:"name";s:5:"value";s:11:"placeholder";s:19:"Enter default value";s:5:"value";s:0:"";}}}i:1;a:3:{s:5:"label";s:8:"Settings";s:3:"key";s:25:"cfc_checkout_settings_tab";s:6:"fields";a:4:{i:0;a:1:{s:3:"row";a:2:{i:0;a:5:{s:5:"label";s:4:"Type";s:4:"type";s:6:"select";s:4:"name";s:4:"type";s:5:"value";s:4:"text";s:7:"options";a:7:{i:0;a:1:{s:4:"text";s:4:"Text";}i:1;a:1:{s:3:"tel";s:5:"Phone";}i:2;a:1:{s:5:"email";s:5:"Email";}i:3;a:1:{s:8:"password";s:8:"Password";}i:4;a:1:{s:6:"select";s:6:"Select";}i:5;a:1:{s:8:"textarea";s:8:"Textarea";}i:6;a:1:{s:5:"radio";s:5:"Radio";}}}i:1;a:5:{s:5:"label";s:4:"Name";s:4:"type";s:4:"text";s:4:"name";s:3:"key";s:11:"placeholder";s:22:"Name must be unique !!";s:5:"value";s:0:"";}}}i:1;a:1:{s:3:"row";a:2:{i:0;a:5:{s:5:"label";s:6:"Status";s:4:"type";s:6:"select";s:4:"name";s:6:"status";s:5:"value";s:6:"enable";s:7:"options";a:2:{i:0;a:1:{s:6:"enable";s:6:"Enable";}i:1;a:1:{s:7:"disable";s:7:"Disable";}}}i:1;a:5:{s:5:"label";s:8:"Required";s:4:"type";s:6:"select";s:4:"name";s:8:"required";s:5:"value";s:3:"yes";s:7:"options";a:2:{i:0;a:1:{s:3:"yes";s:3:"Yes";}i:1;a:1:{s:2:"no";s:2:"No";}}}}}i:2;a:1:{s:3:"row";a:2:{i:0;a:5:{s:5:"label";s:17:"Display in Emails";s:4:"type";s:6:"select";s:4:"name";s:16:"display_in_email";s:5:"value";s:3:"yes";s:7:"options";a:2:{i:0;a:1:{s:3:"yes";s:3:"Yes";}i:1;a:1:{s:2:"no";s:2:"No";}}}i:1;a:5:{s:5:"label";s:29:"Display in Order Detail Pages";s:4:"type";s:6:"select";s:4:"name";s:16:"display_in_order";s:5:"value";s:3:"yes";s:7:"options";a:2:{i:0;a:1:{s:3:"yes";s:3:"Yes";}i:1;a:1:{s:2:"no";s:2:"No";}}}}}i:3;a:6:{s:5:"label";s:7:"Options";s:4:"type";s:5:"multi";s:11:"conditional";s:4:"true";s:12:"target_field";s:4:"type";s:4:"name";s:7:"options";s:6:"values";a:2:{i:0;s:6:"select";i:1;s:5:"radio";}}}}i:2;a:3:{s:5:"label";s:7:"Styling";s:3:"key";s:22:"cfc_checkout_style_tab";s:6:"fields";a:1:{i:0;a:5:{s:5:"label";s:5:"Class";s:4:"type";s:4:"text";s:4:"name";s:5:"class";s:11:"placeholder";s:16:"Enter class name";s:5:"value";s:13:"form-row-wide";}}}}';

            $default_admin_fields = unserialize($default_admin_fields);

            update_option('cfc_admin_form_fields', $default_admin_fields);
        }
    }

    /**
     * Create necessary database tables
     *
     * @return void
     */
    public function create_tables()
    {
        if (!function_exists('dbDelta')) {
            require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        }
    }
}
