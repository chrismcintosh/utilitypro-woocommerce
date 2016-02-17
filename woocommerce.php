<?php

/*
 Woocommerce template
 */

 //Remove Woo Commerce Styles
 add_filter( 'woocommerce_enqueue_styles', '__return_false' );

 // Full width product pages
  	add_filter('genesis_pre_get_option_site_layout', 'product_full_width');
  	function product_full_width($layout) {
  		if (is_product()) {
  			$layout = 'full-width-content';
  			return $layout;
  		}
  	}

// Replace the loop
    remove_action( 'genesis_loop', 'genesis_do_loop' );
    add_action( 'genesis_loop', 'child_theme_do_loop' );

    function child_theme_do_loop() {
      if ( function_exists( 'woocommerce_content') ) {
        woocommerce_content();
      }
    }

    // remove page title
       //  if ( is_product_category() ) {
       //    add_filter( 'woocommerce_show_page_title', '__return_false' );
       //  }


       // Ajax cart button in header
       	add_filter('add_to_cart_fragments', 'up_woo_cart_contents');
       	function up_woo_cart_contents( $fragments ) {
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




genesis();
