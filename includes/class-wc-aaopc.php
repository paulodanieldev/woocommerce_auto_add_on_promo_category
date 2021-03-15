<?php
/**
 * Plugin's main class
 *
 * @package Pwc_For_WooCommerce
 */

/**
 * WooCommerce bootstrap class.
 */
class WC_AAOPC {

	/**
	 * Initialize the plugin public actions.
	 */
	public static function init() {
		// Checks if WooCommerce is installed.
		if ( class_exists( 'WC_Payment_Gateway' ) ) {
			self::includes();
			
			add_filter( 'plugin_action_links_' . plugin_basename( WC_AAOPC_PLUGIN_FILE ), array( __CLASS__, 'plugin_action_links' ) );

			// Register the integration.
			add_filter( 'woocommerce_integrations', array( __CLASS__, 'add_integration' ) );

            // muda categoria ao editar um produto
            add_action('save_post_product', array( __CLASS__, 'ic_change_product_promo_category'));
            
        } else {
			add_action( 'admin_notices', array( __CLASS__, array( __CLASS__, 'woocommerce_missing_notice' )) );
		}
	}


	/**
     * Add a new integration to WooCommerce.
     */
    public static function add_integration( $integrations ) {
		$integrations[] = 'WC_Integration_AAOPC';
		return $integrations;
	}

	/**
	 * Action links.
	 *
	 * @param array $links Action links.
	 *
	 * @return array
	 */
	public static function plugin_action_links( $links ) {
		$plugin_links   = array();
		$plugin_links[] = '<a href="' . esc_url( admin_url( 'admin.php?page=wc-settings&tab=integration&section=aaopc' ) ) . '">Configuração</a>';

		return array_merge( $plugin_links, $links );
	}

	/**
	 * Includes.
	 */
	private static function includes() {
		include_once dirname( __FILE__ ) . '/class-wc-aaopc-integration.php';
		include_once dirname( __FILE__ ) . '/class-wc-aaopc-methods.php';
	}

	/**
	 * WooCommerce missing notice.
	 */
	public static function woocommerce_missing_notice() {
		include dirname( __FILE__ ) . '/admin/views/html-notice-missing-woocommerce.php';
	}

    // QUANDO EDITA UM PRODUTO
    public static function ic_change_product_promo_category( $product_id ) {
        $aaopc_methods = new WC_Methods_AAOPC();
        $aaopc_category_name_var = $aaopc_methods->change_product_promo_category( $product_id );
    }

}

