<?php
    function redirection() {
        $curentSlug = get_post_field('post_name');
        global $wpdb;
        $tablename=$wpdb->prefix.'rplugin';
        $DB_getSlug=$wpdb->get_var("SELECT COUNT(*) FROM $tablename WHERE slug='$curentSlug'");
        if($DB_getSlug == 1){
            $db_results=$wpdb->get_row("SELECT * FROM $tablename WHERE slug='$curentSlug'");
            if (($db_results->status) == 1){
                $cookie_name = $db_results->cookie;
                $page_slug = $db_results->slug;
                $url = $db_results->url;
                if (!empty($url) && is_page( $page_slug ) && isset($_COOKIE[$cookie_name])) {
                    wp_redirect( $url, 301 ); 
                    exit;
                }
            }
        }
    }
    add_action('template_redirect', 'redirection');