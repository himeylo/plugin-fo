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

	$options = get_option('plugin-fo-settings');
	$url = $options['api_endpoint'];

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
		$returned = wp_remote_retrieve_body($response);
		$data = json_decode($returned);
		$content = wp_json_encode(json_decode($returned), JSON_PRETTY_PRINT);
	}

	if (!empty($data)) {
		$count = 0;
		echo '<p>Here are the top stories from the New York Times:</p>';
		echo '<div class="nytimes-top-stories" id="TopStories">';
		foreach ($data->results as $result) {
			if ($count >= 4) {
				break;
			}
			if (!empty($result->title)) {
				$pubDate = strtotime($result->published_date) < strtotime('-1 day') ? date("g:i a", strtotime($result->published_date)) : date("M j", strtotime($result->published_date));
				$media = $result->multimedia ? $result->multimedia[0]->url : '';

				echo '<div class="nytimes-top-story">';
				echo '<div class="nytimes-top-story__image" style="background-image: url(' . $media . ');" href="' . esc_url($result->url) . '"></div>';
				echo '<div class="nytimes-top-story__text">';
				if (null || "null" !== $result->url) {
					echo '<a href="' . esc_url($result->url) . '">';
				}
				echo '<h3>' . esc_html($result->title) . '</h3>';
				if (null || "null" !== $result->url) {
					echo '</a>';
				}
				echo '<span class="nytimes-top-story__section">' . esc_html($result->section) . '</span>';
				if ($result->published_date) :
					echo '<span class="nytimes-top-story__byline">' . $pubDate . '</span>';
				endif;
				echo '<p>' . esc_html($result->abstract) . '</p>';
				echo '</div>';
				echo '</div>';

				$count++;
			}
		}

		echo '</div>';
	}

	?>
	<p><?= esc_html($message) ?></p>
	<pre>Content: <?= $content ?></pre>
	<?php
