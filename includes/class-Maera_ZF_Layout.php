<?php

class Maera_ZF_Layout {

	function __construct() {

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

		$layout    = get_theme_mod( 'layout', 1 );
		$alignment = ( 2 == get_theme_mod( 'layout' ) ) ? ' right' : null;
		$columns   = ' small-12 columns';
		$columns  .= ( 0 == $layout ) ? ' large-12' : ' large-8';

		return ( is_active_sidebar( 'sidebar_primary' ) ) ? $classes . $columns . $alignment : $classes;

	}

	/**
	 * column classes for main content
	 * depending on whether the primary sidebar has any widgets in it or not.
	 */
	function sidebar_class( $classes ) {
		return ( is_active_sidebar( 'sidebar_primary' ) ) ? $classes . ' small-12 large-4 columns' : $classes;
	}

}
$maera_zf_layout = new Maera_ZF_Layout();
