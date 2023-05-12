<?php

// Load Scripts and Stylings

function posts_style()
{
    wp_enqueue_style('smart-styling', plugins_url('/assets/css/posts-style.css', __DIR__));
}
add_action('wp_enqueue_scripts', 'posts_style');

// Save the custom post type information in the database when an AJAX call is made

function create_smart_cpt_handler()
{
    $cpt_name = $_POST['cpt_name'];
    $singular_name = $_POST['singular_name'];
    $cpt_description = $_POST['cpt_description'];
    $cpt_name_register = $_POST['cpt_regirter_name'];
    $cpt_menu_icon = $_POST['cpt_icon'];

    // Generate the singular name by appending "s" to the end of the CPT name

    $cpt_labels = array(
        'name'               => __($cpt_name),
        'singular_name'      => __($singular_name),
        'add_new'            => __('Add New ' . $singular_name),
        'add_new_item'       => __('Add New ' . $singular_name),
        'edit_item'          => __('Edit ' . $singular_name),
        'new_item'           => __('New ' . $singular_name),
        'all_items'          => __('All ' . $singular_name),
        'view_item'          => __('View ' . $singular_name),
        'search_items'       => __('Search ' . $singular_name),
    );
    $cpt_args = array(
        'labels'            => $cpt_labels,
        'description'       => $cpt_description,
        'public'            => true,
        'menu_position'     => 5,
        'supports'          => array('title', 'editor', 'thumbnail', 'excerpt', 'comments', 'custom-fields'),
        'has_archive'       => true,
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'query_var'         => true,
        'taxonomies'        => array('category'),
        'menu_icon'           => $cpt_menu_icon,
    );
    $custom_post_types = get_option('custom_post_types', array());
    $custom_post_types[$cpt_name_register] = $cpt_args;
    if (update_option('custom_post_types', $custom_post_types)) {
        echo $cpt_name." CPT Create Successfully!";
    }
    wp_die(); // This is necessary to terminate the AJAX request properly
}
add_action('wp_ajax_create_smart_cpt', 'create_smart_cpt_handler');
add_action('wp_ajax_nopriv_create_smart_cpt', 'create_smart_cpt_handler');

// Register all custom post types in the init hook

function register_custom_post_types()
{
    $custom_post_types = get_option('custom_post_types', array());
    foreach ($custom_post_types as $cpt_name_register => $cpt_args) {
        register_post_type($cpt_name_register, $cpt_args);
    }
}
add_action('init', 'register_custom_post_types');

// Delete CPT through AJAX

function delete_cpt()
{
    if (!current_user_can('manage_options')) {
        wp_send_json_error('You do not have sufficient permissions to access this page.');
    }

    $cpt_name = isset($_POST['cpt_name']) ? $_POST['cpt_name'] : '';
    $custom_post_types = get_option('custom_post_types', array());

    if (!empty($custom_post_types[$cpt_name])) {
        unset($custom_post_types[$cpt_name]);
        update_option('custom_post_types', $custom_post_types);
        unregister_post_type($cpt_name);
        wp_send_json_success('Custom Post Type has been deleted successfully');
    } else {
        wp_send_json_error('Custom Post Type not found');
    }
}
add_action('wp_ajax_delete_cpt', 'delete_cpt');

function display_custom_post_types()
{
    if (!current_user_can('manage_options')) {
        wp_send_json_error('You do not have sufficient permissions to access this page.');
    }

    $custom_post_types = get_option('custom_post_types', array());

    echo '<table>';
    echo '<tr><th>Name</th><th>Post Count</th><th>Categories</th><th>Shortcode</th><th>Action</th></tr>';

    foreach ($custom_post_types as $cpt_name => $cpt_data) {
        $args = array(
            'post_type' => $cpt_name,
            'post_status' => 'publish',
            'taxonomy' => 'category',
            'posts_per_page' => -1
        );
        $query = new WP_Query($args);
        $post_count = $query->found_posts;
        $cptName = ucwords(str_replace('-', ' ', $cpt_name));

        echo '<tr>';
        echo '<td>' . $cptName . '</td>';
        echo '<td>' . $post_count . '</td><td>';
        // Get all posts for the custom post type
        $args = array(
            'post_type' => $cpt_name,
            'posts_per_page' => -1,
        );
        $posts = get_posts($args);

        // Loop through each post and display its categories
        $categories = array();
        foreach ($posts as $post) {
            $post_categories = wp_get_post_categories($post->ID);
            foreach ($post_categories as $category_id) {
                $category = get_category($category_id);
                $categories[$category->name] = $category->count;
            }
        }

        // Loop through each category and display its name and post count
        foreach ($categories as $category_name => $category_count) {
            echo $category_name . '<br>';
        }
        '</td>';
        $shortcodename = preg_replace('/\s+/', '_', $cpt_name);
        echo '<td>' . $shortcodename . '-cpts</td>';
        echo '<td><a class="delete-cpt" data-cpt="' . $cpt_name . '">Delete</a></td>';
        echo '</tr>';
    }
    echo '</table>';
}
add_action('wp_ajax_display_custom_post_types', 'display_custom_post_types');

function delete_custom_post_type()
{
    if (!current_user_can('manage_options')) {
        wp_send_json_error('You do not have sufficient permissions to access this page.');
    }

    $cpt_name = $_POST['cpt_name'];
    $custom_post_types = get_option('custom_post_types', array());
    unset($custom_post_types[$cpt_name]);
    update_option('custom_post_types', $custom_post_types);
    unregister_post_type($cpt_name);
    wp_send_json_success('Custom Post Type has been deleted successfully');
}
add_action('wp_ajax_delete_custom_post_type', 'delete_custom_post_type');

// Display CPTs Posts with Shortcode

function register_cpt_shortcodes()
{
    require_once(plugin_dir_path(__FILE__) . '/cpt-shortcode-template.php');
}
add_action('init', 'register_cpt_shortcodes');
