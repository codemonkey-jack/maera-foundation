<?php

class Maera_ZF_Timber {

	function __construct() {
		add_filter( 'timber_context', array( $this, 'timber_global_context' ) );
	}

	/**
	 * Modify Timber global context
	 */
	function timber_global_context( $data ) {

		$data['menu']['offcanvas'] = has_nav_menu( 'offcanvas' ) ? new TimberMenu( 'offcanvas' ) : null;
		$data['sidebar']['header'] = Timber::get_widgets( 'sidebar_header' );
		return $data;

	}

}
