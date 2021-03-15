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
        //     return $post_id;
        // }
    
        // verifica se o usuário tem permissão para editar este produto
        if ( ! current_user_can( 'edit_product', $post_id ) ) {
            return $post_id;
        }
    
        //verifica se o produto está publicado e se existe a cariável _sale_price
        if( get_post_status( $post_id ) == 'publish' && isset($_POST['_sale_price']) ) {
            $sale_price = $_POST['_sale_price'];

            $promo_cat = !empty($this->aaopc_promo_category_name) ? $this->aaopc_promo_category_name : 'on_sale';

            if( $sale_price >= 0 && ! has_term( $promo_cat, 'product_cat', $product_id ) ){
                wp_set_object_terms($product_id, $promo_cat, 'product_cat', true );
            }else{
                wp_remove_object_terms($product_id, $promo_cat, 'product_cat');
            }
        }
    }
}
endif ;