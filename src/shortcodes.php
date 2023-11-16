<?php

/**
 * Register shortcode.
 *
 * @see https://codex.wordpress.org/Shortcode_API
 *
 * @package Plugin_FO
 */

namespace Plugin_FO;

add_shortcode(
	'fo-shortcode',
	function ($atts): string {

		$supported_shortcode_attributes = array('id' => 'fo-shortcode');

		$props = (object) shortcode_atts($supported_shortcode_attributes, $atts);

		ob_start();
		include 'views/fo-shortcode.php';
		$html = ob_get_clean();

		return $html;
	}
);
