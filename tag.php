<?php
/**
 * The template for displaying tag
 *
 * @link https://codex.wordpress.org/Taxonomies
 *
 * @package myclassictheme
 *
 */
get_header();
?>
    <section id="primary">
        <div class="container">
            <div class="row mar-top-20">
                <div class="col-md-12">
                    <h5><?php echo ucfirst( single_tag_title() ); ?></h5>
					<?php if ( ! empty( tag_description() ) ) : ?>
						<?php echo tag_description(); ?>
					<?php endif; ?>
					<?php if ( have_posts() ): while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'template-parts/content', get_post_format() ); ?>
					<?php endwhile; ?>
					<?php else: ?>
                        <div class="col-md-12">
                            <h2 style="padding:100px;">
								<?php _e( 'Sorry, there are no posts in this tag', 'myclassictheme' ); ?></h2>
                        </div>
					<?php endif; ?>
                </div>
            </div>
        </div><!--.container-->
    </section><!--#primary -->
    <div class="row mar-bot-30"></div>
<?php get_footer();
