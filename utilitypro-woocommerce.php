<?php
   /*
   Plugin Name: Utility Pro - WooCommerce
   Plugin URI: http://chrismcintosh.me
   Description: This plugin integrates WooCommerce and the Utility Pro Theme
   Version: 0.1
   Author: Chris Mcintosh
   Author URI: http://chrismcintosh.me
   License: GPL2
   */

    /* Enqueue Styles */
    add_action('wp_enqueue_scripts', 'utilitypro_woocommerce_styles');
    function utilitypro_woocommerce_styles() {
        wp_enqueue_style( 'utilitypro-woocommerce', plugins_url( 'utilitypro-woocommerce.css', __FILE__ ) );
    }


    //Add Account Settings and Cart Indicator Bar After Header
    add_action('genesis_header_right', 'up_cart_indicator');
    function up_cart_indicator() {
    	?>
            <div class="up-cart-indicator">
                <a class="cart-contents button" >
                </a>
            </div>
        <?php

    }



    // Ajax cart button in header
    	add_filter('add_to_cart_fragments', 'sby_woo_cart_contents');
    	function sby_woo_cart_contents( $fragments ) {
    		global $woocommerce;
    		ob_start();

    		?>
    			<a class="cart-contents button" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart'); ?>">
    				<i class="fa fa-shopping-cart"></i>
    				<?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count), $woocommerce->cart->cart_contents_count);?>
    				- <?php echo $woocommerce->cart->get_cart_total(); ?>
    			</a>
    		<?php

    		$fragments['a.cart-contents'] = ob_get_clean();
    		return $fragments;
    	}





        add_filter( 'woocommerce_enqueue_styles', '__return_false' );


        /**
         * WooCommerce Extra Feature
         * --------------------------
         *
         * Change number of related products on product page
         * Set your own value for 'posts_per_page'
         *
         */
        // add_filter( 'woocommerce_output_related_products_args', 'jk_related_products_args' );
        //   function jk_related_products_args( $args ) {
        // 	$args['posts_per_page'] = 4; // 4 related products
        // 	$args['columns'] = 4; // arranged in 2 columns
        // 	return $args;
        // }


?>
