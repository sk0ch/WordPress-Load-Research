<?php
/**
 * Profiler
 *
 * @file
 * @package		WordPress Load Research
 * @author		Andrew Skochelias
 */

defined( 'ABSPATH' ) || die();
/**
 * Class WP_Load_Research_Profiler.
 */
class WP_Load_Research_Profiler {

    /**
     * @var array
     */
    static private $_data = array();

    /**
     * @var array
     */
    static private $_functions = array();

	/**
	 * Construct
	*/
	function __construct() {

		declare( ticks = 1 );
		register_tick_function( array( __CLASS__, 'wp_load_research_process' ) );
		add_action( 'wp_footer', array( __CLASS__, 'show_log' ) );
	}

	/**
	 * Research process
	 *
	 * @return Void
	 */
	static function show_log() {
		
		echo '<WP_Load_Research>';
		echo '<pre>';
		var_dump( self::$_data );
		var_dump( self::$_functions );
		echo '</pre>';
	}
	/**
	 * Research process
	 *
	 * @return Void
	 */
	static function wp_load_research_process() {
		
		error_log( 'test go: ' . microtime( true ) . ' file: ' . $_SERVER['SCRIPT_FILENAME'] );
		self::$_data[] = array(
			'time' => microtime( true ),
			'file' => $_SERVER['SCRIPT_FILENAME'],
		);

		self::$_functions = debug_backtrace( true );
	}
}

new WP_Load_Research_Profiler();
