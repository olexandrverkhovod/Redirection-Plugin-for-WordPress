<?php

if (!defined('WP_UNINSTALL_PLUGIN')) exit;
// delete database table
global $wpdb;
$table_name = $wpdb->prefix .'rplugin';
$wpdb->query("DROP TABLE IF EXISTS {$table_name}");