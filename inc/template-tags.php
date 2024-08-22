<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package myclassictheme
 */

if ( ! function_exists( 'myclassictheme_comments_feed_template_callback' ) ) :
	/**
	 * Template for comments and pingbacks.
	 *
	 * Used as a callback by wp_list_comments() for displaying the comments.
	 */
	/* comments form callback function */

	function myclassictheme_comments_feed_template_callback( $comment, $args, $depth ) {
		$GLOBAL['comment'] = $comment;
		?> <br>
        <div class="row media">
            <a href="<?php get_comment_author_url(); ?>" class="pull-left"></a>
            <div class="col-md-12 media-body">
                <h5 class="media-heading">
                    <a href="<?php get_comment_author_url(); ?>"><?php echo get_comment_author(); ?></a>
                    <small><?php comment_date(); ?> at <?php comment_time(); ?></small>
                </h5>
                <br>
				<?php comment_text(); ?>
				<?php comment_reply_link( array_merge( $args, array(
					'reply_text' => __( '<strong class="btn-lg fr-end-butt">Answer </strong><i class="icon-share-alt"></i>',
						'myclassictheme' ),
					'depth'      => $depth,
					'max_depth'  => $args['max_depth']
				) ) ); ?>
            </div>
        </div>
        <hr>
		<?php
	}

endif;
/* Modify link class into Bootstrap classs */
add_filter( 'comment_reply_link', 'myclassictheme_add_reply_link_class' );

function myclassictheme_add_reply_link_class( $class ) {
	$class = str_replace( "class='comment-reply-link", "class='btn btn-default pull-right", $class );

	return $class;
}

add_filter( 'preprocess_comment', 'myclassictheme_comment_limitation' );

/* limit comments char */
function myclassictheme_comment_limitation( $comment ) {
	if ( strlen( $comment['comment_content'] ) > 800 ) {
		wp_die( 'Comment is too long. Please keep your comment under 250 characters.' );
	}
	if ( strlen( $comment['comment_content'] ) < 60 ) {
		wp_die( 'Comment is too short. Please use at least 60 characters.' );
	}

	return $comment;
}

/* password protection for protected posts */
function myclassictheme_password_form() {
	global $post;
	$label = 'pwbox-' . ( empty( $post->ID ) ? rand() : $post->ID );
	$o     = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
    <div class="d-block mb-3">' . __( "To view this protected post, enter the password below:", "myclassictheme" ) . '</div>
    <div class="form-group form-inline">
    <label for="' . $label . '" class="mr-2">' . __( "Password:", "myclassictheme" ) . ' </label>
    <input name="post_password" id="' . $label . '" type="password" size="20" maxlength="20" class="form-control mr-2" /> 
    <input type="submit" name="Submit" value="' . esc_attr__( "Submit", "myclassictheme" ) . '" class="btn btn-primary"/>
    </div>
    </form>';

	return $o;
}

add_filter( 'the_password_form', 'myclassictheme_password_form' );

/* https://codex.wordpress.org/Dashboard_Widgets_API */

function myclassictheme_dashboard_widget() {
	wp_add_dashboard_widget(
		'myclassictheme_dashboard_widget',// Widget slug.
		'My Classic Theme Dashboard Widget',// Title.
		'myclassictheme_dashboard_widget_function'// Display function.
	);

    global $wp_meta_boxes;
	// Get the regular dashboard widgets array
	// (which has our new widget already but at the end)
	$normal_dashboard = $wp_meta_boxes['dashboard']['normal']['core'];
	// Backup and delete our new dashboard widget from the end of the array
	$myclassictheme_widget_backup = array( 'myclassictheme_dashboard_widget' => $normal_dashboard['myclassictheme_dashboard_widget'] );
	unset( $normal_dashboard['myclassictheme_dashboard_widget'] );

	// Merge the two arrays together so our widget is at the beginning
	$sorted_dashboard = array_merge( $myclassictheme_widget_backup, $normal_dashboard );
	// Save the sorted array back into the original metaboxes
	$wp_meta_boxes['dashboard']['normal']['core'] = $sorted_dashboard;
}

add_action( 'wp_dashboard_setup', 'myclassictheme_dashboard_widget' );

/**
 * Create the function to output the contents of our Dashboard Widget.
 */
function myclassictheme_dashboard_widget_function() {

	ob_start(); // outer buffer?>
    <ul class="list-group">
        <li class="list-group-item disabled"><?php _e( 'Welcome in My Universal Theme,enjoy it!!!', 'myclassictheme' ); ?></li>
        <li class="list-group-item disabled"><?php _e( 'In this theme you can:', 'myclassictheme' ); ?></li>
        <li class="list-group-item"><?php _e( '- print phone number', 'myclassictheme' ); ?></li>
        <li class="list-group-item"><?php _e( '- print opening time', 'myclassictheme' ); ?></li>
        <li class="list-group-item"><?php _e( '- edit pages with block theme support', 'myclassictheme' ); ?></li>
        <li class="list-group-item"><?php _e( '- create new themes!!', 'myclassictheme' ); ?></li>
        <li class="list-group-item"><?php _e( '- sell products(WC integrate)', 'myclassictheme' ); ?></li>
    </ul>
	<?php ob_end_flush();
}

/* Redirect to Home Page after logout */
add_action( 'wp_logout', 'myclassictheme_auto_redirect_external_after_logout' );

function myclassictheme_auto_redirect_external_after_logout() {
	wp_redirect( home_url() );
	exit();
}
