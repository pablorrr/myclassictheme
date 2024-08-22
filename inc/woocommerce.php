<?php
/**
 * Add WooCommerce support
 * @package myclassictheme
 */



add_action( 'after_setup_theme', 'myclassictheme_woocommerce_support' );
if ( ! function_exists( 'myclassictheme_woocommerce_support' ) ) {
	/**
	 * Declares WooCommerce theme support.
	 */
	function myclassictheme_woocommerce_support() {
		add_theme_support( 'woocommerce' );

		// Add New Woocommerce 3.0.0 Product Gallery support
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-slider' );


	}
}

/**
 * Change number of products per row to default  3
 * source : https://docs.woocommerce.com/document/change-number-of-products-per-row/
 *
 */

add_filter( 'loop_shop_columns', 'myclassictheme_loop_columns', 20, 1 );
if ( ! function_exists( 'myclassictheme_loop_columns' ) ) {
	function myclassictheme_loop_columns( $prod_per_row ) {
		$prod_per_row = get_option( 'prdt_count_per_row' );

		return $prod_per_row ? $prod_per_row : 3;
	}
}


/**
 * Change number of products per page (pagination)
 * source : https://docs.woocommerce.com/document/change-number-of-products-displayed-per-page/
 */

add_filter( 'loop_shop_per_page', 'myclassictheme_loop_columns_products_count_per_page', 30, 1 );
if ( ! function_exists( 'myclassictheme_loop_columns_products_count_per_page' ) ) {
	function myclassictheme_loop_columns_products_count_per_page( $prod_per_page ) {
		$prod_per_page = get_option( 'prdt_count_per_page' );

		return $prod_per_page ? $prod_per_page : 4;
	}
}
/**
 *
 * woocommerce docs source online :https://docs.woocommerce.com/document/adding-a-section-to-a-settings-tab/
 */

add_filter( 'woocommerce_get_sections_products', 'myclassictheme_products_display_setup' );
function myclassictheme_products_display_setup( $sections ) {

	$sections['wcproddissetup'] = __( 'Products display setup', 'myclassictheme' );

	return $sections;

}

/**
 * Add settings to the specific section we created before
 * To retrive option val use:get_option( 'id_name_of_field' )
 * https://docs.woocommerce.com/document/adding-a-section-to-a-settings-tab/
 */
add_filter( 'woocommerce_get_settings_products', 'myclassictheme_wcslider_all_settings', 10, 2 );
function myclassictheme_wcslider_all_settings( $settings, $current_section ) {
	/**
	 * Check the current section is what we want
	 **/
	if ( $current_section == 'wcproddissetup' ) {
		$settings_display_products = array();

		// Add text field option - Display products number per row
		$settings_display_products[] = array(
			'name'     => __( 'Display products number per row', 'myclassictheme' ),
			'desc_tip' => __( 'Type max number of products to display per row ', 'myclassictheme' ),
			'id'       => 'prdt_count_per_row',
			'type'     => 'text',
			'css'      => 'min-width:300px;',
			'desc'     => __( 'Max number of products per row', 'myclassictheme' ),
		);
		// Add text field option - Display products number per page
		$settings_display_products[] = array(
			'name'     => __( 'Display products number per page', 'myclassictheme' ),
			'desc_tip' => __( 'Type number of products to display per page ', 'myclassictheme' ),
			'id'       => 'prdt_count_per_page',
			'type'     => 'text',
			'css'      => 'min-width:300px;',
			'desc'     => __( 'Number of products per page', 'myclassictheme' ),
		);


		$settings_display_products[] = array( 'type' => 'sectionend', 'id' => 'wcproddissetup' );

		return $settings_display_products;

		/**
		 * If not, return the standard settings
		 **/
	} else {
		return $settings;
	}
}


/**
 * Display category image on category archive
 * source :https://docs.woocommerce.com/document/woocommerce-display-category-image-on-category-archive/
 */

add_action( 'woocommerce_archive_description', 'myclassictheme_woocommerce_category_image', 2 );
function myclassictheme_woocommerce_category_image() {
	if ( is_product_category() ) {
		global $wp_query;
		$cat          = $wp_query->get_queried_object();
		$thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
		$image        = wp_get_attachment_url( $thumbnail_id );
		if ( $image ) {
			echo '<img src="' . $image . '" alt="' . $cat->name . '" />';
		}
	}
}

/*
 * Display on cart page link to shop page at the bottom
 *
 */
add_action( 'woocommerce_after_cart', 'myclassictheme_add_link_shop' );

function myclassictheme_add_link_shop() {

	if ( ! is_cart() ) {
		echo '<a style="font-size:1.2em;" 
									href="' . esc_url( wc_get_page_permalink( 'cart' ) ) . '" >' . __( 'Go to Cart page',
				'myclassictheme' ) . '
								<i class="fa fa-shopping-cart"></i></a>';
	}
	if ( ! is_shop() ) {
		echo '<a style="font-size:1.2em;"  
								href="' . esc_url( wc_get_page_permalink( 'shop' ) ) . '" >' . __( 'Go to Shop page',
				'myclassictheme' ) . '
								<i class="fa fa-shopping-bag"></i></a>';
	}

}

/*
 * Display shop link in product page with icon
 *
 */
add_action( 'woocommerce_after_single_product', 'myclassictheme_display_shop_page_link', 5 );

function myclassictheme_display_shop_page_link() {

	echo '<button class="btn btn-primary"><a style="font-size:1.2em;"  
								href="' . esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ) . '" >Go to Shop page
								<i class="fa fa-shopping-bag "></i></a></button>';
}

add_action( 'woocommerce_after_single_product', 'myclassictheme_display_meta_link', 6 );

function myclassictheme_display_meta_link() {
	//get meta value : mozna uzyc :get_the_ID(), nie korzytsac z $post->ID
	global $product;
	$hyperLink      = get_post_meta( $product->get_id(), '_hyperlink_meta_value_key', true );
	$blankAttr      = '_blank';
	$ltrimHyperlink = ltrim( $hyperLink, 'http://' );
	printf( '<p><a href="%1$s" target="%2$s">%3$s</a></p>',
		esc_url( $hyperLink ), esc_attr( $blankAttr ), esc_html( $ltrimHyperlink ) );

}


/*
 * Print title on single product page at  top
 *
 */

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
add_action( 'woocommerce_before_single_product', 'woocommerce_template_single_title', 15 );


/**
 * @snippet Remove the Postcode Field on the WooCommerce Checkout
 * @how-to Get CustomizeWoo.com FREE
 * @sourcecode https://businessbloomer.com/?p=461
 * @author Rodolfo Melogli
 * @testedwith WooCommerce 3.5.1
 */
//https://www.businessbloomer.com/woocommerce-disable-postcodezip-field-checkout-page/
add_filter( 'woocommerce_checkout_fields', 'myclassictheme_remove_billing_postcode_checkout' );

function myclassictheme_remove_billing_postcode_checkout( $fields ) {
	unset( $fields['billing']['billing_postcode'] );

	return $fields;
}
