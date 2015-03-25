<?php

class Maera_ZF_Images {

	function __construct() {

		add_filter( 'maera/image/width', array( $this, 'featured_width' ) );
		add_filter( 'maera/image/height', array( $this, 'featured_height' ) );

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

}
