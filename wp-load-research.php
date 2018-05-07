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
	}

	/**
	 * Plugin Uninstall.
	 *
	 * @return void.
	 */
	public static function uninstall() {
	}
}

new WP_Load_Research();

// Activation hook
register_activation_hook( __FILE__, array( 'WP_Load_Research', 'activation' ) );

// Uninstall hook
register_uninstall_hook( __FILE__, array( 'WP_Load_Research', 'uninstall' ) );
