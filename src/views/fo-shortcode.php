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

?><div id="<?= esc_attr($props->id) ?>" </div>
	<p>Would you like to see some API data?</p>
	<?php
	// $url = 'https://api.sampleapis.com/coffee/hot';
	$options = get_option('plugin-fo-settings');
	// $url = $options['api_endpoint'];
	$url = $options['api_endpoint'];
	if (filter_var($url, FILTER_VALIDATE_URL) === false) {
		$url = '';
	}
	// if (empty($url)) {
	//     $url = 'https://api.sampleapis.com/coffee/hot';
	// }

	// var_dump($url);
	// var_dump($options);
	echo $url;
	// https://developer.wordpress.org/reference/functions/wp_remote_get/.
	$plugin_fo_settings_page = admin_url('options-general.php?page=plugin-fo');
	$plugin_fo_settings_page_link = '<a href="' . $plugin_fo_settings_page . '">API endpoint</a>';
	$response = wp_remote_get($url, array(
		'headers' => array(
			'Accept' => 'application/json',
		)
	));
	$message  = 'Here\'s the API response:';
	if (is_wp_error($response)) {
		$message = 'Sorry, but it\'s an error:';
		$content = $response->get_error_message();
		$content .= ' Did you set an ' . $plugin_fo_settings_page_link . '?';
	} else {
		$content = wp_remote_retrieve_body($response);
		var_dump($content);
		$content = wp_json_encode(json_decode($content), JSON_PRETTY_PRINT);

		// if ( ( !is_wp_error($response)) && (200 === wp_remote_retrieve_response_code( $response ) ) ) {
		$content = json_decode($response['body']);
		if (json_last_error() === JSON_ERROR_NONE) {
			//Do your thing.
		}
		// }
	}

	?>
	<p><?= esc_html($message) ?></p>
	<pre>Content: <?= $content ?></pre>
	<?php
