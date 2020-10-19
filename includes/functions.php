<?php

/**
 * Register menu item
 * */
add_action('admin_menu', 'redirectionPluginAdminMenuSetup');

function redirectionPluginAdminMenuSetup() {
    add_submenu_page(
        'tools.php',               // $parent_slug
        'RedirectPlugin Settings', // $page_title
        'RedirectPlugin Settings', // $menu_title
        'manage_options',          // $capability
        'redirection-plugin2',      // $menu_slug
        'RPAdminPageScreen'        // $function
    );
}

/**
 * Settings link in plugin management screen
 * */
function rpSettingsLink($actions, $file) {
    if (false !== strpos($file, 'redirection-plugin2')) {
        $actions['settings'] = '<a href="tools.php?page=redirection-plugin2">Settings</a>';
    }
    return $actions;
}

add_filter('plugin_action_links', 'rpSettingsLink', 2, 2);

/**
 * Load needed styles and scripts
 * */
add_action('admin_enqueue_scripts', 'rpScripts');
function rpScripts($hook) {
    if($hook == 'tools_page_redirection-plugin2') {
        wp_enqueue_script('bootstrapJS', RP_URL.'assets/js/bootstrap.js', array('jquery'));
        wp_enqueue_script('sweetalertJS', RP_URL.'assets/js/sweetalert.min.js', array('jquery'));
        wp_enqueue_script('amwAdminJS', RP_URL.'assets/js/rp-admin.js', array('jquery', 'wp-util'));

        wp_enqueue_style('bootstrapCSS', RP_URL.'assets/css/bootstrap.css');
        wp_enqueue_style('bootstrapResponsiveCSS', RP_URL.'assets/css/bootstrap-responsive.css');
        wp_enqueue_style('amwStyleCSS', RP_URL.'assets/css/rp-style.css');
    }
}
