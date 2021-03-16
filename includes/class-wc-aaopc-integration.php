<?php
/**
 * AAOPC Integration.
 *
 * @package Aaopc_For_WooCommerce
 */
if (! class_exists ( 'WC_Integration_AAOPC' )):
class WC_Integration_AAOPC extends WC_Integration {
	/**
	 * Init and hook in the integration.
	 */
	
	public function __construct() {
		global $woocommerce;
		$this->id                 = 'aaopc';
		$this->method_title       = __( 'InCuca Tech - Woocommerce auto add on promo category', 'aaopc-integration' );
		$this->method_description = __( 'Os campos abaixo são utilizados para configurar o plugin', 'aaopc-integration' );
		// Load the settings.
		$this->init_form_fields();
		$this->init_settings();
		// Define user set variables.
		$this->aaopc_promo_category_name	= $this->get_option( 'aaopc_promo_category_name' );

		// Actions.
		add_action('woocommerce_update_options_integration_' . $this->id, array($this, 'process_admin_options'));
	}
	/**
	 * Initialize integration settings form fields.
	 */
	public function init_form_fields() {
		$this->form_fields = array(
			'aaopc_promo_category_name' => array(
				'title'             => __( 'Slug da categoria de promoções', 'aaopc-integration' ),
				'type'              => 'text',
				'label'             => __( 'Slug da categoria de promoções', 'aaopc-integration' ),
				'default'           => '',
				'description'       => __( 'Entre com o nome da categoria de promoções.', 'aaopc-integration' ),
				'desc_tip'          => true
			)
		);

	}

}
endif ;