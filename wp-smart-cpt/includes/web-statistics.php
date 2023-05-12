<h2>Website creation date:</h2> <?php echo mysql2date('l, F j, Y', get_user_option('user_registered', 1)); ?>
<?php $theme = wp_get_theme();
if ($theme->exists()) { ?>
    <table>
        <h2>Active Theme Information:</h2>
        <tr>
            <th>Theme Name</th>
            <th>Theme Text Domain</th>
            <th>Theme Url</th>
        </tr>
        <tr>
            <td><?php echo $theme->get('Name'); ?></td>
            <td><?php echo $theme->get('TextDomain'); ?></td>
            <td><?php echo $theme->get('ThemeURI'); ?></td>
        </tr>
    </table>
<?php
}
$wp_roles = wp_roles();
$result   = count_users();
?>
<h2>Users:</h2>
<table>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
    </tr>
    <?php
    foreach ($result['avail_roles'] as $role => $count) {
        if (0 == $count)
            continue; //pass role none

        $args = array(
            'role' => $role
        );

        $users = get_users($args);
    ?>
        <tr>
            <td><?php
                foreach ($users as $user) {
                    echo esc_html($user->display_name);
                }
                ?></td>
            <td><?php echo $user->user_email; ?></td>
            <td><?php echo $wp_roles->role_names[$role]; ?></td>
        </tr>
    <?php
    }
    ?>
</table>
<?php

function shapeSpace_active_site_plugins()
{
    echo "<h2>Active Plugins:</h2>";
    $plugins = get_option('active_plugins');

    if ($plugins) {
        echo '<table>
                <tr>
                    <th>Plugin Name</th>
                    <th>Plugin Author</th>
                </tr>';
        foreach ($plugins as $plugin) {
            $plugin_data = get_plugin_data(WP_PLUGIN_DIR . '/' . $plugin);

            echo '<tr>
                    <td>' . esc_html($plugin_data['Name']) . '</td>
                    <td>' . $plugin_data['Author'] . '</td>
                </tr>';
        }
        echo '</table>';
    }
}
shapeSpace_active_site_plugins();

$count = wp_count_comments();
echo "<h2>Comments:</h2>";
echo '<table>
                <tr>
                <th>Comments in moderation</th>
                <th>Comments approved</th>
                <th>Comments in Spam</th>
                <th>Comments in Trash</th>
                <th>Total Comments</th>
                </tr>';
echo '<tr>
                <td>' . $count->moderated      . '</td>
                <td>' . $count->approved       . '</td>
                <td>' . $count->spam           . '</td>
                <td>' . $count->trash          . '</td>
                <td>' . $count->total_comments . '</td>
                </tr>';
echo '</table>';

?>