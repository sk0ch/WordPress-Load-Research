<?php
/**
 * Plugin Name: WordPress Load Research
 * Plugin URI: http://skoch.com.ua/
 * Description: WordPress Load Research...
 * Author: Andrew Skochelias
 * Author URI: http://skoch.com.ua/
 * Text Domain: wp-load-research
 * Version: 1.0
 * Domain Path: /languages/
 * License: GPL v3
 */

/**
 * WordPress Load Research
 * Copyright (C) 2016, Andrew Skochelias - a.skoch@webolatory.com
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

defined( 'ABSPATH' ) || die;

if ( isset( $_GET['WP_Load_Research'] ) ) {
	require_once( 'classes/class.profiler.php' );
	error_log( 'test: ' . $_GET['WP_Load_Research'] );
	declare( ticks = 1 );
}

/**
 * Init
 * */
class WP_Load_Research {

    /**
     * @var array
     */
	public static $options = array();

	/**
	 * Constructor
	*/
	function __construct() {

		// Include classes
		require_once( 'classes/class.admin-page.php' );

		// Setup plugin data
		add_action( 'plugins_loaded', array( &$this, 'setup_plugin_data' ) );

	}

	/**
	 * Setup plugin data.
	 *
	 * @return void.
	 */
	public function setup_plugin_data() {

		// Load translate
		load_plugin_textdomain( 'wp-load-research', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

		// Get options
		self::$options = get_option( 'WP_Load_Research' );
	}

	/**
	 * Plugin Activation.
	 *
	 * @return void.
	 */
	public static function activation() {

		// Create "mu-plugins" directory 
		if ( ! file_exists( WPMU_PLUGIN_DIR ) && is_writable( dirname( WPMU_PLUGIN_DIR ) ) ) {
			wp_mkdir_p( WPMU_PLUGIN_DIR );
		}

		// Create mu-plugin
		if ( file_exists( WPMU_PLUGIN_DIR ) && is_writable( WPMU_PLUGIN_DIR ) ) {
			if ( file_exists( WP_PLUGIN_DIR . '/wp-load-research/classes/class.profiler.php' ) ) {
				file_put_contents( WPMU_PLUGIN_DIR . '/wp-load-research.php',
					"<?php\n@include_once( WP_PLUGIN_DIR . '/wp-load-research/classes/class.profiler.php' );\n" );
			}
		}
	}

	/**
	 * Plugin Uninstall.
	 *
	 * @return void.
	 */
	public static function deactivation() {
		
		// Remove mu-plugin
		if ( file_exists( WPMU_PLUGIN_DIR . '/wp-load-research.php' ) ) {
			if ( is_writable( WPMU_PLUGIN_DIR . '/wp-load-research.php' ) ) {
				unlink( WPMU_PLUGIN_DIR . '/wp-load-research.php' );
			}
		}
	}
}

new WP_Load_Research();

// Activation hook
register_activation_hook( __FILE__, array( 'WP_Load_Research', 'activation' ) );

// Deactivation hook
register_deactivation_hook( __FILE__, array( 'WP_Load_Research', 'deactivation' ) );
