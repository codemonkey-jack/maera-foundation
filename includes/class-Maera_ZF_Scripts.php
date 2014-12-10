<?php

class Maera_ZF_Scripts {

	function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ) );
	}

	/**
	* Enqueue styles and scripts
	*/
	function scripts() {

		// Foundation core
		wp_register_style( 'maera_zf', MAERA_FOUNDATION_SHELL_URL . '/assets/css/foundation.css' );
		wp_enqueue_style( 'maera_zf' );

		// Foundation icons
		wp_register_style( 'maera_foundation_icons', MAERA_FOUNDATION_SHELL_URL . '/assets/foundation-icons/foundation-icons.css' );
		wp_enqueue_style( 'maera_foundation_icons' );

		// Add Foundation required scripts
		wp_enqueue_script( 'fastclick', MAERA_FOUNDATION_SHELL_URL . '/assets/vendor/fastclick.js', false );
		wp_enqueue_script( 'foundation', MAERA_FOUNDATION_SHELL_URL . '/assets/foundation.min.js', 'jquery' );

		// Add our custom styles
		wp_register_style( 'maera_foundation_custom', MAERA_FOUNDATION_SHELL_URL . '/assets/css/style.css' );
		wp_enqueue_style( 'maera_foundation_custom' );

	}

}
$maera_zf_scripts = new Maera_ZF_Scripts();
