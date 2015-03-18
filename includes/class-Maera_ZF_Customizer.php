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

		// Layout
		$wp_customize->add_section( 'layout', array(
			'title'    => __( 'Layout', 'maera_zf' ),
			'priority' => 5,
		) );

		// Blog
		$wp_customize->add_panel( 'blog', array(
			'title'    => __( 'Blog', 'maera_zf' ),
			'priority' => 20,
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

		// Backgrounds
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

		// Footer
		$wp_customize->add_section( 'footer', array(
			'title'    => __( 'Footer', 'maera_zf' ),
			'priority' => 999,
		) );

		// Typography
		$wp_customize->add_panel( 'typography', array(
			'title' => __( 'Typography', 'maera_zf' ),
			'description' => __( 'Set the site typography options', 'maera_zf' ),
			'priority' => 30,
		) );

		$wp_customize->add_section( 'typo_base', array(
			'title'    => __( 'Base', 'maera_zf' ),
			'priority' => 10,
			'panel'		 => 'typography'
		) );

		$wp_customize->add_section( 'typo_headers', array(
			'title'    => __( 'Headers', 'maera_zf' ),
			'priority' => 15,
			'panel'		 => 'typography'
		) );

		$wp_customize->add_section( 'typo_nav', array(
			'title'    => __( 'Navbar', 'maera_zf' ),
			'priority' => 20,
			'panel'		 => 'typography'
		) );

		$wp_customize->add_section( 'typo_footer', array(
			'title'    => __( 'Footer', 'maera_zf' ),
			'priority' => 30,
			'panel'		 => 'typography'
		) );

		$wp_customize->add_section( 'social', array(
			'title'    => __( 'Social links', 'maera_zf' ),
			'priority' => 999,
		) );

		// $wp_customize->add_section( 'advanced', array(
		// 	'title'    => __( 'Advanced', 'maera_zf' ),
		// 	'priority' => 999,
		// ) );

		// TODO merge extra-header options
		//$wp_customize->remove_control( 'header_image' );
		//remove_theme_support( 'custom-header' );

		}

	/**
	 * Create the customizer controls.
	 * Depends on the Kirki Customizer plugin.
	 */
	function create_settings( $controls ) {

		// Layout
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

		// Title & tagline
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

		// Colors
		$controls[] = array(
			'type'         => 'color',
			'settings'     => 'nav_bg',
			'label'        => __( 'Navbar Color', 'maera_zf' ),
			'section'      => 'colors',
			'default'      => '#333333',
			'output'       => array(
				'element'  => '.top-bar, .top-bar-section li:not(.has-form) a:not(.button), .top-bar-section .has-form, .contain-to-grid.topbar',
				'property' => 'background',
			),
		);

		// Navigation
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

		// Blog
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

		// Backgrounds
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

		// Footer
		$controls[] = array(
			'type'     => 'textarea',
			'label'    => __( 'Footer Text', 'maera_zf' ),
			'settings' => 'footer_text',
			'default'  => '&copy; [year] [sitename]',
			'section'  => 'footer',
			'priority' => 12,
			'description' => __( 'The text that will be displayed in your footer. You can use [year] and [sitename] and they will be replaced appropriately. Default: &copy; [year] [sitename]', 'maera_zf' ),
		);

		// Typography Navbar
		$controls[] = array(
			'type'     => 'select',
			'setting'  => 'font_menus_font_family',
			'label'    => __( 'Menus font', 'maera_zf' ),
			'section'  => 'typo_nav',
			'default'  => '"Helvetica Neue", Helvetica, Arial, sans-serif',
			'priority' => 40,
			'choices'  => Kirki_Fonts::get_font_choices(),
			'output' => array(
				'element'  => '.top-bar-section ul li > a, ul.off-canvas-list li a',
				'property' => 'font-family',
			),
		);

		$controls[] = array(
			'type'     => 'slider',
			'setting'  => 'font_menus_weight',
			'subtitle' => __( 'Font Weight', 'maera_zf' ),
			'section'  => 'typo_nav',
			'default'  => 400,
			'priority' => 43,
			'choices'  => array(
				'min'  => 100,
				'max'  => 800,
				'step' => 100,
			),
			'output' => array(
				'element'  => '.top-bar-section ul li > a, ul.off-canvas-list li a',
				'property' => 'font-weight',
			),
		);

		$controls[] = array(
			'type'     => 'slider',
			'setting'  => 'font_menus_size',
			'subtitle' => __( 'Font Size', 'maera_zf' ),
			'section'  => 'typo_nav',
			'default'  => 14,
			'priority' => 44,
			'choices'  => array(
				'min'  => 10,
				'max'  => 30,
				'step' => 1,
			),
			'output' => array(
				'element'  => '.top-bar-section ul li > a, ul.off-canvas-list li a',
				'property' => 'font-size',
			),
		);

		$controls[] = array(
			'type'     => 'slider',
			'setting'  => 'font_menus_height',
			'subtitle' => __( 'Line Height', 'maera_zf' ),
			'section'  => 'typo_nav',
			'default'  => 1.1,
			'priority' => 25,
			'choices'  => array(
				'min'  => 0,
				'max'  => 3,
				'step' => 0.1,
			),
			'output' => array(
				'element'  => '.top-bar-section ul li > a, ul.off-canvas-list li a',
				'property' => 'line-height',
			),
		);

		// Typography Base
		$controls[] = array(
			'type'     => 'select',
			'setting'  => 'font_base_family',
			'label'    => __( 'Base font', 'maera_zf' ),
			'section'  => 'typo_base',
			'default'  => '"Helvetica Neue", Helvetica, Arial, sans-serif',
			'priority' => 20,
			'choices'  => Kirki_Fonts::get_font_choices(),
			'output' => array(
				'element'  => 'body',
				'property' => 'font-family',
			),
		);

		$controls[] = array(
			'type'     => 'multicheck',
			'setting'  => 'font_subsets',
			'label'    => __( 'Google-Font subsets', 'maera_zf' ),
			'description' => __( 'The subsets used from Google\'s API.', 'maera_bs' ),
			'section'  => 'typo_base',
			'default'  => 'latin',
			'priority' => 22,
			'choices'  => Kirki_Fonts::get_google_font_subsets(),
			'output' => array(
				'element'  => 'body',
				'property' => 'font-subset',
			),
		);

		$controls[] = array(
			'type'     => 'slider',
			'setting'  => 'font_base_weight',
			'label'    => __( 'Base Font Weight', 'maera_zf' ),
			'section'  => 'typo_base',
			'default'  => 400,
			'priority' => 24,
			'choices'  => array(
				'min'  => 100,
				'max'  => 900,
				'step' => 100,
			),
			'output' => array(
				'element'  => 'body',
				'property' => 'font-weight',
			),
		);

		$controls[] = array(
			'type'     => 'slider',
			'setting'  => 'font_base_size',
			'label'    => __( 'Base Font Size', 'maera_zf' ),
			'section'  => 'typo_base',
			'default'  => 14,
			'priority' => 25,
			'choices'  => array(
				'min'  => 7,
				'max'  => 48,
				'step' => 1,
			),
			'output' => array(
				'element'  => 'body',
				'property' => 'font-size',
				'units'    => 'px',
			),
		);

		$controls[] = array(
			'type'     => 'slider',
			'setting'  => 'font_base_height',
			'label'    => __( 'Base Line Height', 'maera_zf' ),
			'section'  => 'typo_base',
			'default'  => 1.43,
			'priority' => 26,
			'choices'  => array(
				'min'  => 0,
				'max'  => 3,
				'step' => 0.01,
			),
			'output' => array(
				'element'  => 'body',
				'property' => 'line-height',
			),
		);

		// Typography Headers
		$controls[] = array(
			'type'     => 'select',
			'setting'  => 'headers_font_family',
			'label'    => __( 'Font-Family', 'maera_zf' ),
			'section'  => 'typo_headers',
			'default'  => '"Helvetica Neue", Helvetica, Arial, sans-serif',
			'priority' => 30,
			'choices'  => Kirki_Fonts::get_font_choices(),
			'output' => array(
				'element'  => 'h1,.h1,h2,.h2,h3,.h3,h4,.h4,h5,.h5,h6,.h6',
				'property' => 'font-family'
			)
		);

		$controls[] = array(
			'type'     => 'slider',
			'setting'  => 'font_headers_weight',
			'label'    => __( 'Font Weight.', 'maera_zf' ) . ' ' . __( 'Default: ', 'maera_zf' ) . 400,
			'section'  => 'typo_headers',
			'default'  => 400,
			'priority' => 34,
			'choices'  => array(
				'min'  => 100,
				'max'  => 900,
				'step' => 100,
			),
			'output' => array(
				'element'  => 'h1,.h1,h2,.h2,h3,.h3,h4,.h4,h5,.h5,h6,.h6',
				'property' => 'font-weight'
			)
		);

		$controls[] = array(
			'type'     => 'slider',
			'setting'  => 'font_headers_size',
			'label'    => __( 'Font Size', 'maera_zf' ) . ' ' . __( 'Default: ', 'maera_zf' ) . '1',
			'description' => __( 'The size defined here applies to H5. All other header elements are calculated porportionally, based on the base font size.', 'maera_zf' ),
			'section'  => 'typo_headers',
			'default'  => 1,
			'priority' => 35,
			'choices'  => array(
				'min'  => 0.1,
				'max'  => 3,
				'step' => 0.01,
			),
		);

		$controls[] = array(
			'type'     => 'slider',
			'setting'  => 'font_headers_height',
			'label'    => __( 'Line Height', 'maera_zf' ) . ' ' . __( 'Default: ', 'maera_zf' ) . '1.1',
			'section'  => 'typo_headers',
			'default'  => 1.1,
			'priority' => 36,
			'choices'  => array(
				'min'  => 0,
				'max'  => 3,
				'step' => 0.1,
			),
			'output' => array(
				'element'  => 'h1,.h1,h2,.h2,h3,.h3,h4,.h4,h5,.h5,h6,.h6',
				'property' => 'line-height'
			)
		);

		// Social links
		$controls[] = array(
			'type'     => 'radio',
			'mode'     => 'buttonset',
			'setting'  => 'navbar_social',
			'label'    => __( 'Display social links in the NavBar.', 'maera_zf' ),
			'section'  => 'social',
			'default'  => 'off',
			'choices'  => array(
				'off'      => __( 'Off', 'maera_zf' ),
				'inline'   => __( 'Inline', 'maera_zf' ),
				'dropdown' => __( 'Dropdown', 'maera_zf' ),
			),
			'priority' => 1,
		);

		$social_links = Maera_FZ_Social::social_networks();

		$i = 0;
		foreach ( $social_links as $social_link => $label ) {

			$controls[] = array(
				'type'     => 'text',
				'setting'  => $social_link . '_link',
				'label'    => $label . ' ' . __( 'link', 'maera_zf' ),
				'section'  => 'social',
				'default'  => '',
				'priority' => 10 + $i,
			);

			$i++;

		}

		return $controls;

	}

}
