<?php

class Maera_ZF_Styles {

	private static $instance;

	public function __construct() {

		global $content_width;
		$content_width = ( 0 == get_theme_mod( 'layout', 0 ) && is_active_sidebar( 'sidebar_primary' ) ) ? 1280 : 843;

		add_filter( 'maera/styles', array( $this, 'custom_header_css' ) );
		add_filter( 'maera/styles', array( $this, 'navbar_css' ) );

	}

	function custom_header_css( $styles ) {

		$custom_header = get_header_image();

		if ( $custom_header ) {
			$styles .= '.header.hero{background-image:url("' . $custom_header . '");}';
		}
		$styles .= '.header.hero{color:#' . get_theme_mod( 'header_textcolor', '333333' ) . '}';

		return $styles;

	}

	function navbar_css( $styles ) {

		$nav_bg_obj     = new Jetpack_Color( get_theme_mod( 'nav_bg', '#333333' ) );
		$nav_bg_lum     = $nav_bg_obj->toLuminosity();
		$nav_typo_color = '#' . $nav_bg_obj->getGrayscaleContrastingColor(10)->toHex();

		$styles .= '.top-bar-section ul li > a { color: ' . $nav_typo_color . ';}';
		$styles .= '#nav-toggle span, #nav-toggle span:before, #nav-toggle span:after { background: ' . $nav_typo_color . ';}';

		return $styles;
	}

}
