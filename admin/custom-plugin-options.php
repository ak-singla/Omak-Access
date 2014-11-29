<?php


/*
Create Menu Page
*************************************/
add_action('admin_menu', 'omakaccess_my_plugin_menu');
function omakaccess_my_plugin_menu() {
	global $default; 
	// Page Title, Page Menu Name, Capability, 'Admin Page Unique Slug, Fallback 
	// http://codex.wordpress.org/Function_Reference/add_options_page
	if( if_this_is_omak_user() ) {
		add_menu_page( $default['pluginPageTitle'], $default['pluginMenuTitle'], 'manage_options', $default['pluginSlug'], 'omakaccess_my_plugin_options');
	}
	
	//call register settings function
	add_action( 'admin_init', 'omakaccess_register_settings' ); 
}

/*
Create Plugin Link in the Toolbar
*************************************/	
add_action( 'admin_bar_menu', 'omakaccess_toolbar_link_to_slick_popup', 999 );
function omakaccess_toolbar_link_to_slick_popup( $wp_admin_bar ) {
	
	if( if_this_is_omak_user() ) {
		global $default; 
		$args = array(
			'id'    => $default['pluginId'],
			'title' => $default['pluginTitle'],
			'href'  => admin_url('admin.php?page=' .$default['pluginSlug']),
			'meta'  => array( 'class' => 'my-toolbar-page' )
		);
		$wp_admin_bar->add_node( $args );
	}
	if( !if_this_is_omak_user() ) {
		global $default; 
		$args = array(
			'id'    => 'theme-options-in-toolbar',
			'title' => 'Theme Options',
			'href'  => admin_url('themes.php?page=options-framework'),
			'meta'  => array( 'class' => 'my-toolbar-page' )
		);
		$wp_admin_bar->add_node( $args );
	}
}


/*
Tell where is our admin page
*************************************/
function omakaccess_my_plugin_options(){
    include('plugin-options.php');
} 
?>