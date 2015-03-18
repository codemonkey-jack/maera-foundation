<?php

class Maera_FZ_Social {

	function __construct() {
		add_action( 'maera/header/inside/begin', array( $this, 'social_links_navbar_content' ), 10 );
	}

	public static function social_networks() {
		return array(
			'facebook'    => __( 'Facebook', 'maera_zf' ),
			'twitter'     => __( 'Twitter', 'maera_zf' ),
			'googleplus'  => __( 'Google+', 'maera_zf' ),
		);
	}

	/**
	 * Build the social links
	 */
	function social_links_builder( $before = '', $after = '', $separator = '' ) {

		$social_links = self::social_networks();

		$content = $before;

		foreach ( $social_links as $social_link => $label ) {
			$link = get_theme_mod( $social_link . '_link', '' );

			if ( '' != esc_url( $link ) ) {
				$content .= '<a href="' . $link . '" target="_blank" title="' . $label . '"><i class="dashicons dashicons-' . $social_link . '"></i>';
				$content .= 'dropdown' == get_theme_mod( 'navbar_social', 'off' ) ? '&nbsp;' . $label : '';
				$content .= '</a>';
				$content .= $separator;
			}
		}

		$content .= $after;

		return $content;

	}

	/**
	 * Social links in navbars
	 */
	function social_links_navbar_content() {

		$content = $before = $after = $separator = '';
		$social_mode = get_theme_mod( 'navbar_social', 'off' );

		// Early exit if social is set to off.
		if ( 'off' == $social_mode ) {
			return;
		}

		if ( 'inline' == $social_mode ) {

			$before = '<ul class="right navbar-inline-socials"><li class="menu-item">';
			$after     = '</li></ul>';
			$separator = '</li><li class="menu-item">';

		} elseif ( 'dropdown' == $social_mode ) {

			$before = '<ul class="right navbar-dropdown-socials"><li class="has-dropdown menu-item"><a href="#"><i class="dashicons dashicons-share"></i></a><ul class="dropdown"><li>';
			$after     = '</li></ul></li></ul>';
			$separator = '</li><li>';

		}

		$content = $this->social_links_builder( $before, $after, $separator );

		echo $content;

	}

}
