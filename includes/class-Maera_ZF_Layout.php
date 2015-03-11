<?php

class Maera_ZF_Layout {

	function __construct() {

		// Disable the sidebar if layout is full-width.
		if ( 0 == get_theme_mod( 'layout', 0 ) ) {
			add_filter( 'maera/sidebar/primary', '__return_false' );
		}

		add_filter( 'maera/section_class/wrapper', array( $this, 'wrapper_class' ) );
		add_filter( 'maera/section_class/content', array( $this, 'content_class' ) );
		add_filter( 'maera/section_class/primary', array( $this, 'sidebar_class' ) );

	}

	/**
	 * column classes for main content
	 * depending on whether the primary sidebar has any widgets in it or not.
	 */
	function wrapper_class( $classes ) {
		return $classes . ' row';
	}

	/**
	 * column classes for main content
	 * depending on whether the primary sidebar has any widgets in it or not.
	 */
	function content_class( $classes ) {

		$layout    = get_theme_mod( 'layout', 0 );
		$alignment = ( 2 == get_theme_mod( 'layout' ) ) ? ' right' : null;
		$columns_calc = 'large-';
		$columns_calc .= 12 - get_theme_mod('sidebar_width',4);
		$columns   = ' small-12 columns ';
		$columns  .= ( 0 == $layout ) ? 'large-12' : $columns_calc;

		return ( is_active_sidebar( 'sidebar_primary' ) ) ? $classes . $columns . $alignment : $classes;

	}

	/**
	 * column classes for main content
	 * depending on whether the primary sidebar has any widgets in it or not.
	 */
	function sidebar_class( $classes ) {
		$columns = ' large-';
		$columns .= get_theme_mod('sidebar_width',4);
		return ( is_active_sidebar( 'sidebar_primary' ) ) ? $classes . ' columns small-12 ' . $columns  : $classes;
	}

}
