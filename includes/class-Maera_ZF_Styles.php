<?php

class Maera_ZF_Styles {

	private static $instance;

	public function __construct() {

		global $content_width, $wp_customize;
		$content_width = ( 0 == get_theme_mod( 'layout', 0 ) && is_active_sidebar( 'sidebar_primary' ) ) ? 1280 : 843;

		add_filter( 'maera/styles', array( $this, 'custom_header_css' ) );
		add_filter( 'maera/styles', array( $this, 'navbar_css' ) );
		add_filter( 'maera/styles', array( $this, 'headers_sizes' ) );

		if ( $wp_customize ) {
			add_action( 'wp_enqueue_scripts', array( $this, 'custom_css' ), 105 );
			remove_action( 'wp_head', array( 'Jetpack_Custom_CSS', 'link_tag' ), 101 );
		}
		add_action( 'wp_loaded', array( $this, 'activate_custom_css' ) );
		add_action( 'customize_save_after', array( $this, 'custom_css_theme_mod_to_jetpack' ) );
		add_action( 'safecss_parse_post', array( $this, 'custom_css_jetpack_to_theme_mod' ) );

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
		$styles .= '.top-bar-section .dashicons, .top-bar-section .dashicons-before:before { line-height: inherit; height: inherit;}';

		return $styles;
	}

	function headers_sizes( $styles ) {

		$font_base_size = get_theme_mod( 'font_base_size', 14 );

		$styles .= 'h1, .h1 { font-size: ' . ( 2.8  * get_theme_mod( 'font_headers_size', 1 ) * $font_base_size ) . 'px; }';
		$styles .= 'h2, .h2 { font-size: ' . ( 2.2 * get_theme_mod( 'font_headers_size', 1 ) * $font_base_size ) . 'px; }';
		$styles .= 'h3, .h3 { font-size: ' . ( 1.8  * get_theme_mod( 'font_headers_size', 1 ) * $font_base_size ) . 'px; }';
		$styles .= 'h4, .h4 { font-size: ' . ( 1.2  * get_theme_mod( 'font_headers_size', 1 ) * $font_base_size ) . 'px; }';
		$styles .= 'h5, .h5 { font-size: ' . ( 1    * get_theme_mod( 'font_headers_size', 1 ) * $font_base_size ) . 'px; }';
		$styles .= 'h6, .h6 { font-size: ' . ( .85  * get_theme_mod( 'font_headers_size', 1 ) * $font_base_size ) . 'px; }';

		return $styles;
	}

	/**
	* Include the custom CSS
	* Activate the custom CSS module.
	*/
	function custom_css() {
		$css = get_theme_mod( 'css', '' );
		if ( ! empty( $css ) ) {
			wp_add_inline_style( 'maera', $css );
		}
	}

	/**
	* Activate the custom CSS module.
	*/
	public function activate_custom_css() {

		$jetpack_active_modules = get_option( 'jetpack_active_modules' );

		if ( is_array( $jetpack_active_modules ) && ! in_array( 'custom-css', $jetpack_active_modules ) ) {
			$jetpack_active_modules[] = 'custom-css';
			update_option( 'jetpack_active_modules', $jetpack_active_modules );
		} else {
			// Get CSS saved as a theme mod
			$css = get_theme_mod( 'css', '' );

			// Early exit if Jetpack is not installed
			if ( ! class_exists( 'Jetpack_Custom_CSS' ) ) {
				return;
			}
			$new_css = Jetpack_Custom_CSS::get_css();
			if ( ! empty( $css ) && empty( $new_css ) ) {
				// Jetpack_Custom_CSS::save( array( 'css' => $css ) );
			}
		}

	}

	/**
	* Copy the custom CSS from theme_mod to Jetpack
	*/
	function custom_css_theme_mod_to_jetpack() {
		$css = get_theme_mod( 'css', '' );
		Jetpack_Custom_CSS::save( array( 'css' => $css ) );
	}

	/**
	* Copy the custom CSS from Jetpack to theme_mod
	*/
	function custom_css_jetpack_to_theme_mod() {
		$css = Jetpack_Custom_CSS::get_css();
		if ( $css != get_theme_mod( 'css', '' ) ) {
			set_theme_mod( 'css', $css );
		}
	}

}
