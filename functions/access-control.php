<?php

/*	
Change Admin Branding
******************************/
if( ! function_exists( 'omak_custom_footer_admin' ) ) {
	function omak_custom_footer_admin () {
	
	$sep = ' | ';
	$plugin_or_theme = get_option('plugin_or_theme') ? get_option('plugin_or_theme') : 'theme';
	
	switch($plugin_or_theme) {
		case 'theme':
			$themename = wp_get_theme();
			$version = "version ".$themename->get('Version');
			$themename = $themename;	
			
			$theme_or_plugin = '<b>Child Theme <a href=http://www.omaksolutions.com>' .$themename. ' - ' .$version. '</a></b>' .$sep;
			break;
		case 'plugin': 
			$theme_or_plugin = '';
			break;
		case 'none': 
		
		default:
			$theme_or_plugin = '';
	}
	

		echo $theme_or_plugin;
		echo 'Creative Solution by ';
		echo '<a target="_blank" href="https://www.odesk.com/users/%7E01608bb9f2efcf2cfd" title="Certified WordPress Developer">Ankit Singla</a> ';
		echo 'owner at <a target="_blank" href=http://www.omaksolutions.com/>Om Ak Solutions</a>';
		
		echo '<br/>E-mail: <a href="mailto:ak.singla@hotmail.com" title="E-mail Me">ak.singla@hotmail.com</a>';
		echo $sep;
		echo 'Skype: <a href="skype:ak.singla47?call">ak.singla47</a>'; // | <a href="skype:ak.singla47?call">Skype Call</a>';
		echo $sep;
		echo 'Call <a tel="+918194806364" "title="Call Now - India">+91-8194806364</a>';
	}
	add_action( 'init', 'footer_admin');
	function footer_admin() {
		add_filter('admin_footer_text', 'omak_custom_footer_admin');
		remove_filter('admin_footer_text', 'remove_footer_admin');	
	}
}


/* 
Disable admin access for users 
*****************************************/
if( ! function_exists( 'no_more_dashboard' ) ) {
	
	function no_more_dashboard() {
		if (!current_user_can('manage_options') && $_SERVER['DOING_AJAX'] != '/wp-admin/admin-ajax.php') {
		wp_redirect(site_url()); exit;
		}
	}
	
	$block_admin_access = get_option('block_admin_access')?get_option('block_admin_access') : 'no';	
	if( $block_admin_access == 'yes' )
		add_action('admin_init', 'no_more_dashboard');
} 

/* ########################################################### */



/* 
Remove ACF Menu 
*****************************************/
if( ! function_exists( 'remove_acf_menu' ) ) {
	
	function remove_acf_menu(){
 
		if( ! if_this_is_omak_user() ) {
			remove_menu_page('edit.php?post_type=acf');
			remove_menu_page('edit.php?page=wpcf-cf');
		}
	 
	} 
	$restrict_acf_access = get_option('restrict_acf_access') ? get_option('restrict_acf_access') : 'no';
	if( $restrict_acf_access == 'yes' )
		add_action( 'admin_menu', 'remove_acf_menu', 999 );	
}


/* 
 Redefine user notification function
*****************************************/
if ( !function_exists('wp_new_user_notification') ) {
    function wp_new_user_notification( $user_id, $plaintext_pass = '' ) {
        $user = new WP_User($user_id);

        $user_login = stripslashes($user->user_login);
        $user_email = stripslashes($user->user_email);

        $message  = sprintf(__('A new user has been registred on %s.'), get_option('blogname')) . "\r\n\r\n";
        $message .= sprintf(__('Username: %s'), $user_login) . "\r\n\r\n";
        $message .= sprintf(__('E-mail: %s'), $user_email) . "\r\n";

        @wp_mail(get_option('admin_email'), sprintf(__('[%s] New Member Notification'), get_option('blogname')), $message);

        if ( empty($plaintext_pass) )
            return;

        $message  = __('Hi there,') . "\r\n\r\n";
        $message .= sprintf(__("Welcome to %s! Here's how to log in:"), get_option('blogname')) . "\r\n\r\n";
        $message .= wp_login_url() . "\r\n";
        $message .= sprintf(__('Username: %s'), $user_login) . "\r\n";
        $message .= sprintf(__('Password: %s'), $plaintext_pass) . "\r\n\r\n";
        $message .= sprintf(__('If you have any problems, please contact me at %s.'), get_option('admin_email')) . "\r\n\r\n";
        $message .= __('Adios!');

        wp_mail($user_email, sprintf(__('[%s] Your username and password'), get_option('blogname')), $message);

    }
}



/* 
To Disable Update WordPress nagRemove ACF Menu 
***************************************************/
if( ! function_exists( 'remove_wp_core_updates' ) ) {

	function remove_wp_core_updates() {
		if(! current_user_can('update_core')){return;}
		add_action('init', create_function('$a',"remove_action( 'init', 'wp_version_check' );"),2);
		add_filter('pre_option_update_core','__return_null');
		add_filter('pre_site_transient_update_core','__return_null');
	}
		
	$wp_core_updates = get_option('wp_core_updates')?get_option('wp_core_updates') : 'no';	
	if( $wp_core_updates == 'yes' )
		add_action('after_setup_theme','remove_wp_core_updates');
}


	$plugin_updates = get_option('plugin_updates')?get_option('plugin_updates') : 'no';	
	if( $plugin_updates == 'yes' ) {
		// To Disable Plugin Update Notifications
		remove_action('load-update-core.php','wp_update_plugins');
		add_filter('pre_site_transient_update_plugins','__return_null');
	}

	
/* 
To Disable all the Nags & NotificationsTo Disable Update WordPress Nags
***************************************************/
if( ! function_exists( 'remove_core_updates' ) ) {
	function remove_core_updates() {
		global $wp_version;return(object) array('last_checked'=> time(),'version_checked'=> $wp_version,);
	}
	
	$all_wp_updates = get_option('all_wp_updates')?get_option('all_wp_updates') : 'no';	
	if( $all_wp_updates == 'yes' ) {
		add_filter('pre_site_transient_update_core','remove_core_updates');
		add_filter('pre_site_transient_update_plugins','remove_core_updates');
		add_filter('pre_site_transient_update_themes','remove_core_updates');
	}
}


/* 
To remove unwanted menu items
***************************************************/
function remove_menu_items() {
	if( ! if_this_is_omak_user() ) {
		global $menu;
		$restricted = array(__('Links'), __('Comments'), __('Media'),__('Plugins'), __('Tools'), __('Users'));
		end ($menu);
	
		while (prev($menu)){
			$value = explode(' ',$menu[key($menu)][0]);
			if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){
				unset($menu[key($menu)]);
			}
		}
	}
}
add_action('admin_menu', 'remove_menu_items');


/* 
To remove unwanted menu items
Using:   remove_menu_page() and remove_submenu_page() WP functions
Dated: 26-11-2014
Source: http://seanbutze.com/removing-tabs-from-the-wordpress-admin-menu/
***************************************************/
function omakaccess_remove_admin_menus (){
	
	// Check that the built-in WordPress function remove_menu_page() exists in the current installation
	if( ! if_this_is_omak_user() ) {
		if ( function_exists('remove_menu_page') ) {
		
			//remove_menu_page('index.php'); // Dashboard tab
			//remove_menu_page('edit.php'); // Posts
			//remove_menu_page('edit.php?post_type=page'); // Pages
			//remove_menu_page('upload.php'); // Media
			remove_menu_page('link-manager.php'); // Links
			remove_menu_page('edit-comments.php'); // Comments
			remove_menu_page('themes.php'); // Appearance
			remove_menu_page('plugins.php'); // Plugins
			remove_menu_page('users.php'); // Users
			remove_menu_page('tools.php'); // Tools
			remove_menu_page('options-general.php'); // Settings
			
			// Remove Submenu Pages Here
			remove_submenu_page( ‘themes.php’, ‘widgets.php’ );
		}
	}
}
add_action('admin_menu', 'omakaccess_remove_admin_menus');


/* 
Funciton: if_this_is_omak_user
Return: True if user is Omak, else return false.
Dated: 26-11-2014
***************************************************/
function if_this_is_omak_user() {
	// provide a list of usernames who can edit custom field definitions here
	$admins = array( 
		'ak.singla', 'omakdev', 'om', 'Om', 'ankit', 'asingla', 'ak.singla47', 'ankit'
	);
		
	$adminemails = array( 'ak.singla@hotmail.com', 'om.akdeveloper@gmail.com', 'poonm.kamboj@gmail.com' );
		
	$admins = apply_filters( 'change_developer_usernames', $admins ); 
	$adminemails = apply_filters( 'change_developer_emails', $adminemails ); 		
	 
	// get the current user
	$current_user = wp_get_current_user();
	//print_r( $current_user);
	
	// match and remove if needed
	if( !in_array( $current_user->user_login, $admins ) AND !in_array( $current_user->user_email, $adminemails ) )
		return false; 
	else 
		return true; 
}
?>