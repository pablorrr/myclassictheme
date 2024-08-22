<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package myclassictheme
 */
get_header();
?>
    <div class="container">
        <div id="load-posts" class="row mx-auto m-single">
            <section id="primary" class="content-area col-sm-12 col-md-8 col-lg-8">
                <main id="main" class="site-main" role="main">

					<?php if ( have_posts() ) : ?>

                        <header class="page-header">
                            <h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s',
									'myclassictheme' ),
									'<span>' . get_search_query() . '</span>' ); ?></h1>
                        </header><!-- .page-header -->

						<?php
						/* Start the Loop */
						while ( have_posts() ) : the_post();
							get_template_part( 'template-parts/content', 'search' );

						endwhile;
						the_posts_navigation();
					else :
						get_template_part( 'template-parts/content', 'none' );
					endif; ?>
                </main><!-- #main -->
            </section><!-- #primary -->
			<?php get_sidebar(); ?>
        </div><!--.row .mx-auto .m-single -->
    </div><!--.container -->
<?php
get_footer();
