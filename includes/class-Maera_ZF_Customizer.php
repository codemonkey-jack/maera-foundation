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

		$wp_customize->add_section( 'feat_single', array(
			'title'    => __( 'Featured Images for single posts', 'maera_zf' ),
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
			'setting'  => 'layout_width',
			'label'    => __( 'Select max-width of main row class. Default: 1000px', 'maera_zf' ),
			'section'  => 'layout',
			'default'  => 1000,
			'priority' => 5,
			'choices'  => array(
				'min'  => 500,
				'max'  => 1900,
				'step' => 1,
			),
			'output' => array(
				'element'  => '.row',
				'property' => 'max-width',
				'units'    => 'px',
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
			'type'         => 'color',
			'setting'      => 'nav_bg',
			'label'        => __( 'Navbar Color', 'maera_zf' ),
			'section'      => 'colors',
			'default'      => '#333333',
			'output'       => array(
				'element'  => '.top-bar, .top-bar-section li:not(.has-form) a:not(.button), .top-bar-section .has-form, .contain-to-grid.topbar',
				'property' => 'background',
			),
		);

		$controls[] = array(
			'type'     => 'checkbox',
			'setting'  => 'navbar_search',
			'label'    => __( 'Display search form on the NavBar', 'maera_zf' ),
			'section'  => 'nav',
			'default'  => 1,
			//'priority' => 26,
		);

		$controls[] = array(
			'type'     => 'checkbox',
			'mode'     => 'toggle',
			'setting'  => 'navbar_width',
			'label'    => __( 'Navbar width', 'maera_zf' ),
			'subtitle' => __( 'Select between full-with(default) or contained-to-grid', 'maera_zf' ),
			'section'  => 'nav',
			'default'  => 0,
		);

		$controls[] = array(
			'type'     => 'checkbox',
			'mode'     => 'switch',
			'setting'  => 'navbar_sticky',
			'label'    => __( 'Sticky navbar?', 'maera_zf' ),
			'subtitle' => __( 'Available only with a primary navigation selection.', 'maera_zf' ),
			'section'  => 'nav',
			'default'  => 0,
		);

		$controls[] = array(
			'type'     => 'checkbox',
			'mode'     => 'switch',
			'setting'  => 'navbar_float',
			'label'    => __( 'Float right', 'maera_zf' ),
			'subtitle' => __( 'Available only with a primary navigation selection.', 'maera_zf' ),
			'section'  => 'nav',
			'default'  => 0,
		);

		$controls[] = array(
			'type'        => 'checkbox',
			'setting'     => 'feat_img_archive',
			'label'       => __( 'Display Featured Images', 'maera_zf' ),
			'description' => __( 'Display featured Images on post archives ( such as categories, tags, month view etc ).', 'maera_zf' ),
			'section'     => 'feat_archive',
			'priority'    => 50,
			'default'     => 1,
		);

		$controls[] = array(
			'type'     => 'slider',
			'setting'  => 'feat_img_archive_width',
			'label'    => __( 'Featured Image Width', 'maera_zf' ),
			'subtitle' => __( 'Set to -1 for max width and 0 for original width. Default: -1', 'maera_zf' ),
			'section'  => 'feat_archive',
			'priority' => 52,
			'default'  => -1,
			'choices'  => array(
				'min'  => -1,
				'max'  => 1200,
				'step' => '1'
			),
		);

		$controls[] = array(
			'type'     => 'slider',
			'setting'  => 'feat_img_archive_height',
			'label'    => __( 'Featured Image Height', 'maera_zf' ),
			'subtitle' => __( 'Set to 0 to resize the image using the original image proportions. Default: 0', 'maera_zf' ),
			'section'  => 'feat_archive',
			'priority' => 53,
			'default'  => 0,
			'choices'  => array(
				'min'  => 0,
				'max'  => 1200,
				'step' => '1'
			),
		);

		$post_types = get_post_types( array( 'public' => true ), 'names' );
		$controls[] = array(
			'type'        => 'multicheck',
			'mode'        => 'checkbox',
			'setting'     => 'feat_img_per_post_type',
			'label'       => __( 'Disable featured images per post type.', 'maera_zf' ),
			// 'subtitle'    => __( 'CAUTION: This setting will also disable displaying the featured images on single posts as well.', 'maera_zf' ),
			'section'     => 'feat_archive',
			'priority'    => 65,
			'default'     => '',
			'choices'     => $post_types,
		);

		$controls[] = array(
			'type'        => 'checkbox',
			'setting'     => 'feat_img_post',
			'label'       => __( 'Display Featured Images', 'maera_zf' ),
			'subtitle'    => __( 'Display featured Images on simgle posts.', 'maera_zf' ),
			'section'     => 'feat_single',
			'priority'    => 60,
			'default'     => 0,
		);

		$controls[] = array(
			'type'     => 'slider',
			'setting'  => 'feat_img_post_width',
			'label'    => __( 'Featured Image Width', 'maera_zf' ),
			'subtitle' => __( 'Set to -1 for max width and 0 for original width. Default: -1', 'maera_zf' ),
			'section'  => 'feat_single',
			'priority' => 62,
			'default'  => -1,
			'choices'  => array(
				'min'  => -1,
				'max'  => 1200,
				'step' => '1'
			),
		);

		$controls[] = array(
			'type'     => 'slider',
			'setting'  => 'feat_img_post_height',
			'label'    => __( 'Featured Image Height', 'maera_zf' ),
			'subtitle' => __( 'Set to 0 to use the original image proportions. Default: 0', 'maera_zf' ),
			'section'  => 'feat_single',
			'priority' => 63,
			'default'  => 0,
			'choices'  => array(
				'min'  => 0,
				'max'  => 1200,
				'step' => '1'
			),
		);
		return $controls;

	}

}
