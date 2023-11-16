<?php

/**
 * Shortcode content for [fo-shortcode].
 * $props is provided to this file by the `render()` function.
 *
 * @package Plugin_FO
 */

namespace Plugin_FO;

if (!defined('WPINC')) {
	die('Access denied.');
}

wp_enqueue_style(
	PLUGIN_KEY . '-fo-shortcode-style',
	PLUGIN_SRC_URL . 'assets/css/fo-shortcode.css',
	array(),
	filemtime(PLUGIN_SRC_DIR . 'assets/css/fo-shortcode.css')
);

?><div id="<?= esc_attr($props->id) ?>">Hello, WordPress!</div>
<p>Would you like to see some API data?</p>
<?php
// $url = 'https://api.sampleapis.com/coffee/hot';
$url = get_option('api_endpoint');
// if (empty($url)) {
//     $url = 'https://api.sampleapis.com/coffee/hot';
// }

// https://developer.wordpress.org/reference/functions/wp_remote_get/.
$plugin_fo_settings_page = admin_url('options-general.php?page=fo_settings_page');
$plugin_fo_settings_page_link = '<a href="' . $url . '">Plugin FO settings page</a>';
$response = wp_remote_get($url);
$message  = 'Here\'s the API response:';
if (is_wp_error($response)) {
	$message = 'Sorry, but it\'s an error. Did you enter a valid API endpoint in ' . $plugin_fo_settings_page_link . '? Error: ';
	$content = $response->get_error_message();
} else {
	$content = wp_remote_retrieve_body($response);
	$content = wp_json_encode(json_decode($content), JSON_PRETTY_PRINT);
}

?>
<p><?= esc_html($message) ?></p>
<pre><?= esc_html($content) ?></pre>
<?php
