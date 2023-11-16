<?php

/**
 * Register the plugin's sitewide JS and CSS files.
 *
 * @package Plugin_FO
 */

namespace Plugin_FO;

add_action(
	'wp_enqueue_scripts',
	function () {
		wp_enqueue_script(
			PLUGIN_KEY . '-public',
			PLUGIN_SRC_URL . 'assets/js/public.js',
			array(),
			filemtime(PLUGIN_SRC_DIR . 'assets/js/public.js'),
			true
		);
		wp_enqueue_style(
			PLUGIN_KEY . '-public-style',
			PLUGIN_SRC_URL . 'assets/css/public.css',
			array(),
			filemtime(PLUGIN_SRC_DIR . 'assets/css/public.css')
		);
	}
);
