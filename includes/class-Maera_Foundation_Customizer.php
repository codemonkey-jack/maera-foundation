<?php

/**
 *
 */
class Maera_Foundation_Customizer {

	function __construct() {

		add_action( 'customize_register', array( $this, 'create_section' ) );
		add_filter( 'kirki/controls', array( $this, 'create_settings' ) );

	}

	/*
	 * Create the section
	 */
	function create_section( $wp_customize ) {

		$wp_customize->add_section( 'layout', array(
			'title'    => __( 'Layout', 'maera_foundation' ),
			'priority' => 999,
		) );

	}

	/**
	 * Create the customizer controls.
	 * Depends on the Kirki Customizer plugin.
	 */
	function create_settings( $controls ) {

		$controls[] = array(
			'type'     => 'radio',
			'mode'     => 'image',
			'setting'  => 'layout',
			'label'    => __( 'Layout', 'maera_foundation' ),
			'section'  => 'layout',
			'priority' => 1,
			'default'  => 0,
			'choices'  => array(
				0 => get_template_directory_uri() . '/assets/images/1c.png',
				1 => get_template_directory_uri() . '/assets/images/2cr.png',
				2 => get_template_directory_uri() . '/assets/images/2cl.png',
			),
		);

		$controls[] = array(
			'type'     => 'slider',
			'setting'  => 'logo_max_width',
			'label'    => __( 'Logo Maximum Width (1-12 columns)', 'maera_foundation' ),
			'section'  => 'title_tagline',
			'default'  => 3,
			'priority' => 50,
			'choices'  => array(
				'min'  => 1,
				'max'  => 12,
				'step' => 1,
			),
		);

		return $controls;

	}

}
