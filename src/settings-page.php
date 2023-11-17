<?php

/**
 * Settings page for the plugin.
 *
 * @package    Plugin_FO
 */

namespace Plugin_FO;

// Register a WordPress admin settings page with a single text field named "API_Endpoint".
add_action(
	'admin_menu',
	function () {
		add_options_page(
			'Plugin FO Settings',
			'Plugin FO',
			'manage_options',
			'plugin-fo',
			function () {
				// check if the user have submitted the settings
				// WordPress will add the "settings-updated" $_GET parameter to the url
				if (isset($_GET['settings-updated'])) {
					// add settings saved message with the class of "updated"
					$home = get_home_url();
					$home_link = '<a href="' . $home . '">demo</a>';
					add_settings_error('plugin_fo_messages', 'plugin_fo_message', 'Return to the ' . $home_link, 'updated');
					var_dump(get_option('plugin-fo-settings'));
				}

				// show error/update messages
				settings_errors('plugin_fo_messages');

?>
		<div class="wrap">
			<h1><?php esc_html_e('Plugin FO Settings', 'plugin-fo-textdomain'); ?></h1>
			<form method="post" action="options.php">
				<?php
				settings_fields('plugin-fo-settings');
				do_settings_sections('plugin-fo-settings');
				submit_button();
				?>
			</form>
		</div>
	<?php
			}
		);
	}
);

// Register a WordPress settings field and section for the API_Endpoint field.
add_action(
	'admin_init',
	function () {
		register_setting(
			'plugin-fo-settings',
			'plugin-fo-settings',
			function ($input) {
				$input['api_endpoint'] = sanitize_text_field($input['api_endpoint']);
				return $input;
			}
		);
		add_settings_section(
			'plugin-fo-settings',
			'Plugin FO Settings',
			function () {
				esc_html_e('Enter an API endpoint below.', 'plugin-fo-textdomain');
				echo ' Try <a href="https://any-api.com/">Any API</a>.';
			},
			'plugin-fo-settings'
		);
		add_settings_field(
			'api_endpoint',
			'API Endpoint',
			function () {
				$options = get_option('plugin-fo-settings');
	?>
		<input type="text" name="plugin-fo-settings[api_endpoint]" value="<?php echo esc_attr($options['api_endpoint'] ?? ''); ?>" />
<?php
			},
			'plugin-fo-settings',
			'plugin-fo-settings'
		);
	}
);
