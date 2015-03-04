<?php

class Maera_ZF_Images {

	function __construct() {

		add_filter( 'maera/image/width', array( $this, 'featured_width' ) );
		add_filter( 'maera/image/height', array( $this, 'featured_height' ) );

		add_filter( 'maera/image/display', array( $this, 'disable_feat_images_ppt' ), 99 );

	}

	function featured_width() {
		global $content_width;

		$theme_mod = ( is_singular() ) ? get_theme_mod( 'feat_img_post_width', 1900 ) : get_theme_mod( 'feat_img_archive_width', 1900 );
		$width     = ( '-1' == $theme_mod ) ? $content_width : $theme_mod;

		return $width;
	}

	function featured_height() {

		$theme_mod = ( is_singular() ) ? get_theme_mod( 'feat_img_post_height', 0 ) : get_theme_mod( 'feat_img_archive_height', 0 );
		return $theme_mod;

	}

	/**
	 * Disable featured images per post type.
	 * This is a simple function that parses the array of disabled options from the customizer
	 * and then sets their display to 0 if we've selected them in our array.
	 */
	function disable_feat_images_ppt() {
		global $post;

		$current_post_type = get_post_type( $post );
		$images_ppt        = get_theme_mod( 'feat_img_per_post_type', '' );

		// Get the array of disabled featured images per post type
		$disabled = ( '' != $images_ppt ) ? explode( ',', $images_ppt ) : '';

		// Get the default switch values for singulars and archives
		$default = ( is_singular() ) ? get_theme_mod( 'feat_img_post', 0 ) : get_theme_mod( 'feat_img_archive', 0 );

		// If the current post type exists in our array of disabled post types, then set its displaying to false
		if ( $disabled ) {
			$display = ( in_array( $current_post_type, $disabled ) ) ? 0 : $default;
		} else {
			$display = $default;
		}

		return $display;

	}

}
