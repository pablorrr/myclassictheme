<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package myclassictheme
 */
get_header(); ?>
    <section id="content" class="content-area col-sm-12 col-lg-8">
        <main id="main" class="site-main" role="main">
			<?php
			if ( have_posts() ) : ?>
                <header class="page-header">
					<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="archive-description">', '</div>' );
					?>
                </header><!-- .page-header -->
				<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post();
					get_template_part( 'template-parts/content', get_post_format() );

				endwhile;
				the_posts_navigation();
			else :
				get_template_part( 'template-parts/content', 'none' );
			endif;
			?>
        </main><!-- #main -->
    </section><!-- #primary -->
<?php
get_footer();
