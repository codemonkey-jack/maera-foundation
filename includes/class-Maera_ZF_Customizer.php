<?php

/**
 *
 */
class Maera_ZF_Customizer {

	function __construct() {

		add_action( 'customize_register', array( $this, 'create_section' ) );
		add_filter( 'kirki/controls', array( $this, 'create_settings' ) );

	}

	/*
	 * Create the section
	 */
	function create_section( $wp_customize ) {

		$wp_customize->add_section( 'layout', array(
			'title'    => __( 'Layout', 'maera_zf' ),
			'priority' => 999,
		) );

		$wp_customize->add_section( 'feat_archive', array(
			'title'    => __( 'Featured Images for archives', 'maera_zf' ),
			'priority' => 999,
		) );

		// $wp_customize->add_section( 'layout', array(
		// 	'title'    => __( 'Layout', 'maera_zf' ),
		// 	'priority' => 999,
		// ) );

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
			'label'    => __( 'Layout', 'maera_zf' ),
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
			'label'    => __( 'Logo Maximum Width (1-12 columns)', 'maera_zf' ),
			'section'  => 'title_tagline',
			'default'  => 3,
			'priority' => 50,
			'choices'  => array(
				'min'  => 1,
				'max'  => 12,
				'step' => 1,
			),
		);

		$controls[] = array(
			'type'        => 'checkbox',
			'setting'     => 'feat_img_archive',
			'label'       => __( 'Display Featured Images', 'maera_bootstrap' ),
			'description' => __( 'Display featured Images on post archives ( such as categories, tags, month view etc ).', 'maera_bootstrap' ),
			'section'     => 'feat_archive',
			'priority'    => 50,
			'default'     => 0,
		);

		$controls[] = array(
			'type'     => 'slider',
			'setting'  => 'feat_img_archive_width',
			'label'    => __( 'Featured Image Width', 'maera_bootstrap' ),
			'subtitle' => __( 'Set to -1 for max width and 0 for original width. Default: -1', 'maera_bootstrap' ),
			'section'  => 'feat_archive',
			'priority' => 52,
			'default'  => -1,
			'choices'  => array(
				'min'  => -1,
				'max'  => get_theme_mod( 'screen_large_desktop', 1200 ),
				'step' => '1'
			),
		);

		$controls[] = array(
			'type'     => 'slider',
			'setting'  => 'feat_img_archive_height',
			'label'    => __( 'Featured Image Height', 'maera_bootstrap' ),
			'subtitle' => __( 'Set to 0 to resize the image using the original image proportions. Default: 0', 'maera_bootstrap' ),
			'section'  => 'feat_archive',
			'priority' => 53,
			'default'  => 0,
			'choices'  => array(
				'min'  => 0,
				'max'  => get_theme_mod( 'screen_large_desktop', 1200 ),
				'step' => '1'
			),
		);

		return $controls;

	}

}
