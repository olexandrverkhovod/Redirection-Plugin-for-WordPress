<?php
/*
Plugin Name: Redirection plugin 2
Version: 1.1
Author: Verkhovod Aleksandr
License: GPL2
*/

/**
 * Ctreate custom table when plugin is activated
 */
function install(){
    global $wpdb;

    $RP_tb_name=$wpdb->prefix."rplugin";
    if($wpdb->get_var( "show tables like '$RP_tb_name'" ) != $RP_tb_name) 
    {
    $RP_query="CREATE TABLE $RP_tb_name (
        id int (100) NOT NULL,
        status varchar (100) DEFAULT '',
        cookie varchar (100) DEFAULT '',
        slug varchar (100) DEFAULT '',
        url varchar (100) DEFAULT ''
    )";

    require_once(ABSPATH ."wp-admin/includes/upgrade.php");
    dbDelta( $RP_query );
    }
}

/**
 * If this file is called directly, abort
 * */
if (!defined('WPINC')) {
    die;
}

/**
 * Define constants
 * */
define('RP_VERSION', '1.1');
define('RP_SITE_URL', $_SERVER['SERVER_NAME']);
define('RP_URL', plugin_dir_url(__FILE__));
define('RP_DIR', plugin_dir_path(__FILE__));
define('RP_VIEWS_DIR', RP_DIR.'/views/');

/**
 * Register hooks
 * */
register_activation_hook(__FILE__, 'rpLoad_activation');
register_activation_hook( __FILE__, 'install');

/**
 * Load neede files
 * */
function rpLoad(){
    require_once RP_DIR.'loaderFunc.php';
}

/**
 * Activation function
 * */
function rpLoad_activation() {
    // actions on activating plugin
}

add_action('init', 'rpLoad');

?>