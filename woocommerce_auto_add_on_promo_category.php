<?php

/**
 * Plugin Name: InCuca Tech - Woocommerce auto add on promo category
 * Plugin URI: https://github.com/paulodanieldev/woocommerce_auto_add_on_promo_category
 * Description: Adiona ou remove o produto da categoria de promoção de acordo com valor do campo "valor promocional", se estiver vazio remove da categoria promoções, caso contrário adiciona.
 * Author: InCuca Tech
 * Author URI: https://incuca.net
 * Version: 1.0.0
 * Tested up to: 5.5.6
 * License: GNU General Public License v3.0
 *
 * @package Aaopc_For_WooCommerce
 */

defined('ABSPATH') or exit;

define( 'WC_AAOPC_VERSION', '1.0.0' );
define( 'WC_AAOPC_PLUGIN_FILE', __FILE__ );

if ( ! class_exists( 'WC_AAOPC' ) ) {
	include_once dirname( __FILE__ ) . '/includes/class-wc-aaopc.php';
	add_action( 'plugins_loaded', array( 'WC_AAOPC', 'init' ) );
}