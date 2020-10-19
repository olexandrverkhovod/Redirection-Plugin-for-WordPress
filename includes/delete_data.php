<?php
add_action('wp_ajax_rp_delete', 'rp_delete_callback');
add_action('wp_ajax_nopriv_rp_delete', 'rp_delete_callback');
function rp_delete_callback() {
    
    global $wpdb;
    $tablename=$wpdb->prefix.'rplugin';

    $data=array(
        'id' => $_POST['id']);

        
     $wpdb->delete($tablename, $data);

	wp_die();
}