<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package myclassictheme
 */

get_header(); ?>

<section id="primary" class="content-area col-sm-12 col-lg-8">
    <main id="main" class="site-main" role="main">
        <section class="error-404 not-found">
            <header class="page-header">
                <h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.',
						'myclassictheme' ); ?></h1>
            </header><!-- .page-header -->

            <div class="page-content">
                <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?',
						'myclassictheme' ); ?></p>
            </div><!-- .page-content -->
        </section><!-- .error-404 -->

    </main><!-- #main -->
</section><!-- #primary -->

<?php get_footer(); ?>
