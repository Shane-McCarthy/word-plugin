<?php
/*
Plugin Name: S Thomas's Browser Detector Plugin
Plugin URI:
Description: This plugin will store the user agents for later parsing and display
Author: S Thomas
Version: 1.0
Author URI:
 */

function bdetector_activate (){
    global $wpdb ;
    $table_name = $wpdb->prefix . "bdetector";
    if ($wpdb->get_var('SHOW TABLES LIKE '. $table_name) != $table_name)
    {
        $sql = 'CREATE TABLE '. $table_name. '(
        id INTEGER (10) UNSIGNED AUTO_INCREMENT,
        hit_date  TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,
        user_agent VARCHAR (255) ,
        PRIMARY KEY (id) )';
        require_once(ABSPATH. 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
        add_option('bdetector_database_version','1.0');
    }
}
register_activation_hook(__FILE__, 'bdetector_activate');

function bdetector_insert_useragent (){
    global $wpdb ;

    $table_name = $wpdb->prefix . "bdetector";
// the array on the end checks to see if it is a string and not a spoof.
    // make sure to use the 'prepare' statement if you are using SELECT.
    $wpdb->insert($table_name, array('user_agent'=>$_SERVER['HTTP_USER_AGENT']),array('%s'));

}


add_action('wp_footer','bdetector_insert_useragent');