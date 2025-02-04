<?php
/**
 * The template for displaying searchform as html
 *
 * @link https://codex.wordpress.org/Creating_a_Search_Page
 * @package myclassictheme
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label>
        <input type="search" class="search-field form-control"
               placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'myclassictheme' ); ?>"
               value="<?php echo esc_attr( get_search_query() ); ?>"
               name="s" title="<?php _ex( 'Search for:', 'label', 'myclassictheme' ); ?>">
    </label>
    <input type="submit" class="search-submit btn btn-default"
           value="<?php echo esc_attr_x( 'Search', 'submit button', 'myclassictheme' ); ?>">
</form>
