<?php
/**
 * Template Name:First Page
 * @package myclassictheme
 *
 */

get_header(); ?>
    <div id="load-posts">
        <div id="content" class="row">
            <div class="col-md-12">
				<?php
				if ( have_posts() ):
					while ( have_posts() ): the_post();
						get_template_part( 'template-parts/content', get_post_format() );

					endwhile;
					the_posts_navigation();
				else :
					get_template_part( 'template-parts/content', 'none' );
				endif;
				?>
            </div><!-- .col -->

        </div><!-- .row -->
    </div><!--#load-post .container -->
<?php get_footer();
