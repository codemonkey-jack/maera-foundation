<?php

class Maera_ZF {

    private static $instance;

    public function __construct() {

        $this->requires();

        $maera_zf_timber     = new Maera_ZF_Timber();
        $maera_zf_customizer = new Maera_ZF_Customizer();
        $maera_zf_layout     = new Maera_ZF_Layout();
        $maera_zf_scripts    = new Maera_ZF_Scripts();
        $maera_zf_styles     = new Maera_ZF_Styles();

        // Define the shell path to be used for views etc.
        if ( ! defined( 'MAERA_SHELL_PATH' ) ) {
            define( 'MAERA_SHELL_PATH', __DIR__ );
        }

        add_action( 'widgets_init', array( $this, 'widgets_init' ) );
        add_action( 'after_setup_theme', array( $this, 'setup' ) );

        add_theme_support( 'infinite-scroll', array(
            'container' => 'content',
            'footer' => false,
        ) );

        // Add theme support for Custom Header
        $header_args = array(
            'default-image'          => '',
            'width'                  => 0,
            'height'                 => 0,
            'flex-width'             => true,
            'flex-height'            => true,
            'uploads'                => true,
            'random-default'         => true,
            'header-text'            => true,
            'default-text-color'     => '#333333',
            'wp-head-callback'       => '',
            'admin-head-callback'    => '',
            'admin-preview-callback' => '',
        );
        add_theme_support( 'custom-header', $header_args );

    }

    /**
     * Singleton
     */
    public static function get_instance() {

        if ( null == self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
    * Include any required files
    */
    function requires() {

        require_once( __DIR__ . '/includes/class-Maera_ZF_Timber.php');
        require_once( __DIR__ . '/includes/class-Maera_ZF_Customizer.php');
        require_once( __DIR__ . '/includes/class-Maera_ZF_Layout.php');
        require_once( __DIR__ . '/includes/class-Maera_ZF_Styles.php');
        require_once( __DIR__ . '/includes/class-Maera_ZF_Scripts.php');

    }

	/**
	 * Register sidebars
	 */
	function widgets_init() {

		$class        = apply_filters( 'maera/widgets/class', '' );
		$before_title = apply_filters( 'maera/widgets/title/before', '<h3 class="widget-title">' );
		$after_title  = apply_filters( 'maera/widgets/title/after', '</h3>' );

		register_sidebar( array(
			'name'          => __( 'Header', 'maera_zf' ),
			'id'            => 'header',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title"',
			'after_title'   => '</h3>',
		) );

		// Remove the secondary sidebar
		unregister_sidebar( 'sidebar_secondary' );

	}

    /**
    * Maera initial setup and constants
    */
    function setup() {

        // Register wp_nav_menu() menu ( http://codex.wordpress.org/Function_Reference/register_nav_menus )
        register_nav_menus( array(
            'offcanvas' => __( 'Off-Canvas', 'maera_zf' )
        ) );

    }

}
