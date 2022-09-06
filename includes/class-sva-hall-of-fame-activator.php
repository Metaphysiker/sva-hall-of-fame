<?php

/**
 * Fired during plugin activation
 *
 * @link       https://www.philosophische-insel.ch/
 * @since      1.0.0
 *
 * @package    Sva_Hall_Of_Fame
 * @subpackage Sva_Hall_Of_Fame/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Sva_Hall_Of_Fame
 * @subpackage Sva_Hall_Of_Fame/includes
 * @author     Sandro Räss <s.raess@me.com>
 */
class Sva_Hall_Of_Fame_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		global $wpdb;
		$table_name = $wpdb->prefix . 'svahalloffame';
		$charset_collate = $wpdb->get_charset_collate();

		$sql = "CREATE TABLE $table_name (
			id mediumint(9) NOT NULL AUTO_INCREMENT,
			year mediumint NOT NULL,
			category tinytext DEFAULT '' NOT NULL,
			winner mediumtext DEFAULT '' NOT NULL,
			url varchar(512) DEFAULT '' NOT NULL,
			ranking mediumint(9) NOT NULL,
			PRIMARY KEY  (id)
		) $charset_collate;";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
	}

}
