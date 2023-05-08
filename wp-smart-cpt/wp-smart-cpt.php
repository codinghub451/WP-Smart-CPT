<?php
/*
 * Plugin Name:       Smart CPT
 * Plugin URI:        https://infinitysolutionz.com/
 * Description:       Handle the basics with this plugin.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Haseeb Abbas
 * Author URI:        https://infinitysolutionz.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       wp-smart-cpt
 */

// Define constants

define('SMART_SEARCH_DIR', plugin_dir_path(__FILE__));
define('SMART_SEARCH_URL', plugin_dir_path(__DIR__));

// Include necessary files

require_once(SMART_SEARCH_DIR . 'includes/smart-cpt-ajax.php');
require_once(SMART_SEARCH_DIR . 'includes/smart-cpt-functions.php');
