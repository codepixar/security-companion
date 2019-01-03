<?php
/*
 * Plugin Name:       Security Companion
 * Plugin URI:        https://colorlib.com/wp/themes/security/
 * Description:       Security Companion is a companion for Security theme.
 * Version:           1.0
 * Author:            Colorlib
 * Author URI:        https://colorlib.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       security-companion
 * Domain Path:       /languages
 */

if( !defined( 'WPINC' ) ){
    die;
}

/*************************
    Define Constant
*************************/

// Define version constant
if( ! defined( 'SECURITY_COMPANION_VERSION' ) ) {
    define( 'SECURITY_COMPANION_VERSION', '1.0' );
}

// Define dir path constant
if( ! defined( 'SECURITY_COMPANION_DIR_PATH' ) ) {
    define( 'SECURITY_COMPANION_DIR_PATH', plugin_dir_path( __FILE__ ) );
}

// Define inc dir path constant
if( ! defined( 'SECURITY_COMPANION_INC_DIR_PATH' ) ) {
    define( 'SECURITY_COMPANION_INC_DIR_PATH', SECURITY_COMPANION_DIR_PATH . 'inc/' );
}

// Define sidebar widgets dir path constant
if( ! defined( 'SECURITY_COMPANION_SW_DIR_PATH' ) ) {
    define( 'SECURITY_COMPANION_SW_DIR_PATH', SECURITY_COMPANION_INC_DIR_PATH . 'sidebar-widgets/' );
}

// Define elementor widgets dir path constant
if( ! defined( 'SECURITY_COMPANION_EW_DIR_PATH' ) ) {
    define( 'SECURITY_COMPANION_EW_DIR_PATH', SECURITY_COMPANION_INC_DIR_PATH . 'elementor-widgets/' );
}

// Define demo data dir path constant
if( ! defined( 'SECURITY_COMPANION_DEMO_DIR_PATH' ) ) {
    define( 'SECURITY_COMPANION_DEMO_DIR_PATH', SECURITY_COMPANION_INC_DIR_PATH . 'demo-data/' );
}


$current_theme = wp_get_theme();

$is_parent = $current_theme->parent();

if( ( 'Security' ==  $current_theme->get( 'Name' ) ) || ( $is_parent && 'Security' == $is_parent->get( 'Name' ) ) ) {
    require_once SECURITY_COMPANION_DIR_PATH . 'security-init.php';
} else {

    add_action( 'admin_notices', 'security_companion_admin_notice', 99 );
    function security_companion_admin_notice() {
        $url = 'https://wordpress.org/themes/security/';
    ?>
        <div class="notice-warning notice">
            <p><?php printf( __( 'In order to use the <strong>Security Companion</strong> plugin you have to also install the %1$sSecurity Theme%2$s', 'security-companion' ), '<a href="' . esc_url( $url ) . '" target="_blank">', '</a>' ); ?></p>
        </div>
        <?php
    }
}
