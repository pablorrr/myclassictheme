<?php
/**
 * ENQUEUE SCRIPTS AND STYLES.
 *
 * @package myclassictheme
 */


function myclassictheme_scripts() {

	// load theme and Bootstrap CSS  conditionally     -
	if ( ! is_admin() ) {

		//load Bootstrap Css
		wp_enqueue_style( 'myclassictheme-bootstrap',
			get_template_directory_uri() . '/assets/css/bootstrap.css' );
		// load theme styles
		wp_enqueue_style( 'myclassictheme-css',
			get_template_directory_uri() . '/assets/css/myclassictheme.css', array(), '1.0',
			false );
	}

// -----------------------------------------------
// load dashicon WP style, Jquery, HTML5 support     -
// -----------------------------------------------

	wp_enqueue_style( 'dashicons' );
	wp_enqueue_script( 'jquery' );


// ---------------------------------------------------
// load Bootstrap Jquery, Theme Jquery conditionally    -
// --------------------------------------------------

	if ( ! is_admin() ) {
		//fontawesome
		wp_enqueue_script( 'myclassictheme-fontawesome',
			get_template_directory_uri() . '/assets/js/fontawesome/fontawesome-all.js', array() );
		//fontawesome-V4
		wp_enqueue_script( 'myclassictheme-fontawesome-v4',
			get_template_directory_uri() . '/assets/js/fontawesome/fa-v4-shims.js', array() );
		//popper
		wp_enqueue_script( 'myclassictheme-popper', get_template_directory_uri() . '/assets/js/popper.js',
			array() );
		//theme's JS
		wp_enqueue_script( 'myclassictheme-theme-js',
			get_template_directory_uri() . '/assets/js/my-classic-wp-scripts.js', array() );


		//Bootstrap Jquery
		wp_enqueue_script( 'myclassictheme-bootstrap-js',
			get_template_directory_uri() . '/assets/js/bootstrap.js' );
		// popover shortcode effect
		wp_enqueue_script( 'myclassictheme-popover-tootlip',
			get_template_directory_uri() . '/assets/js/popover-tootlip.js', array( 'jquery' ), '', true );
		// popper shortcode effect
		wp_enqueue_script( 'myclassictheme-popper', get_template_directory_uri() . '/assets/js/popper.js',
			array( 'jquery' ), '', true );

	}

	// -

// ---------------------------------------------------
//  thread comments support  -
// --------------------------------------------------

	if ( is_single() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'myclassictheme_scripts' );

// ---------------------------------------------
// remove WooCommerce css style when is unnecessary     -
// source: https://crunchify.com/how-to-stop-loading-woocommerce-js-javascript-and-css-files-on-all-wordpress-postspages/
// ---------------------------------------------


add_action( 'wp_enqueue_scripts', 'myclassictheme_disable_woocommerce_loading_css_js' );

function myclassictheme_disable_woocommerce_loading_css_js() {

	// Check if WooCommerce plugin is active
	if ( function_exists( 'is_woocommerce' ) ) {

		// Check if it's any of WooCommerce page
		if ( ! is_woocommerce() && ! is_cart() && ! is_checkout() ) {

			## Dequeue WooCommerce styles
			wp_dequeue_style( 'woocommerce-layout' );
			wp_dequeue_style( 'woocommerce-general' );
			wp_dequeue_style( 'woocommerce-smallscreen' );

			## Dequeue WooCommerce scripts
			wp_dequeue_script( 'wc-cart-fragments' );
			wp_dequeue_script( 'woocommerce' );
			wp_dequeue_script( 'wc-add-to-cart' );

		}
	}
}
