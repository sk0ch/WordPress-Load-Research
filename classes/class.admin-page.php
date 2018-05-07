<?php
/**
 * Admin page
 *
 * @file
 * @package		WordPress Load Research
 * @author		Andrew Skochelias
 */

defined( 'ABSPATH' ) || die();

/**
 * Class WordPress_View_Changelog_Class.
 */
class WP_Load_Research_Admin_page extends WP_Load_Research {

	/**
	 * Constructor
	*/
	function __construct() {

		add_action( 'admin_menu', 				array( __CLASS__, 'register_admin_page' ) );
		add_action( 'network_admin_menu', 		array( __CLASS__, 'register_admin_page' ) );
	}

	/**
	 * Register admin page
	 *
	 * @return Void
	 */
	static function register_admin_page() {

		add_submenu_page(
			'tools.php',
			__( 'WP Load Research' ),
			__( 'WP Load Research' ),
			'manage_options',
			'google_settings_page',
			array( __CLASS__, 'google_settings_page' )
		);
	}

	/**
	 * Show settings page
	 *
	 * @return Void
	 */
	static function google_settings_page() {
	}
}

new WP_Load_Research_Admin_page();
