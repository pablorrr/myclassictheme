<?php

/**
 * Class Name:myclassictheme_Navwalker
 * GitHub URI: https://github.com/twittem/wp-bootstrap-navwalker
 * Description: A custom WordPress nav walker class to implement the Bootstrap 4 navigation style in a custom  theme using the WordPress built in menu manager.
 * Version: 2.0.4
 * Author: Edward McIntyre - @twittem
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

class myclassictheme_Navwalker extends Walker_Nav_Menu {

	/**
	 * @param  string  $output  Passed by reference. Used to append additional content.
	 * @param  int  $depth  Depth of page. Used for padding.
	 *
	 * @see Walker::start_lvl()
	 * @since 3.0.0
	 *
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "\n$indent<ul role=\"menu\" class=\" dropdown-menu\">\n";
	}

	/**
	 * @param  string  $output  Passed by reference. Used to append additional content.
	 * @param  object  $item  Menu item data object.
	 * @param  int  $depth  Depth of menu item. Used for padding.
	 * @param  int  $current_page  Menu item ID.
	 * @param  object  $args
	 *
	 * @since 3.0.0
	 *
	 * @see Walker::start_el()
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		/**
		 * Dividers, Headers or Disabled
		 * =============================
		 * Determine whether the item is a Divider, Header, Disabled or regular
		 * menu item. To prevent errors we use the strcasecmp() function to so a
		 * comparison that is not case sensitive. The strcasecmp() function returns
		 * a 0 if the strings are equal.
		 */
		if ( strcasecmp( $item->attr_title, 'divider' ) == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="divider">';
		} elseif ( strcasecmp( $item->title, 'divider' ) == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="divider">';
		} elseif ( strcasecmp( $item->attr_title, 'dropdown-header' ) == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="dropdown-header">' . esc_attr( $item->title );
		} elseif ( strcasecmp( $item->attr_title, 'disabled' ) == 0 ) {
			$output .= $indent . '<li role="presentation" class="disabled"><a href="#">' . esc_attr( $item->title ) . '</a>';
		} else {

			$class_names = $value = '';

			$classes   = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = 'menu-item-' . $item->ID;

			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );

			if ( $args->has_children && $depth === 0 ) {
				$class_names .= ' dropdown';
			} elseif ( $args->has_children && $depth > 0 ) {
				$class_names .= ' dropdown dropdown-submenu';
			}

			if ( in_array( 'current-menu-item', $classes ) ) {
				$class_names .= ' active';
			}

			$class_names = $class_names ? ' class="nav-item ' . esc_attr( $class_names ) . '"' : '';

			$id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args );
			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

			$output .= $indent . '<li' . $id . $value . $class_names . '>';

			$atts           = array();
			$atts['title']  = ! empty( $item->title ) ? $item->title : '';
			$atts['target'] = ! empty( $item->target ) ? $item->target : '';
			$atts['rel']    = ! empty( $item->xfn ) ? $item->xfn : '';
			$atts['href']   = ! empty( $item->url ) ? $item->url : '';

			// If item has_children add atts to a.

			if ( $args->has_children ) {
				$atts['href']          = '#';
				$atts['data-toggle']   = 'dropdown';
				$atts['class']         = 'dropdown-toggle nav-link';
				$atts['aria-haspopup'] = 'true';
			} else {
				$atts['href']  = ! empty( $item->url ) ? $item->url : '';
				$atts['class'] = 'nav-link';
			}
			if ( $depth > 0 && ! in_array( 'menu-item-has-children', $classes ) ) {
				$atts['class'] = 'dropdown-item';
			} elseif ( $depth > 0 && in_array( 'menu-item-has-children', $classes ) ) {
				$atts['data-toggle'] = 'dropdown';
				$atts['class']       = 'dropdown-toggle dropdown-item';
			} else {

			}

			$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );


			$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if ( ! empty( $value ) ) {
					$value      = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}

			$item_output = $args->before;

			/*
			 * Glyphicons
			 * ===========
			 * Since the the menu item is NOT a Divider or Header we check the see
			 * if there is a value in the attr_title property. If the attr_title
			 * property is NOT null we apply it as the class name for the glyphicon.
			 */
			if ( ! empty( $item->attr_title ) ) {
				$item_output .= '<a' . $attributes . '>';
			} else {
				$item_output .= '<a' . $attributes . '>';
			}

			$item_output .= $args->link_before . apply_filters( 'the_title', $item->title,
					$item->ID ) . $args->link_after;
			$item_output .= ( $args->has_children ) ? ' <span class="caret"></span></a>' : '</a>';
			$item_output .= $args->after;

			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	}

	/**
	 * Traverse elements to create list from elements.
	 *
	 * Display one element if the element doesn't have any children otherwise,
	 * display the element and its children. Will only traverse up to the max
	 * depth and no ignore elements under that depth.
	 *
	 * This method shouldn't be called directly, use the walk() method instead.
	 *
	 * @param  object  $element  Data object
	 * @param  array  $children_elements  List of elements to continue traversing.
	 * @param  int  $max_depth  Max depth to traverse.
	 * @param  int  $depth  Depth of current element.
	 * @param  array  $args
	 * @param  string  $output  Passed by reference. Used to append additional content.
	 *
	 * @return null Null on failure with no changes to parameters.
	 * @since 2.5.0
	 *
	 * @see Walker::start_el()
	 */
	public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
		if ( ! $element ) {
			return;
		}

		$id_field = $this->db_fields['id'];

		// Display this element.
		if ( is_object( $args[0] ) ) {
			$args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );
		}

		parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}

}
