<?php
/**
 * The template for displaying the footer
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package myclassictheme
 */
?>
<footer style="background-color: #9e9e9e" id="footer">
    <div class="container-fluid">
        <!-- scroll page angle -->
        <div class="row">
            <div style="margin-bottom:1em;" class="col-sm-12 col-md-4">
                <h2><?php _e( 'Opening hours', 'myclassictheme' ); ?></h2>
                <ul class="list-group list-unstyled" style="font-size:12pt;">
                    <li class="list-group-item"><?php _e( 'Monday  ', 'myclassictheme' );
						echo esc_html( get_theme_mod( 'monday_text_block' ) ); ?></li>
                    <li class="list-group-item"><?php _e( 'Tuesday  ', 'myclassictheme' );
						echo esc_html( get_theme_mod( 'tuesday_text_block' ) ); ?></li>
                    <li class="list-group-item"><?php _e( 'Thursday  ', 'myclassictheme' );
						echo esc_html( get_theme_mod( 'thursday_text_block' ) ); ?></li>
                    <li class="list-group-item"><?php _e( 'Friday  ', 'myclassictheme' );
						echo esc_html( get_theme_mod( 'friday_text_block' ) ); ?></li>
                    <li class="list-group-item"><?php _e( 'Saturday  ', 'myclassictheme' );
						echo esc_html( get_theme_mod( 'saturday_text_block' ) ); ?></li>
                    <li class="list-group-item"><?php _e( 'Sunday  ', 'myclassictheme' );
						echo esc_html( get_theme_mod( 'sunday_text_block' ) ); ?></li>
                </ul>
            </div>

            <div style="margin-bottom:1em;" class="col-sm-12 col-md-4">
                <h2><?php _e( 'Social media', 'myclassictheme' ); ?></h2>
                <ul class="social-buttons list-unstyled">
                    <li>
                        <a class="btn btn-block btn-social btn-twitter"
                           href="https://twitter.com/explore" target="_blank">
                            <i class="fa fa-twitter"></i><?php _e( 'Sign in with Twitter',
								'myclassictheme' ); ?>
                        </a>
                    </li>
                    <li>
                        <a class="btn btn-block btn-social btn-facebook"
                           href="https://pl-pl.facebook.com/" target="_blank">
                            <i class="fa fa-facebook"></i>
							<?php _e( 'Sign in with Facebook', 'myclassictheme' ); ?>
                        </a>
                    </li>
                    <li>
                        <a class="btn btn-block btn-social btn-google"
                           href="https://www.youtube.com/" target="_blank">
                            <i class="fa fa-youtube"></i><?php _e( 'Sign in with Youtube',
								'myclassictheme' ); ?>
                        </a>
                    </li>

                </ul><!-- .social-buttons .list-unstyled -->
            </div><!--.col-md-4-->

            <div style="margin-bottom:1em;" class="col-sm-12 col-md-4">
				<?php if ( function_exists( 'wp_tag_cloud' ) ) :
					$args = array( 'public' => true, '_builtin' => false );
					$taxonomies = get_taxonomies( $args );
					if ( isset ( $taxonomies ) ) {
						$taxonomies = array_values( $taxonomies );
					}
					$first_tax  = ! empty( $taxonomies[0] ) ? $taxonomies[0] : 'category';
					$second_tax = ! empty( $taxonomies[1] ) ? $taxonomies[1] : 'post_tag'; ?>

                    <h2><?php _e( 'Popular tags and categories', 'myclassictheme' ); ?></h2>
                    <ul class="list-group list-unstyled tagcloud">
                        <li class="list-group-item">
							<?php //display Wordpress Tag Cloud
							wp_tag_cloud( array(
								'smallest'  => 13,
								'largest'   => 26,
								'unit'      => 'pt',
								'number'    => 45,
								'format'    => 'flat',
								'separator' => "\n",
								'orderby'   => 'name',
								'order'     => 'ASC',
								'exclude'   => '',
								'include'   => '',
								'link'      => 'view',
								'taxonomy'  => $first_tax,
							) ); ?>
                        </li>
                    </ul>
                    <ul class="list-group list-unstyled tagcloud">
                        <li class="list-group-item">
							<?php wp_tag_cloud( array(
								'smallest'  => 13,
								'largest'   => 20,
								'unit'      => 'pt',
								'number'    => 45,
								'format'    => 'flat',
								'separator' => "\n",
								'orderby'   => 'name',
								'order'     => 'DESC',
								'exclude'   => '',
								'include'   => '',
								'link'      => 'view',
								'taxonomy'  => $second_tax,
							) );
							?>
                        </li>
                    </ul>
				<?php endif; ?>
            </div><!-- .col-md-4 -->
        </div><!-- .row -->
        <!--widget zone-->
        <div class="row">
            <div class="col-sm-12 col-md-4">
				<?php dynamic_sidebar( 'footer-1' ); ?>
            </div>

            <div class="col-sm-12 col-md-4">
				<?php dynamic_sidebar( 'footer-2' ); ?>
            </div>

            <div class="col-sm-12 col-md-4">
				<?php dynamic_sidebar( 'footer-3' ); ?>
            </div>
        </div>
        <!-- login, search - row -->
        <div class="row">
            <div class="col-sm-12 col-md-4">
				<?php get_search_form(); ?>
            </div>
            <div class="col-sm-12 col-md-4">
				<?php if ( ( ( ! is_user_logged_in() ) && ( is_front_page() ) ) || ( ( ! is_user_logged_in() )
				                                                                     && ( is_single() ) ) ): ?>
                    <h5><a href="<?php echo wp_login_url( home_url() ); ?>" title="Login">
							<?php _e( 'Log in', 'myclassictheme' ); ?></a></h5>

				<?php else: ?>
                    <ul class="list-inline">
                        <li>
                            <h5>
                                <a href="<?php echo wp_logout_url(); ?>"><?php _e( 'Log out',
										'myclassictheme' ); ?></a>
                            </h5>
                        </li>

                        <li>
                            <h5><a target="_blank" href="<?php echo admin_url(); ?>" title="Admin">
									<?php _e( 'Go to admin panel here', 'myclassictheme' ); ?></a>
                            </h5>
                        </li>
                    </ul>
				<?php endif; ?>
            </div>
            <div class="col-sm-12 col-md-4">
                <h5><?php echo esc_html__( 'telephone number:   ', 'myclassictheme' );
					echo esc_html( get_theme_mod( 'tel_text_block' ) ); ?></h5>
            </div>
        </div><!-- .row (login)-->

        <div class="row justify-content-end">
            <div class="col-sm-12 col-md-12">
                <h5>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>"
                       title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
						<?php echo get_bloginfo( 'name', 'display' ); ?>
                    </a>
                </h5>
            </div>
        </div>
    </div><!--.container-fluid-->
    </div><!--.wp site-blocks-->
	<?php wp_footer(); ?>

</footer>

</body>
</html>
