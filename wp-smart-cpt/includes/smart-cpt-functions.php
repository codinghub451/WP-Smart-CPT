<?php

// Load Scripts and Stylings

function smart_cpt_scripts()
{
    wp_enqueue_style('smart-styling', plugins_url('/assets/css/cpt-style.css', __DIR__));
    wp_register_script('custom-script', plugins_url('/assets/js/cpt-script.js', __DIR__), array('jquery'), '1.0', true);
    // Localize script
    wp_localize_script('custom-script', 'ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('ajax-nonce')
    ));
    wp_enqueue_script('custom-script');
}
add_action('admin_enqueue_scripts', 'smart_cpt_scripts');

// Load Dashicons

function enqueue_dashicons()
{
    wp_enqueue_style('dashicons');
}
add_action('admin_enqueue_scripts', 'enqueue_dashicons');

function cpt_settings_menu()
{

    add_menu_page(
        'CPT Generator',
        'CPT Generator',
        'edit_posts',
        'wp-smart-cpt',
        'register_custom_menu',
        'dashicons-book-alt'

    );
}
function register_custom_menu()
{
    require_once(plugin_dir_path(__DIR__) . 'src/cpt-settings.php');
}
add_action('admin_menu', 'cpt_settings_menu');
