<?php

/**
 * Reusable custom functions.
 *
 * @package Plugin_FO
 */

namespace Plugin_FO;

/**
 * Compile output for the given PHP file using $props for additional context.
 * NOTE: This function converts $props to an object with lowercase snake case keys when used by the rendered file. For example, ['my-key' => 'the value'] becomes (object) ['my_key' => 'the value']. This is done for consistency, readability, and ergonomics.
 *
 * @param string       $file  Path to view file relative to 'src' directory. Example: 'views/my-shortcode.php'.
 * @param array|object $props Associative array of variable names and values available to the file as an object.
 * @return string The rendered HTML.
 */
function render(string $file, $props) { // phpcs:ignore Generic.CodeAnalysis.UnusedFunctionParameter.FoundAfterLastUsed
	$file = PLUGIN_SRC_DIR . $file;

	if (is_array($props)) {
		$keys  = array_map(
			fn ($key) => strtolower(str_replace('-', '_', $key)),
			array_keys($props)
		);
		$props = (object) array_combine($keys, array_values($props));
	}

	ob_start(); // https://www.php.net/manual/en/function.ob-start.php.
	include $file;
	$html = ob_get_clean(); // https://www.php.net/manual/en/function.ob-get-clean.php.

	// Allow inline script tags in the sanitized HTML.
	$post_allowed_html           = wp_kses_allowed_html('post');
	$post_allowed_html['script'] = array(
		'type' => true,
	);

	return wp_kses($html, $post_allowed_html); // https://developer.wordpress.org/reference/functions/wp_kses/.
}
