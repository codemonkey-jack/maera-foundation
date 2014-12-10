<?php

class Maera_ZF {

    private static $instance;

    public function __construct() {

        $this->requires();

        $customizer = new Maera_ZF_Customizer();

        // Define the shell path to be used for views etc.
        if ( ! defined( 'MAERA_SHELL_PATH' ) ) {
            define( 'MAERA_SHELL_PATH', __DIR__ );
        }

        add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ) );
        add_action( 'widgets_init', array( $this, 'widgets_init' ) );
        add_action( 'after_setup_theme', array( $this, 'setup' ) );
        add_filter( 'timber_context', array( $this, 'timber_global_context' ) );

		// Disable the sidebar if layout is full-width.
		if ( 0 == get_theme_mod( 'layout', 0 ) ) {
			add_filter( 'maera/sidebar/primary', '__return_false' );
		}

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
        require_once( __DIR__ . '/includes/class-Maera_ZF_Customizer.php');
        require_once( __DIR__ . '/includes/class-Maera_ZF_Layout.php');
        require_once( __DIR__ . '/includes/class-Maera_ZF_Styles.php');
    }

    /**
    * Modify Timber global context
    */
    function timber_global_context( $data ) {

        $data['menu']['offcanvas'] = has_nav_menu( 'offcanvas' ) ? new TimberMenu( 'offcanvas' ) : null;
        return $data;

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
