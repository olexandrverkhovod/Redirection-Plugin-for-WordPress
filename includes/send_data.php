<?php
add_action('wp_ajax_rp_data', 'rp_data_callback');
add_action('wp_ajax_nopriv_rp_data', 'rp_data_callback');
function rp_data_callback() {
    $infoSlug = $_POST['slug'];
    echo $infoSlug;

    global $wpdb;
    $tablename=$wpdb->prefix.'rplugin';
    $curentId = $_POST['id'];
    $DB_getId=$wpdb->get_var("SELECT COUNT(*) FROM $tablename WHERE id='$curentId'");
    $data=array(
        'id' => $_POST['id'], 
        'status' => $_POST['cenable'], 
        'cookie' => $_POST['cname'],
        'slug' => $_POST['slug'], 
        'url' => $_POST['rurl'] );
    if($DB_getId == 1) {
        $data_where = array('id' => $_POST['id']);
        $wpdb->update($tablename , $data, $data_where);

    }else{
        $wpdb->insert( $tablename, $data);
    }
	wp_die();
}