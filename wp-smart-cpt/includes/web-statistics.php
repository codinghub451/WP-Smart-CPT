<?php
if (!current_user_can('manage_options')) {
    wp_send_json_error('You do not have sufficient permissions to access this page.');
}

$custom_post_types = get_option('custom_post_types', array());
$total_cpts = count($custom_post_types);

$total_posts = 0;
$category_counts = array();
$user_post_counts = array();

foreach ($custom_post_types as $cpt_name => $cpt_data) {
    $args = array(
        'post_type' => $cpt_name,
        'post_status' => 'publish',
        'posts_per_page' => -1
    );
    $query = new WP_Query($args);
    $post_count = $query->found_posts;
    $total_posts += $post_count;

    $args = array(
        'post_type' => $cpt_name,
        'posts_per_page' => -1,
    );
    $posts = get_posts($args);

    foreach ($posts as $post) {
        $post_categories = wp_get_post_categories($post->ID);
        foreach ($post_categories as $category_id) {
            $category = get_category($category_id);
            if (isset($category_counts[$category->name])) {
                $category_counts[$category->name] += 1;
            } else {
                $category_counts[$category->name] = 1;
            }
        }

        $post_author = get_userdata($post->post_author);
        $author_name = $post_author->display_name;
        if (isset($user_post_counts[$author_name][$cpt_name])) {
            $user_post_counts[$author_name][$cpt_name] += 1;
        } else {
            $user_post_counts[$author_name][$cpt_name] = 1;
        }
    }
}

echo '<h2>Plugin Statistics</h2>';
echo '<p>Total Custom Post Types: ' . $total_cpts . '</p>';
echo '<p>Total Posts: ' . $total_posts . '</p>';

if (!empty($category_counts)) {
    echo '<h3>Category Statistics</h3>';
    echo '<ul>';
    foreach ($category_counts as $category_name => $category_count) {
        echo '<li>' . $category_name . ': ' . $category_count . '</li>';
    }
    echo '</ul>';
} else {
    echo '<p>No categories found.</p>';
}

if (!empty($user_post_counts)) {
    echo '<h3>User Post Counts</h3>';
    echo '<table>';
    echo '<tr>
            <th>User</th>
            <th>Custom Post Type</th>
            <th>Post Count</th>
        </tr>';
    foreach ($user_post_counts as $author_name => $cpt_counts) {
        foreach ($cpt_counts as $cpt_name => $count) {
            echo '<tr>';
            echo '<td>' . $author_name . '</td>';
            echo '<td>' . $cpt_name . '</td>';
            echo '<td>' . $count . '</td>';
            echo '</tr>';
        }
    }
    echo '</table>';
} else {
    echo '<p>No user post counts found.</p>';
}
