<?php

class Maera_ZF_Scripts {

	function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ) );
		add_action( 'wp_footer', array( $this, 'custom_js' ) );
	}

	/**
	* Enqueue styles and scripts
	*/
	function scripts() {

		// Foundation normalize
		wp_register_style( 'maera_zf_normalize', MAERA_FOUNDATION_SHELL_URL . '/assets/css/normalize.css' );
		wp_enqueue_style( 'maera_zf_normalize' );
		// Foundation core
		wp_register_style( 'maera_zf', MAERA_FOUNDATION_SHELL_URL . '/assets/css/foundation.css' );
		wp_enqueue_style( 'maera_zf' );

		// Foundation icons
		wp_register_style( 'maera_foundation_icons', MAERA_FOUNDATION_SHELL_URL . '/assets/foundation-icons/foundation-icons.css' );
		wp_enqueue_style( 'maera_foundation_icons' );

		// Add Foundation required scripts
		wp_enqueue_script( 'fastclick', MAERA_FOUNDATION_SHELL_URL . '/assets/vendor/fastclick.js', false );
		wp_enqueue_script( 'foundation', MAERA_FOUNDATION_SHELL_URL . '/assets/js/foundation.js', 'jquery' );

		// Add our custom styles
		wp_register_style( 'maera_foundation_custom', MAERA_FOUNDATION_SHELL_URL . '/assets/css/style.css' );
		wp_enqueue_style( 'maera_foundation_custom' );

	}

	/**
	 * Implement the custom js field output and place it to the footer.
	 */
	function custom_js() {

	$js = get_theme_mod( 'js', '' );
		if ( ! empty( $js ) ) {
			echo '<script id="advanced-custom-js">' . htmlspecialchars_decode($js) . '</script>';
		}

	}

}
