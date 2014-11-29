<?php
	
	global $access_control_setting_fields, $setting_fields, $icons;
	
	// Register Social Icons Fields
	$icons = array( 'fb', 'twitter', 'gplus', 'linkedin', 'rss', 'website' );		

	// For Main Settings
	$setting_fields = array( 
		'a' => array(
			'name' => 'plugin_activation',
			'title' => 'Plugin Activation',
		),
		'b' => array(
			'name' => 'background_color',
			'title' => 'Background Color',
		),
		'c' => array(
			'name' => 'font_color',
			'title' => 'Font Color',
		),
		'd' => array(
			'name' => 'link_color',
			'title' => 'Link Color',
		),
		'e' => array(
			'name' => 'html_editor',
			'title' => 'HTML Input',
		),
		'f' => array(
			'name' => 'custom_css',
			'title' => 'Custom CSS',
		),
	);
	// Settings Field For Access Control
	$access_control_setting_fields = array( 
		'a' => array(
			'name' => 'plugin_or_theme',
			'title' => 'Plugin Or Theme',
		),
		
		'b' => array(
			'name' => 'restrict_acf_access',
			'title' => 'Restrict ACF Access',
		),
		'c' => array(
			'name' => 'block_admin_access',
			'title' => 'Block Admin Access',
		),
		'd' => array(
			'name' => 'wp_core_updates',
			'title' => 'WP Core Updates',
		),
		'e' => array(
			'name' => 'plugin_updates',
			'title' => 'Plugin Updates',
		),
		'f' => array(
			'name' => 'all_wp_updates',
			'title' => 'All WP Updates',
		),
	);

?>