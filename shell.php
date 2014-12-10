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

// Include the framework class
require_once MAERA_FOUNDATION_SHELL_PATH . '/class-Maera_ZF.php';
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
