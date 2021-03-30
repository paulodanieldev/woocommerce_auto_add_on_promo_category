<?php
/**
 * AAOPC Integration.
 *
 * @package Pwc_For_WooCommerce
 */
if (! class_exists ( 'WC_Methods_AAOPC' )):
class WC_Methods_AAOPC extends WC_Integration {
	/**
	 * Init and hook in the integration.
	 */
	
	private $aaopc_category_name            = null;
	public function __construct() {
		$this->id                 	        = 'aaopc';
		$this->aaopc_promo_category_name    = $this->get_option( 'aaopc_promo_category_name' );
    }
    
    public function get_aaopc_promo_category_name(){
        return $this->aaopc_promo_category_name;
    }

    public function change_product_promo_category( $product_id ) {
        // if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        //     return $product_id;
        // }
    
        // verifica se o usuário tem permissão para editar este produto
        if ( ! current_user_can( 'edit_product', $product_id ) ) {
            return $product_id;
        }
    
        //verifica se o produto está publicado e se existe a variável _sale_price
        if( get_post_status( $product_id ) == 'publish') {
            $product = wc_get_product( $product_id );
            $regular_price = empty($product->get_regular_price()) ? 0 : (float)$product->get_regular_price();
            $sale_price = empty($product->get_sale_price()) ? 0 : (float)$product->get_sale_price();
            
            if (!empty($this->aaopc_promo_category_name)){
                $promo_cat = $this->aaopc_promo_category_name;
                if ($sale_price != $regular_price){
                    if( $sale_price > 0 && ! has_term( $promo_cat, 'product_cat', $product_id ) ){
                        wp_set_object_terms($product_id, $promo_cat, 'product_cat', true );
                    }else if( $sale_price <= 0 && has_term( $promo_cat, 'product_cat', $product_id ) ){
                        wp_remove_object_terms($product_id, $promo_cat, 'product_cat');
                    }
                }
            }
        }
    }
}
endif ;