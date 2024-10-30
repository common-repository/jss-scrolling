<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              www.js-ss.co.uk
 * @since             1.0.0
 * @package           Jss_Scrolling
 *
 * @wordpress-plugin
 * Plugin Name:       JSS Scrolling
 * Plugin URI:        www.js-ss.co.uk
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Nathanael Ainsworth
 * Author URI:        www.js-ss.co.uk
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       jss-scrolling
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-jss-scrolling-activator.php
 */
function activate_jss_scrolling() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-jss-scrolling-activator.php';
	Jss_Scrolling_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-jss-scrolling-deactivator.php
 */
function deactivate_jss_scrolling() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-jss-scrolling-deactivator.php';
	Jss_Scrolling_Deactivator::deactivate();
}

global $jsss_scrolling_db_version;
$jsss_scrolling_db_version = '1.0';

function jsss_scrolling_install() {
	global $wpdb;
	global $jsss_scrolling_db_version;

	$table_name = $wpdb->prefix . 'jsss_scrolling';
	
	$charset_collate = $wpdb->get_charset_collate();

/* {objectname:"parallax1",inneritem:"body",sizetype:"height",csseffect:"height",itemsize:"100"}, */

	$sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		rowhidden mediumint NOT NULL,
		pageid tinytext NOT NULL,
		objectname tinytext NOT NULL,
		effect tinytext NOT NULL,
		eventlength tinytext NOT NULL,
		pagelocation tinytext NOT NULL,
		pagelocationm tinytext NOT NULL,
		pagelocations tinytext NOT NULL,
		lockwith tinytext NOT NULL,
		lockstatus tinytext NOT NULL,
		UNIQUE KEY id (id)
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );

	add_option( 'jsss_scrolling_db_version', $jsss_scrolling_db_version );

  

$installed_ver = get_option( "jsss_scrolling_db_version" );

if ( $installed_ver != $jsss_scrolling_db_version ) {

	$table_name = $wpdb->prefix . 'jsss_scrolling';

	$sql = "CREATE TABLE $table_name ( 
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		rowhidden mediumint NOT NULL,
		pageid tinytext NOT NULL,
		objectname tinytext NOT NULL,
		effect tinytext NOT NULL,
		eventlength tinytext NOT NULL,
		pagelocation tinytext NOT NULL,
		pagelocationm tinytext NOT NULL,
		pagelocations tinytext NOT NULL,
		lockwith tinytext NOT NULL,
		lockstatus tinytext NOT NULL,
		UNIQUE KEY id (id)
	);";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );

	update_option( "jsss_scrolling_db_version", $jsss_scrolling_db_version );
}


function jsss_scrolling_update_db_check() {
    global $jsss_scrolling_db_version;
    if ( get_site_option( 'jsss_scrolling_db_version' ) != $jsss_scrolling_db_version ) {
        jsss_scrolling_install();
    }
}
add_action( 'plugins_loaded', 'jsss_scrolling_update_db_check' );


}

function jsss_scrolling_install_data() {
	global $wpdb;

	    $rowhidden = '0';
	    $pageid = '70';
		$objectname = 'example';
		$effect = 'pageholding';
		$eventlength = '1';
		$pagelocation = '0';
		$pagelocationm = '0';
		$pagelocations = '0';
		$lockwith = 'none';
		$lockstatus = 'unlocked';
		


	$table_name = $wpdb->prefix . 'jsss_scrolling';
	
	$wpdb->insert( 
		$table_name, 
		array( 
			'rowhidden'	=> $rowhidden,		
			'pageid' => $pageid,
			'objectname' => $objectname, 
			'effect' => $effect, 
			'eventlength' => $eventlength,
			'pagelocation' => $pagelocation, 
			'pagelocationm' => $pagelocationm,  
			'pagelocations' => $pagelocations,
			'lockwith' => $lockwith,
			'lockstatus' => $lockstatus,

		) 
	);
}


register_activation_hook( __FILE__, 'jsss_scrolling_install' );
register_activation_hook( __FILE__, 'jsss_scrolling_install_data' );

register_activation_hook( __FILE__, 'activate_jss_scrolling' );
register_deactivation_hook( __FILE__, 'deactivate_jss_scrolling' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-jss-scrolling.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_jss_scrolling() {

	$plugin = new Jss_Scrolling();
	$plugin->run();

}
run_jss_scrolling();
