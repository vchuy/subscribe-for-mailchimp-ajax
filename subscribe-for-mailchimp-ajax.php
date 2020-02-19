<?php
/**
 * Plugin Name: Subscribe for mailchimp ajax
 * Description: Plugin to display reviews about freelancer
 * Plugin URI:  https://www.vchuy-develop.com/subscribe-for-mailchimp-ajax/
 * Author URI:  https://www.vchuy-develop.com/
 * Author:      v.chuy
 * Version:      1.00
 *
 * Text Domain: sfma
 * Domain Path: /languages
 *
 *
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 *
 *
 */


include_once( plugin_dir_path( __FILE__ ) . 'backend/settings.php' );


include_once( plugin_dir_path( __FILE__ ) . 'backend/api.php' );


include_once( plugin_dir_path( __FILE__ ) . 'frontend/form.php' );



$enable_css = get_option( 'enable_css_sfma' );

if ($enable_css == 'disable' )  {

add_action( 'wp_enqueue_scripts', 'scripts_sfma', 999 );

function scripts_sfma() {

    wp_enqueue_style( 'style-sfma', plugin_dir_url(__FILE__ ) . 'frontend/assets/css/style.css', array(), '1.0.0');

}

} else {

    function custom_scripts_sfma()
    {
        $enable_custom_css = get_option( 'custom_css_code_sfma' );

        $sfma_custom_css = '<style  id="sfma-custom-css">' . $enable_custom_css . '</style>';

        echo $sfma_custom_css;

    }


    add_action('wp_head', 'custom_scripts_sfma');

}



/**
 * Enqueue scripts and styles for admin panel.
 */
add_action( 'admin_enqueue_scripts', 'sfma_options_page_style', 99 );
function sfma_options_page_style( ){


        wp_enqueue_style( 'sfma-options', plugin_dir_url(__FILE__ ) . 'backend/css/sfma-options.css' );




}

