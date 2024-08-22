<?php
/**
 * Backwards compatibility
 *
 * @package myclassictheme
 */


/**
 * Check if the WordPress version is 6.0 or higher, and if the PHP version is at least 7.4.
 * If not, do not activate.
 */


function myclassictheme_upgrade_notice() {
	/* translators: %1$s: WordPress version. %2$s PHP version.*/
	$message = sprintf( esc_html__( 'Highly recommended Wordpress 6.0 version. You are running WordPress version %1$s. Please upgrade and try again.',
		'myclassictheme' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );
}


if ( version_compare( $GLOBALS['wp_version'], '6.0-RC4-53425', '<' ) ) {
	add_action( 'admin_notices', 'myclassictheme_upgrade_notice' );

	return;
}
