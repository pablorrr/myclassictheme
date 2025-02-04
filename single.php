<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @link https://developer.wordpress.org/themes/template-files-section/post-template-files/
 *
 * @package  myclassictheme
 *
 */
get_header();
?>
    <div id="content" class="container">
        <div class="row mx-auto m-single">
            <section id="primary" class="content-area col-sm-12 col-md-8 col-lg-8">
                <main id="main" class="site-main" role="main">
					<?php while ( have_posts() ) : the_post();
						get_template_part( 'template-parts/content' );
						if ( is_single() && comments_open() ) {
							comments_template( '', true );
						} elseif ( is_user_logged_in() ) {
							printf( wp_kses( __( 'Comments are disabled (for new posts )go to admin panel to change it(settings->discuss) <a href="%1$s" target="%2$s">enable comments please here</a>.',
								'myclassictheme' ),
								array( 'a' => array( 'href' => array(), 'target' => array() ) ) ),
								esc_url( admin_url( 'options-discussion.php' ) ), '_blank' );
						} ?>
					<?php endwhile; ?>
                </main><!--#main-->
            </section><!--#primary-->
			<?php get_sidebar(); ?>
        </div><!--.row .mx-auto .m-single -->
    </div><!--.container-->
<?php
get_footer();
