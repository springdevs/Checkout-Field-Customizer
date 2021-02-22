<?php

namespace SpringDevs\Cfc\Frontend;

/**
 * Class Shortcode
 * @package SpringDevs\Cfc\Frontend
 */
class Shortcode
{

    public function __construct()
    {
        add_shortcode('checkout_field_customizer', [$this, 'render_frontend']);
        add_filter("woocommerce_checkout_fields", function ($fields) {
            // echo "<pre>";
            // print_r($fields);
            // echo "</pre>";
            $biling_fields = [];
            foreach ($fields as $key => $values) {
                if ($key === "billing") {
                    foreach ($values as $bkey => $bfileds) {
                        array_push($biling_fields, [
                            "key" => $bkey,
                            "type" => isset($bfileds['type']) ? $bfileds['type'] : "text",
                            "label" => isset($bfileds['label']) ? $bfileds['label'] : null,
                            "required" => $bfileds['required'],
                            "class" => $bfileds['class'],
                            "priority" => $bfileds['priority'],
                            "from" => "default"
                        ]);
                    }
                }
            }
            update_option("cfc_billing_fields", $biling_fields);
            update_option("cfc_default_billing_fields", $biling_fields);
            var_dump($biling_fields);
            return $fields;
        }, 99);
    }

    /**
     * Render frontend app
     *
     * @param array $atts
     * @param string $content
     *
     * @return string
     */
    public function render_frontend($atts, $content = '')
    {
        // wp_enqueue_style( 'frontend' );
        // wp_enqueue_script( 'frontend' );

        $content .= 'Hello World!';

        return $content;
    }
}
