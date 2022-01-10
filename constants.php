<?php
/*
 * Plugin setup
 *
 * @author     Ivijan-Stefan Stipic <creativform@gmail.com>
 * @since      2.0.0
*/

if ( ! defined( 'WPINC' ) ) { die( "Don't mess with us." ); }
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Find wp-admin file path
if ( strrpos(WP_CONTENT_DIR, '/wp-content/', 1) !== false) {
    $WP_ADMIN_DIR = substr(WP_CONTENT_DIR, 0, -10) . 'wp-admin';
} else {
    $WP_ADMIN_DIR = substr(WP_CONTENT_DIR, 0, -11) . '/wp-admin';
}
if (!defined('WP_ADMIN_DIR')) define('WP_ADMIN_DIR', $WP_ADMIN_DIR);

if(file_exists(WP_PLUGIN_DIR . '/cf-geoplugin'))
{
	// Main Plugin root
	if ( ! defined( 'CFGP_ROOT' ) )			define( 'CFGP_ROOT', WP_PLUGIN_DIR . '/cf-geoplugin' );
	// Main plugin file
	if ( ! defined( 'CFGP_FILE' ) )			define( 'CFGP_FILE', CFGP_ROOT . '/cf-geoplugin.php' );
} else {
	// Main Plugin root
	if ( ! defined( 'CFGP_ROOT' ) )		define( 'CFGP_ROOT', WP_CONTENT_DIR . '/plugins/cf-geoplugin' );
	// Main plugin file
	if ( ! defined( 'CFGP_FILE' ) )		define( 'CFGP_FILE', CFGP_ROOT . '/cf-geoplugin.php' );
}
// Current plugin version ( if change, clear also session cache )
$cfgp_version = NULL;
if(file_exists(CFGP_FILE))
{
	if(function_exists('get_file_data') && $plugin_data = get_file_data( CFGP_FILE, array('Version' => 'Version'), false ))
		$cfgp_version = $plugin_data['Version'];
	if(!$cfgp_version && preg_match('/\*[\s\t]+?version:[\s\t]+?([0-9.]+)/i',file_get_contents( CFGP_FILE ), $v))
		$cfgp_version = $v[1];
}
if ( ! defined( 'CFGP_VERSION' ) )		define( 'CFGP_VERSION', $cfgp_version);

// Main website
if ( ! defined( 'CFGP_STORE' ) )		define( 'CFGP_STORE', 'https://cfgeoplugin.com');

// Includes directory
if ( ! defined( 'CFGP_INC' ) )			define( 'CFGP_INC', CFGP_ROOT . '/inc' );

// Classes directory
if ( ! defined( 'CFGP_CLASS' ) )		define( 'CFGP_CLASS', CFGP_INC . '/classes' );

// Main plugin name
if ( ! defined( 'CFGP_NAME' ) )			define( 'CFGP_NAME', 'cf-geoplugin');

// Plugin session prefix (controlled by version)
if ( ! defined( 'CFGP_PREFIX' ) )		define( 'CFGP_PREFIX', 'cf_geo_'.preg_replace("/[^0-9]/Ui",'',CFGP_VERSION).'_');

// Plugin file
if ( ! defined( 'CFGP_GPS_FILE' ) )		define( 'CFGP_GPS_FILE', __FILE__ );

// Plugin root
if ( ! defined( 'CFGP_GPS_ROOT' ) )		define( 'CFGP_GPS_ROOT', rtrim(plugin_dir_path(CFGP_GPS_FILE), '/') );

// Plugin Inc root
if ( ! defined( 'CFGP_GPS_INC' ) )		define( 'CFGP_GPS_INC', CFGP_GPS_ROOT . '/inc' );

// Plugin Classes root
if ( ! defined( 'CFGP_GPS_CLASS' ) )	define( 'CFGP_GPS_CLASS', CFGP_GPS_INC . '/classes' );

// Plugin URL root
if ( ! defined( 'CFGP_GPS_URL' ) )		define( 'CFGP_GPS_URL', rtrim(plugin_dir_url( CFGP_GPS_FILE ), '/') );

// Plugin URL root
if ( ! defined( 'CFGP_GPS_ASSETS' ) )	define( 'CFGP_GPS_ASSETS', CFGP_GPS_URL . '/assets' );

// Timestamp
if( ! defined( 'CFGP_GPS_TIME' ) )		define( 'CFGP_GPS_TIME', time() );

// Session
if( ! defined( 'CFGP_GPS_SESSION' ) )	define( 'CFGP_GPS_SESSION', 15 );

// Plugin name
if ( ! defined( 'CFGP_GPS_NAME' ) )		define( 'CFGP_GPS_NAME', 'cf-geoplugin-gps');

$cfgp_gps_version = NULL;
if(function_exists('get_file_data') && $plugin_data = get_file_data( CFGP_GPS_FILE, array('Version' => 'Version'), false ))
	$cfgp_gps_version = $plugin_data['Version'];
if(!$cfgp_gps_version && preg_match('/\*[\s\t]+?version:[\s\t]+?([0-9.]+)/i',file_get_contents( CFGP_GPS_FILE ), $v))
	$cfgp_gps_version = $v[1];
if ( ! defined( 'CFGP_GPS_VERSION' ) )	define( 'CFGP_GPS_VERSION', $cfgp_gps_version);

// Check if is multisite installation
if( ! defined( 'CFGP_GPS_MULTISITE' ) && defined( 'WP_ALLOW_MULTISITE' ) && WP_ALLOW_MULTISITE && defined( 'MULTISITE' ) && MULTISITE )			
{
	define( 'CFGP_GPS_MULTISITE', WP_ALLOW_MULTISITE );
}

if( ! defined( 'CFGP_GPS_MULTISITE' ) )			
{
    // New safer approach
    if( !function_exists( 'is_plugin_active_for_network' ) )
		include WP_ADMIN_DIR . '/includes/plugin.php';

	if(file_exists(WP_ADMIN_DIR . '/includes/plugin.php'))
		define( 'CFGP_GPS_MULTISITE', is_plugin_active_for_network( CFGP_GPS_ROOT . '/cf-geoplugin-gps.php' ) );
}

if( ! defined( 'CFGP_GPS_MULTISITE' ) ) define( 'CFGP_GPS_MULTISITE', false );