<?php
/*
Plugin Name:         Maera Foundation Shell
Plugin URI:
Description:         A shell for the Maera theme implementing Zurb's Foundation framework.
Version:             0.1-dev
Author:              @aristath, @fovoc
Author URI:          http://press.codes
*/


define( 'MAERA_FOUNDATION_SHELL_URL', plugins_url( '', __FILE__ ) );
define( 'MAERA_FOUNDATION_SHELL_PATH', dirname( __FILE__ ) );

class Maera_ZF {

    private static $instance;

    public function __construct() {

        $this->requires();

        $maera_zf_timber     = new Maera_ZF_Timber();
        $maera_zf_customizer = new Maera_ZF_Customizer();
        $maera_zf_layout     = new Maera_ZF_Layout();
        $maera_zf_scripts    = new Maera_ZF_Scripts();
        $maera_zf_styles     = new Maera_ZF_Styles();
        $maera_zf_styles     = new Maera_ZF_Images();
        $maera_zf_social     = new Maera_FZ_Social();

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
        require_once( __DIR__ . '/includes/class-Maera_ZF_Images.php');
        include_once( __DIR__ . '/includes/class-Maera_ZF_Social.php' );

    }

	/**
	 * Register sidebars
	 */
	function widgets_init() {

		register_sidebar( array(
			'name'          => __( 'Header', 'maera_zf' ),
			'id'            => 'sidebar_header',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

    register_sidebar( array(
      'name'          => __( 'Footer', 'maera_zf' ),
      'id'            => 'sidebar_footer',
      'before_widget' => '<section id="%1$s" class="widget columns small-12 large-4 %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<h3 class="widget-title">',
      'after_title'   => '</h3>',
    ) );

		// Remove the secondary sidebar
		unregister_sidebar( 'sidebar_secondary' );

    // Remove primary sidebar in order to re-enable it with some extra classes
    unregister_sidebar( 'sidebar_primary' );

    $class = '';
    if ( get_theme_mod('widget_panel',0) == 1 ) {
      $class = 'panel';
    }

    register_sidebar( array(
  		'name'          => __( 'Primary Sidebar', 'maera' ),
  		'id'            => 'sidebar_primary',
  		'before_widget' => '<section id="%1$s" class="widget ' . $class . ' %2$s">',
  		'after_widget'  => '</section>',
      'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
  	) );

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

/**
* Include the shell
*/
function maera_foundation_shell_include( $shells ) {

    // Add our shell to the array of available shells
    $shells[] = array(
        'value' => 'foundation',
        'label' => 'Zurb Foundation',
        'class' => 'Maera_ZF',
    );

    return $shells;

}
add_filter( 'maera/shells/available', 'maera_foundation_shell_include' );
