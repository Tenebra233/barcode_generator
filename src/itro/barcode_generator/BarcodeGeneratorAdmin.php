<?php


namespace Itro\BarcodeGenerator;


class BarcodeGeneratorAdmin
{
    public static function Hooks()
    {
        $me = new self();
        add_action('woocommerce_product_options_general_product_data', [$me, 'addBarcodeField']);
    }

    public function addBarcodeField(){
        global $woocommerce, $post;
        echo '<div class="product_custom_field">';
        woocommerce_wp_text_input(
            array(
                'id' => '_custom_product_text_field',
                'placeholder' => 'Custom Product Text Field',
                'label' => __('Custom Product Text Field', 'woocommerce'),
                'desc_tip' => 'true'
            )
        );
        echo "</div>";
    }

}