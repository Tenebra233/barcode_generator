<?php
/*
  Plugin Name: Barcode generator
  Plugin URI:
  Description: Generates products barcode
  Author: ITRO Team(c)
  E-mail: info@itroteam.com
  Version: 1.0
  Author URI: http://www.itroteam.com/
  Text Domain: itro_ipp
  License: GPLv2 or later
  License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

//use Itro\WpUpdaterClient\Updater;
use Itro\BarcodeGenerator\BarcodeGenerator;

require_once('autoloader/autoloader.php');
require_once "vendor/autoload.php";

add_action('init', function () {
    //    $updater = new Updater('itro-popup-premium', 'ITRO Popup Premium');
    //    $updater->boot();
    define('itroPopupPremiumRootPath', basename(dirname(__FILE__)) . "/");
    define('itroPopupPremiumPath', plugins_url() . '/' . itroPopupPremiumRootPath);
    //    load_plugin_textdomain('itro_ipp', FALSE, itroPopupPremiumRootPath . 'i18n');
});

add_action('woocommerce_loaded', function () {
    if (!class_exists(WooCommerce::class)) {
        return;
    }
    BarcodeGenerator::getInstance()->boot();

});