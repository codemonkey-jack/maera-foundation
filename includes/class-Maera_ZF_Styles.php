<?php

class Maera_ZF_Styles {

	private static $instance;

	public function __construct() {

		global $content_width;
		$content_width = ( 0 == get_theme_mod( 'layout', 0 ) && is_active_sidebar( 'sidebar_primary' ) ) ? 1280 : 843;

		add_filter( 'maera/styles', array( $this, 'custom_header_css' ) );

	}
	function custom_header_css( $styles ) {

		$custom_header = get_header_image();

		if ( $custom_header ) {
			$styles .= '.header.hero{background-image:url("' . $custom_header . '");}';
		}
		$styles .= '.header.hero{color:#' . get_theme_mod( 'header_textcolor', '333333' ) . '}';

		return $styles;

	}

}
