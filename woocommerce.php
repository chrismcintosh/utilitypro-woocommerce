<?php

/*
 Woocommerce template
 */

 /**************************************
        Remove Default Woo Styles
 ***************************************/
 add_filter( 'woocommerce_enqueue_styles', '__return_false' );





 /**************************************
    Force Product Pages Full Width
 ***************************************/
  	add_filter('genesis_pre_get_option_site_layout', 'product_full_width');
  	function product_full_width($layout) {
  		if (is_product()) {
  			$layout = 'full-width-content';
  			return $layout;
  		}
  	}





/**************************************
        Replace The Genesis Loop
***************************************/
    remove_action( 'genesis_loop', 'genesis_do_loop' );
    add_action( 'genesis_loop', 'child_theme_do_loop' );

    function child_theme_do_loop() {
      if ( function_exists( 'woocommerce_content') ) {
        woocommerce_content();
      }
    }





/**************************************
           Remove Page Title
***************************************/

    // remove page title
       //  if ( is_product_category() ) {
       //    add_filter( 'woocommerce_show_page_title', '__return_false' );
       //  }



/**************************************
           Ajax Cart Update
***************************************/
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




/**************************************
            Product Overlay
***************************************/
    // Add overlay on product loops
    add_action('woocommerce_before_shop_loop_item', 'up_add_overlay_start', 1);
    function up_add_overlay_start() {
    	echo '<div class="product-img-wrapper">';
    }

    // Add overlay on product loops end
    add_action('woocommerce_before_shop_loop_item', 'up_add_overlay_end', 10);
    function up_add_overlay_end() {
    		echo '<div class="product-overlay">';
    			echo '<div class="overlay-wrap">';
    				woocommerce_template_loop_add_to_cart();
    			echo '</div>';
    			echo '<a href="'.get_permalink().'" class="overlay-link"></a>';
    			woocommerce_template_loop_rating();
    		echo '</div>';
    	echo '</div>';
    }

    remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
    add_action( 'woocommerce_before_shop_loop_item', 'woocommerce_show_product_loop_sale_flash', 5 );

    remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
    add_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_thumbnail', 5 );


    // Move the product rating display on product loops
    remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

    // Move the add to cart button on product loops
    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );







genesis();
