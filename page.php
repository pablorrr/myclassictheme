<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package myclassictheme
 */

if ( ! function_exists( 'is_plugin_active' ) ) {
	require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
}

if ( class_exists( 'woocommerce' ) && is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
	if ( is_cart() || is_account_page() || is_checkout() || is_product() ) {
		get_header( 'woo' );
	} else {
		get_header();
	}
} elseif ( ! class_exists( 'woocommerce' ) && ! is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
	get_header();
}
?>
    <div id="content" class="container">

        <div class="row mx-auto m-single">
            <section id="primary" class="content-area col-sm-12 col-lg-8">
                <main id="main" class="site-main" role="main">
					<?php
					while ( have_posts() ) : the_post();
						get_template_part( 'template-parts/content', 'page' );
						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;
					endwhile; // End of the loop.
					?>
                </main><!-- #main -->
            </section><!-- #primary -->
			<?php get_sidebar(); ?>
        </div><!--.row .mx-auto .m-single-->
    </div><!--#content -->
<?php
get_footer();
