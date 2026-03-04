<?php
/**
 * Fired during plugin deactivation
 *
 * @link       https://fabiodalez.it/
 * @since      3.0.0
 *
 * @package    FazCookie
 * @subpackage FazCookie/includes
 */

namespace FazCookie\Includes;

if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      3.0.0
 * @package    FazCookie
 * @subpackage FazCookie/includes
 * @author     Fabio D'Alessandro
 */
class Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    3.0.0
	 */
	public static function deactivate() {
		// Clear banner template cache.
		delete_option( 'faz_banner_template' );
		delete_transient( 'faz_scan_running' );

		// Unschedule retention cleanup cron.
		$timestamp = wp_next_scheduled( 'faz_daily_cleanup' );
		if ( $timestamp ) {
			wp_unschedule_event( $timestamp, 'faz_daily_cleanup' );
		}
	}

}
