<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://redacademy.com/
 * @since             1.0.0
 * @package           Loan_Calculator
 *
 * @wordpress-plugin
 * Plugin Name:       Loan Calculator
 * Plugin URI:        http://redacademy.com/
 * Description:       This plugin will allow you to add a loan calculator to any page on your site. You can customize the interest rates, slider ranges, labels and pop-up content. Click “Loan Calculator” on the left hand menu to get started.
 * Version:           1.0.0
 * Author:            Red Academy
 * Author URI:        http://redacademy.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       loan-calculator
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-loan-calculator-activator.php
 */
function activate_loan_calculator() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-loan-calculator-activator.php';
    Loan_Calculator_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-loan-calculator-deactivator.php
 */
function deactivate_loan_calculator() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-loan-calculator-deactivator.php';
    Loan_Calculator_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_loan_calculator' );
register_deactivation_hook( __FILE__, 'deactivate_loan_calculator' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-loan-calculator.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_loan_calculator() {

    $plugin = new Loan_Calculator();
    $plugin->run();

}
run_loan_calculator();

// Function to create menu item for plugin
function loan_calculator_menu(){
    add_menu_page(
        'Loan Calculator',
        'Loan Calculator',
        'manage_options',
        'loan_calculator',
        'loan_calculator_admin',
        'dashicons-chart-bar',
        99
    );

    require_once('admin/partials/loan-calculator-settings.php');
}

add_action('admin_menu', 'loan_calculator_menu');


// Function called to display contents of plugin admin page
function loan_calculator_admin(){
    if (!current_user_can('manage_options')) {
        return;
    }
    require_once('admin/partials/loan-calculator-admin-display.php');
}

// Creating plugin shortcode

function generate_shortcode(){
    require_once('public/partials/loan-calculator-public-display.php');
}
add_shortcode('loan-calculator', 'generate_shortcode');

function unconfigured_lendified_plugin_notice() {

    $option = get_option('bwp_interest_min');
    if (!isset($option) || empty($option)) {
    $class = 'notice notice-info';
    $message = __( "Loan Calculator successfully activated, click <a href='admin.php?page=loan_calculator'>here</a> to configure your settings.", "sample-text-domain" );

    printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), $message);
    }
}
add_action( 'admin_notices', 'unconfigured_lendified_plugin_notice' );
?>
