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
			'priority' => 5,
		) );

		$wp_customize->add_panel( 'blog', array(
			'title'    => __( 'Blog', 'maera_zf' ),
			'priority' => 15,
		) );

		$wp_customize->add_section( 'blog_options', array(
			'title'    => __( 'Blog options', 'maera_zf' ),
			'priority' => 999,
			'panel'		 => 'blog'
		) );

		$wp_customize->add_section( 'feat_archive', array(
			'title'    => __( 'Featured Images for archives', 'maera_zf' ),
			'priority' => 999,
			'panel'		 => 'blog'
		) );

		$wp_customize->add_section( 'feat_single', array(
			'title'    => __( 'Featured Images for single posts', 'maera_zf' ),
			'priority' => 999,
			'panel'		 => 'blog'
		) );

		$wp_customize->add_panel( 'backgrounds', array(
			'title'    => __( 'Backgrounds', 'maera_zf' ),
			'priority' => 10,
		) );

		$wp_customize->add_section( 'body_background', array(
			'title'    => __( 'Body background', 'maera_zf' ),
			'priority' => 999,
			'panel'		 => 'backgrounds'
		) );

		$wp_customize->add_section( 'footer_background', array(
			'title'    => __( 'Footer background', 'maera_zf' ),
			'priority' => 999,
			'panel'		 => 'backgrounds'
		) );

		$wp_customize->add_section( 'footer', array(
			'title'    => __( 'Footer', 'maera_zf' ),
			'priority' => 999,
		) );

		// $wp_customize->add_section( 'typography', array(
		// 	'title'    => __( 'Typography', 'maera_zf' ),
		// 	'priority' => 999,
		// ) );

		// $wp_customize->add_section( 'social_links', array(
		// 	'title'    => __( 'Social links', 'maera_zf' ),
		// 	'priority' => 999,
		// ) );

		// $wp_customize->add_section( 'advanced', array(
		// 	'title'    => __( 'Advanced', 'maera_zf' ),
		// 	'priority' => 999,
		// ) );

		}

	/**
	 * Create the customizer controls.
	 * Depends on the Kirki Customizer plugin.
	 */
	function create_settings( $controls ) {

		$controls[] = array(
			'type'     => 'radio-image',
			'settings' => 'layout',
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
			'settings' => 'layout_width',
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
			'type'     => 'select',
			'settings' => 'sidebar_width',
			'label'    => __( 'Primary sidebar width', 'textdomain' ),
			'description' => __( 'Select the width of primary sidebar in a total of 12-column grid', 'maera_zf' ),
			'section'  => 'layout',
			'default'  => 4,
			'priority' => 10,
			'choices'  => array(
				2 => __( '2/12', 'maera_zf' ),
				3 => __( '3/12', 'maera_zf' ),
				4 => __( '4/12', 'maera_zf' ),
				5 => __( '5/12', 'maera_zf' ),
				6 => __( '6/12', 'maera_zf' ),
			),
		);

		$controls[] = array(
			'type'     => 'switch',
			'settings' => 'widget_panel',
			'label'    => __( 'Wrap primary sidebar widgets in panels', 'maera_zf' ),
			'section'  => 'layout',
			'default'  => 0,
			'priority' => 15,
		);

		$controls[] = array(
			'type'     => 'slider',
			'settings' => 'logo_max_width',
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
			'settings'     => 'nav_bg',
			'label'        => __( 'Navbar Color', 'maera_zf' ),
			'section'      => 'nav',
			'default'      => '#333333',
			'output'       => array(
				'element'  => '.top-bar, .top-bar-section li:not(.has-form) a:not(.button), .top-bar-section .has-form, .contain-to-grid.topbar',
				'property' => 'background',
			),
		);

		$controls[] = array(
			'type'     => 'checkbox',
			'settings' => 'navbar_search',
			'label'    => __( 'Display search form on the NavBar', 'maera_zf' ),
			'section'  => 'nav',
			'default'  => 1,
		);

		$controls[] = array(
			'type'     => 'toggle',
			'settings' => 'navbar_width',
			'label'    => __( 'Navbar width', 'maera_zf' ),
			'description' => __( 'Select between full-with(default) or contained-to-grid', 'maera_zf' ),
			'section'  => 'nav',
			'default'  => 0,
		);

		$controls[] = array(
			'type'     => 'switch',
			'settings' => 'navbar_sticky',
			'label'    => __( 'Sticky navbar?', 'maera_zf' ),
			'description' => __( 'Available only with a primary navigation selection.', 'maera_zf' ),
			'section'  => 'nav',
			'default'  => 0,
		);

		$controls[] = array(
			'type'     => 'switch',
			'settings' => 'navbar_float',
			'label'    => __( 'Float right', 'maera_zf' ),
			'description' => __( 'Available only with a primary navigation selection.', 'maera_zf' ),
			'section'  => 'nav',
			'default'  => 0,
		);

		$controls[] = array(
			'type'        => 'checkbox',
			'settings'    => 'feat_img_archive',
			'label'       => __( 'Display Featured Images', 'maera_zf' ),
			'help' 				=> __( 'Display featured Images on post archives ( such as categories, tags, month view etc ).', 'maera_zf' ),
			'section'     => 'feat_archive',
			'priority'    => 50,
			'default'     => 0,
		);

		$controls[] = array(
			'type'     => 'slider',
			'settings' => 'feat_img_archive_width',
			'label'    => __( 'Featured Image Width', 'maera_zf' ),
			'description' => __( 'Set to -1 for max width and 0 for original width. Default: -1', 'maera_zf' ),
			'section'  => 'feat_archive',
			'priority' => 52,
			'default'  => -1,
			'choices'  => array(
				'min'  => -1,
				'max'  => 1900,
				'step' => '1'
			),
		);

		$controls[] = array(
			'type'     => 'slider',
			'settings' => 'feat_img_archive_height',
			'label'    => __( 'Featured Image Height', 'maera_zf' ),
			'description' => __( 'Set to 0 to resize the image using the original image proportions. Default: 0', 'maera_zf' ),
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
			'settings'    => 'feat_img_per_post_type',
			'label'       => __( 'Disable featured images per post type.', 'maera_zf' ),
			'description'    => __( 'CAUTION: This setting will also disable displaying the featured images on single posts as well.', 'maera_zf' ),
			'section'     => 'feat_archive',
			'priority'    => 65,
			'default'     => '',
			'choices'     => $post_types,
		);

		$controls[] = array(
			'type'        => 'checkbox',
			'settings'    => 'feat_img_post',
			'label'       => __( 'Display Featured Images', 'maera_zf' ),
			'description'    => __( 'Display featured Images on single posts.', 'maera_zf' ),
			'section'     => 'feat_single',
			'priority'    => 60,
			'default'     => 0,
		);

		$controls[] = array(
			'type'     => 'slider',
			'settings' => 'feat_img_post_width',
			'label'    => __( 'Featured Image Width', 'maera_zf' ),
			'description' => __( 'Set to -1 for max width and 0 for original width. Default: -1', 'maera_zf' ),
			'section'  => 'feat_single',
			'priority' => 62,
			'default'  => -1,
			'choices'  => array(
				'min'  => -1,
				'max'  => 1900,
				'step' => '1'
			),
		);

		$controls[] = array(
			'type'     => 'slider',
			'settings' => 'feat_img_post_height',
			'label'    => __( 'Featured Image Height', 'maera_zf' ),
			'description' => __( 'Set to 0 to use the original image proportions. Default: 0', 'maera_zf' ),
			'section'  => 'feat_single',
			'priority' => 63,
			'default'  => 0,
			'choices'  => array(
				'min'  => 0,
				'max'  => 1200,
				'step' => '1'
			),
		);

		$controls[] = array(
			'type'        => 'radio-buttonset',
			'settings'    => 'blog_post_mode',
			'label'       => __( 'Archives Display Mode', 'maera_bs' ),
			'help' => __( 'Display the excerpt or the full post on post archives.', 'maera_bs' ),
			'section'     => 'blog_options',
			'priority'    => 1,
			'default'     => 'excerpt',
			'choices'     => array(
				'excerpt' => __( 'Excerpt', 'maera_bs' ),
				'full'    => __( 'Full Post', 'maera_bs' ),
			),
		);

		$controls[] = array(
			'type'     => 'slider',
			'settings' => 'post_excerpt_length',
			'label'    => __( 'Post excerpt length', 'maera_zf' ),
			'help' => __( 'Choose how many words should be used for post excerpt. Default: 55', 'maera_zf' ),
			'section'  => 'blog_options',
			'priority' => 10,
			'default'  => 55,
			'choices'  => array(
				'min'  => 10,
				'max'  => 150,
				'step' => 1,
			),
		);

		$controls[] = array(
			'type'        => 'text',
			'settings'    => 'post_excerpt_link_text',
			'label'       => __( '"more" text', 'maera_zf' ),
			'description'    => __( 'Text to display in case of excerpt too long. Default: Continued', 'maera_zf' ),
			'section'     => 'blog_options',
			'priority'    => 12,
			'default'     => __( 'Continued', 'maera_bs' ),
		);

		$controls[] = array(
			'type'         => 'background',
			'settings'     => 'body_bg',
			'label'        => __( 'Body background', 'maera_zf' ),
			'section'      => 'body_background',
			'default'      => array(
				'color'    => '#ffffff',
				'image'    => null,
				'repeat'   => 'repeat',
				'size'     => 'inherit',
				'attach'   => 'inherit',
				'position' => 'left-top',
				'opacity'  => 100,
			),
			'priority' => 5,
			'output' => array(
				'element'  => 'body',
			),
		);

		$controls[] = array(
			'type'         => 'background',
			'settings'     => 'footer_bg',
			'label'        => __( 'Footer background', 'maera_zf' ),
			'section'      => 'footer_background',
			'default'      => array(
				'color'    => '#ffffff',
				'image'    => null,
				'repeat'   => 'repeat',
				'size'     => 'inherit',
				'attach'   => 'inherit',
				'position' => 'left-top',
				'opacity'  => 100,
			),
			'priority' => 10,
			'output' => array(
				'element'  => 'footer.page-footer',
			),
		);

		$controls[] = array(
			'type'     => 'textarea',
			'label'    => __( 'Footer Text', 'maera_zf' ),
			'settings' => 'footer_text',
			'default'  => '&copy; [year] [sitename]',
			'section'  => 'footer',
			'priority' => 12,
			'description' => __( 'The text that will be displayed in your footer. You can use [year] and [sitename] and they will be replaced appropriately. Default: &copy; [year] [sitename]', 'maera_zf' ),
		);

		return $controls;

	}

}
