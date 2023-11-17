<?php

/**
 * Demo content for ease of code review.
 *
 * @package Plugin_FO
 */

namespace Plugin_FO;

if (!defined('ABSPATH')) {
	die('We\'re sorry, but you can not directly access this file.');
}

if ('local' !== wp_get_environment_type() || strpos(get_site_url(), 'localhost') === false) {
	// Return early if this file is not running in a local developer environment for WordPress.
	return;
}

add_action('init', 'Plugin_FO\create_demo_content');


// Create some content.
function create_demo_content(): void {
	// Create a demo page for the plugin and show links to the other demo posts.
	$demo_page_id = create_plugin_demo_page();

	// Only set the home page to the demo page if the site uses a default WordPress theme.
	if (site_uses_default_theme() && get_option('page_on_front') !== $demo_page_id) {
		// Assign the demo post to the site's home page.
		update_option('show_on_front', 'page');
		update_option('page_on_front', $demo_page_id);
	}
}

/**
 * Create a demo post for the custom post type.
 *
 * @param array $content_links An array of links to add to the demo post content.
 * @return int The ID of the demo post.
 */
function create_plugin_demo_page(): int {
	$demo_page_title = 'Hello Forum One!';
	$query           = new \WP_Query(
		array(
			'title'          => $demo_page_title,
			'post_type'      => 'page',
			'post_status'    => 'any',
			'posts_per_page' => 1,
			'fields'         => 'ids',
		)
	);

	if ($query->posts) {
		return $query->posts[0];
	}

	$demo_page = array(
		'post_title'   => $demo_page_title,
		'post_type'    => 'page',
		'post_author'  => 1,
		'post_status'  => 'publish',
		'post_content' => '<!-- wp:paragraph -->
<p>This plugin provides a shortcode named "fo-shortcode". The output is shown below:</p>
<!-- /wp:paragraph -->
<!-- wp:shortcode -->
[fo-shortcode]
<!-- /wp:shortcode -->',
	);

	return wp_insert_post($demo_page);
}

/** Whether the current site is using a default WordPress theme. */
function site_uses_default_theme() {
	$current_theme      = wp_get_theme();
	$wp_themes          = array('Twenty Twenty', 'Twenty Twenty-One', 'Twenty Twenty-Two', 'Twenty Twenty-Three', 'Twenty Twenty-Four');
	$current_theme_name = $current_theme->get('Name');
	return in_array($current_theme_name, $wp_themes, true);
}
