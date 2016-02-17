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











?>
