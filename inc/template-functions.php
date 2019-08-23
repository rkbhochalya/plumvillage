<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Plum_Village
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function plumvillage_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	// if ( ! is_singular() ) {
	// 	$classes[] = 'hfeed';
	// }

	return $classes;
}
add_filter( 'body_class', 'plumvillage_body_classes' );