<?php
/**
 * Template part for displaying page content
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package myclassictheme
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="entry-content">
        <?php
        the_content();
        wp_link_pages(array(
            'before' => '<div class="page-links">'.esc_html__('Pages:', 'myclassictheme'),
            'after' => '</div>',
        ));
        ?>
    </div><!-- .entry-content -->
</article><!-- #post-## -->
