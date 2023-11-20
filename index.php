<?php

/**
 * Plugin FO
 *
 * @package   Plugin_FO
 * @author    Jamie McKinnerney <jamie.mckinnerney@gmail.com>
 * @license   GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       Plugin FO
 * Plugin URI:        https://github.com/himeylo/plugin-fo
 * Description:       A Wordpress plugin gets and displays API data content.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      8.1
 * Author:            Jamie McKinnerney <jamie.mckinnerney@gmail.com>
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       plugin-fo-textdomain
 * Update URI:        https://github.com/himeylo/plugin-fo
 */

namespace Plugin_FO;

if (!defined('ABSPATH')) {
	die('We\'re sorry, but you can not directly access this file.');
}

// These constants are used by source files.
const PLUGIN_KEY                = 'plugin-fo';
const PLUGIN_FILE               = __FILE__;
const PLUGIN_SRC_DIR            = __DIR__ . '/src/';
// Using a function to define a constant. Only supported by the `define()` function.
define('Plugin_FO\PLUGIN_SRC_URL', plugins_url('src', __FILE__) . '/');

require 'src/demo.php';
require 'src/settings-page.php';
require 'src/shortcodes.php';
