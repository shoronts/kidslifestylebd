<?php
/**
 * Plugin Name: Kids Life Style BD Core
 * Plugin URI:  https://squaretechit.com/
 * Description: Helper plugin for the Kids Life Style theme.
 * Version:     1.0.0
 * Author:      Square Tech IT
 * Author URI:  https://squaretechit.com/
 * Text Domain: kidslifestylebd
 * License:     GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Elementor tested up to: 3.21.5
 */

if ( ! defined('ABSPATH') ) {
    exit; // Exit if accessed directly.
}

// Define Constants
define('KIDS_LIFE_STYLE_BD_VERSION', '1.0.0');
define('KIDS_LIFE_STYLE_BD_PLUGIN_FILE', __FILE__);
define('KIDS_LIFE_STYLE_BD_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('KIDS_LIFE_STYLE_BD_PLUGIN_URL', plugin_dir_url(__FILE__));
define('KIDS_LIFE_STYLE_BD_WIDGETS_PATH', plugin_dir_path(__FILE__) . 'widgets');

// Autoload Main Class
require_once KIDS_LIFE_STYLE_BD_PLUGIN_DIR . 'includes/class-plugin-loader.php';

// Run Plugin
\KidsLifeStyleBD\Plugin_Loader::init();
