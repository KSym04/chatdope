<?php
// Check that we are uninstalling
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit();
}

global $wpdb;
$table_name = $wpdb->prefix . 'chatdope_messages';
$sql = "DROP TABLE IF EXISTS $table_name;";
$wpdb->query( $sql );
