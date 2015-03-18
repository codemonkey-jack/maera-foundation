<?php

class Maera_FZ_Social {

	function __construct() {
		add_action( 'maera/header/inside/begin', array( $this, 'social_links_navbar_content' ), 10 );
		add_action( 'maera/sidebar/inside/end', array( $this, 'social_links_navbar_content' ), 10 );
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
				// TODO use ZF markup
				// $content .= '<a role="link" aria-labelledby="' . $label . '" href="' . $link . '" target="_blank" title="' . $label . '"><i class="dashicons dashicons-' . $social_link . '"></i>';
				// $content .= 'dropdown' == get_theme_mod( 'navbar_social', 'off' ) ? '&nbsp;' . $label : '';
				// $content .= '</a>';
				// $content .= $separator;
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
		$navbar_position = get_theme_mod( 'navbar_position', 'normal' );

		// Early exit if social is set to off.
		if ( 'off' == $social_mode ) {
			return;
		}

		if ( 'inline' == $social_mode ) {

			// TODO use ZF markup
			// $before = ( $navbar_position == 'right-slide' || $navbar_position == 'left-slide' ) ? '<ul class="nav navbar-nav navbar-inline-socials"><li>' : '<ul class="nav navbar-nav navbar-right navbar-inline-socials"><li>';
			// $after     = '</li></ul>';
			// $separator = '</li><li>';

		} elseif ( 'dropdown' == $social_mode ) {

			// TODO use ZF markup
			// $before = ( $navbar_position == 'right-slide' || $navbar_position == 'left-slide' ) ? '<ul class="nav navbar-nav navbar-dropdown-socials"><li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-haspopup="true" aria-expanded="false"><i class="dashicons dashicons-share"></i>&nbsp;<b class="caret"></b></a><ul class="dropdown-menu" role="menu"><li>' : '<ul class="nav navbar-nav navbar-right navbar-dropdown-socials"><li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-haspopup="true" aria-expanded="false"><i class="dashicons dashicons-share"></i>&nbsp;<b class="caret"></b></a><ul class="dropdown-menu" role="menu"><li>';
			// $after     = '</li></ul></li></ul>';
			// $separator = '</li><li>';

		}

		$content = $this->social_links_builder( $before, $after, $separator );

		echo $content;

	}

}
