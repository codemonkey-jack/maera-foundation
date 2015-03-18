<?php

class Maera_ZF_Styles {

	private static $instance;

	public function __construct() {

		global $content_width;
		$content_width = ( 0 == get_theme_mod( 'layout', 0 ) && is_active_sidebar( 'sidebar_primary' ) ) ? 1280 : 843;

		add_filter( 'maera/styles', array( $this, 'custom_header_css' ) );
		add_filter( 'maera/styles', array( $this, 'navbar_css' ) );
		add_filter( 'maera/styles', array( $this, 'headers_sizes' ) );

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

		$styles .= '.top-bar .name h1 a, .top-bar-section ul li > a { color: ' . $nav_typo_color . ';}';
		$styles .= '#nav-toggle span, #nav-toggle span:before, #nav-toggle span:after { background: ' . $nav_typo_color . ';}';

		return $styles;
	}

	function headers_sizes( $styles ) {

		$font_base_size = get_theme_mod( 'font_base_size', 14 );

		$styles .= 'h1, .h1 { font-size: ' . ( 2.6  * get_theme_mod( 'font_headers_size', 1 ) * $font_base_size ) . 'px; }';
		$styles .= 'h2, .h2 { font-size: ' . ( 2.15 * get_theme_mod( 'font_headers_size', 1 ) * $font_base_size ) . 'px; }';
		$styles .= 'h3, .h3 { font-size: ' . ( 1.7  * get_theme_mod( 'font_headers_size', 1 ) * $font_base_size ) . 'px; }';
		$styles .= 'h4, .h4 { font-size: ' . ( 1.1  * get_theme_mod( 'font_headers_size', 1 ) * $font_base_size ) . 'px; }';
		$styles .= 'h5, .h5 { font-size: ' . ( 1    * get_theme_mod( 'font_headers_size', 1 ) * $font_base_size ) . 'px; }';
		$styles .= 'h6, .h6 { font-size: ' . ( .85  * get_theme_mod( 'font_headers_size', 1 ) * $font_base_size ) . 'px; }';

		return $styles;
	}

}
