<?php


namespace Itro\BarcodeGenerator;


use Com\Tecnick\Barcode\Barcode;

class BarcodeGeneratorAdmin
{
    public static function Hooks()
    {
        $me = new self();
        add_action('woocommerce_product_options_general_product_data', [$me, 'addBarcodeField']);
        add_action('save_post_product', [$me, 'generateBarcode'], 10, 3);
        add_action('woocommerce_before_add_to_cart_form', [$me, 'testfunc']);
    }


    public function testfunc()
    {
        $product = wc_get_product();
        $id = $product->get_id();
        /*        echo <img src="<?php echo  . $timestamp; ?>.png">*/
        echo "<div id='pippo'>";
        $website = $_SERVER['SERVER_NAME'];
//        $imgUrl = "http://$web/site/barcode_plugin/wp-content/plugins/barcode_plugin/src/itro/barcode_generator/".$id.".png";
//        $page = get_page_by_path($imgUrl);
//        if ( !$page){
//            echo "<h2>Barcode not found!</h2>";
//        }
        echo '<img id="barcodeDisplay" src="http://' . $website . '/barcode_plugin/wp-content/plugins/barcode_plugin/src/itro/barcode_generator/' . strval($id) . '.png" width="450" onerror="errorBarcode()">';
        echo "</div>";

        ?><script>function errorBarcode() {
            document.getElementById("barcodeDisplay").src = "https://static.dribbble.com/users/1963449/screenshots/5915645/404_not_found.png";

        }</script><?php
    }

    public function addBarcodeField()
    {
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

    public function generateBarcode($postId)
    {
        $barcode = new Barcode();
        $targetPath = "/var/www/html/barcode_plugin/wp-content/barcodes/";
        if (!is_dir($targetPath)) {
            mkdir($targetPath, 0777, true);
        }
        $product = wc_get_product($postId);
        $productName = $product->get_name();
        $productPrice = $product->get_price();
        $productData = "0981{$postId}1012355123";
        $bobj = $barcode->getBarcodeObj('C128C', "{$productData}", 450, 70, 'black', array(
            0,
            0,
            0,
            0
        ));
        $imageData = $bobj->getPngData();
        $timestamp = time();
        file_put_contents(__DIR__ . '/' . strval($postId) . '.png', $imageData);

//        <div class="result-heading">Output:</div>
        /*        <img src="<?php echo $targetPath . $timestamp; ?>.png">*/
    }

}