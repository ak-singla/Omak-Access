<?php
 /*
 === [Omak Access] ===
 
Plugin Name:  Omak Access
Plugin URI:   http://www.omaksolutions.com
Description:  Access control plugin for custom websites. If you want this plugin to be enhanced or want to get created a new plugin, just contact the author. He will be more than happy to hear from you. <br/>E-mail at: <a href="mailto:ak.singla@hotmail.com">ak.singla@hotmail.com</a> | Skype: <a href="skype:ak.singla47?call">ak.singla47</a>
Author URI:   http://www.omaksolutions.com
Author:       Om Ak Solutions
Version:      0.1
*/


 /*  
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
    */
    
	$short_name = 'omakaccess';
	$caps_name = 'Omak Access';
    global $access_control_setting_fields, $setting_fields, $icons;
	
    global $dfault;	
	$default['pluginId'] = $short_name;
	$default['pluginTitle'] = $caps_name;
	$default['pluginSlug'] =  $short_name. '-options.php';
	$default['pluginSlugOnly'] = $short_name. '-options';
	$default['pluginPageTitle'] = $caps_name. ' Options';
	$default['pluginMenuTitle'] = $caps_name;
	
	global $default1;
	$default1['pluginId'] = 'pawslastpagecmb';
	$default1['pluginTitle'] = 'PawsLastPageCMB';
	$default1['pluginSlug'] = 'pawslastpagecmb-options.php';
	$default1['pluginSlugOnly'] = 'pawslastpagecmb-options';
	$default1['pluginPageTitle'] = 'PawsLastPageCMB Options';
	$default1['pluginMenuTitle'] = 'PawsLastPageCMB';

	$default1 = $default; 
	
	// Variable to choose from how to create options page
	$custom_options = true; 
	
	if (WP_DEBUG === true) {
        error_log( $default['pluginTitle']. " Plugin is installed.");
    }

	//include 'other-options.php';
	include 'functions/access-control.php';
	include 'functions/omaksociallinks.php';
	include 'admin/setting-fields.php';

/*
Activation Hook
*************************************/
register_activation_hook(__FILE__,'myplugin_install'); 
function myplugin_install(){
	// Empty Activation Hook
}


/*
Plugin Initiation
*************************************/
add_action('init','omakaccess_super_plugin_init');
function omakaccess_super_plugin_init(){
    add_the_meat();
}

/*
Add Admin Plugin Options Page Scripts
*************************************/
function enqueue_options_page_scripts($hook) {
	
	global $default; 
	$pageExpectedHook = 'toplevel_page_' .$default['pluginSlugOnly'];
	
	//print_r( $hook ); 
	if ( $pageExpectedHook != $hook ) {        
		return;
	}
		wp_register_style( 'admin-css', plugins_url( '/admin/admin-css.css', __FILE__ ) );
		wp_enqueue_style( 'admin-css' ); 
		
		wp_register_script( 'admin-js', plugins_url( '/admin/admin-custom.js', __FILE__ ) );
		wp_enqueue_script( 'admin-js' );    
}

/*
Register options/fields for settings page
*****************************************/
function omakaccess_register_settings() {
	
	global $default, $access_control_setting_fields, $setting_fields, $icons;
	
	add_settings_section(
		'layout_section',
		'Layout Settings',
		'layout_section_callback_function',
		'layout'
	);
	
	// Register Main Settings Field
	foreach( $setting_fields as $field ) {
		register_setting( $default['pluginId']. '-group', $field['name'] );
	}
	
	foreach( $icons as $icon ) {
		register_setting( $default['pluginId']. '-group', $icon. '_url' );
		register_setting( $default['pluginId']. '-group', $icon. '_alt' );
	}
	
	// Register Access Control Settings Field
	foreach( $access_control_setting_fields as $field ) {
		register_setting( $default['pluginId']. '-group', $field['name'] );
	}
	
} 




function add_my_code() {
	if( !is_admin() ) {
		$cf7_code = get_option('cf7_shortcode')?get_option('cf7_shortcode'):'[contact-form-7 id="142" title="Contact Page Form"]';
		$form_title = get_option('form_title')?get_option('form_title'):'Contact Us - We care to help!';
		$form_description = get_option('form_title')?get_option('form_title'):'Please fill our short form and one of our friendly team members will call you back.';
		$side_image = get_option('side_image')?get_option('side_image'):'have-a-query';
		?>
		<!-- Pop Up Box and Curtain Arrangement -->
			<div id="curtain" onClick="unloadPopupBox();" style=""></div>
			<div id="popup_box">  
				<div id="popup_title">
					<?php echo $form_title; ?>
				</div>
				<div id="form_container">
					<p id="popup_description">
						<?php echo $form_description; ?>
					</p>
					
					<?php
						//echo $cf7_code; 
						echo do_shortcode($cf7_code); 
					?>
				</div>
				<!--<div class="success" style="display: none;">Successfully Submitted ...</div>-->
			   <a id="popupBoxClose" onClick="unloadPopupBox();">X</a>  
			</div>
			<div  class="side-enquiry-holder">
				<a onClick="loadPopupBox();" class="side-enquiry <?php echo $side_image; ?>">Have a query?</a>
			</div>
			<!-- Pop Up Box and Curtain Arrangement -->
<?php
	}
}

function omakaccess_option_css() {
	
	$use_background_color = get_option('use_background_color')?get_option('use_background_color'): false;
	$use_font_color = get_option('use_font_color')?get_option('use_font_color'): false;
	$use_link_color = get_option('use_link_color')?get_option('use_link_color'): false;
	
	$custom_css = get_option('custom_css')?get_option('custom_css'): '';
	
		$background_color = '#333';
		$font_color = '#fff';
		$link_color = '';
	
	if($use_background_color)
		$background_color = get_option('background_color')?get_option('background_color'):'#333';
	if($use_font_color)
		$font_color = get_option('font_color')?get_option('font_color'):'#fff';
	if($use_link_color)
		$link_color = get_option('link_color')?get_option('link_color'):'';
	
	?>
	
	<?php if( !is_admin() ) { ?>
		<style>
			.last-page {
			  background: <?php echo $background_color; ?>;
			  text-align: center;
			  color: #aaa; 
			}
			.last-page > h2 {
				color: <?php echo $font_color; ?>;
				margin-bottom: 5px;
			}
			.last-page > p {
			  margin: 0;
			  color: <?php echo $font_color; ?>;
			}
			.last-page a {
				color: <?php if($link_color) echo $link_color; ?>;
			}
			.last-page a:hover {
				color: <?php echo $font_color; ?>;
			}
			
			<?php if( $custom_css != '' ) echo $custom_css; ?>
		</style>
<?php	
	}
}

function omakaccess_enqueue_popup_scripts() {
	if ( !is_admin() ) {
		wp_register_style( 'frontend-css', plugins_url( '/css.css', __FILE__ ) );
		wp_enqueue_style( 'frontend-css' ); 
		
		wp_register_script( 'frontend-js', plugins_url( '/custom.js', __FILE__ ) );
		wp_enqueue_script( 'frontend-js' ); 
	}
}


if( $custom_options )
	include('admin/custom-plugin-options.php');
else
	include('admin/cmb-plugin-options.php');
	

/*
Adding things to Front-end and Back-end
****************************************/
function add_the_meat(){
	
	// Add Scripts
	add_action( 'admin_enqueue_scripts', 'enqueue_options_page_scripts' );
	add_action( 'wp_enqueue_scripts', 'omakaccess_enqueue_popup_scripts' );	
	
	// Add Pop Up to Footer Here
	//add_action('wp_footer', 'add_my_code');
	add_action('wp_footer', 'omakaccess_option_css');
	add_action('wp_head', 'omakaccess_option_css');
	
	//add_filter( 'the_content', 'my_the_content_filter', 1 );
	
	if( !is_admin() ) {
		$plugin_activation = get_option('plugin_activation')?get_option('plugin_activation'):'activated';
	}
	
	// Add the last page via the_post reference array filter
	if( $plugin_activation != 'deactivated' ) {
		add_action( 'the_post', 'my_the_post_filter' );
	}	
}

//do_action_ref_array( 'the_post', array( &$post ) );
// wp-includes query.php
//add_action( 'the_post', 'my_the_post_filter' );
function my_the_post_filter( &$post ) {

	//print_r($post); 
	global $numpages, $pages, $multipage, $more, $page; 	
		
	$testing = 0; 
	$second_block = 1;
	
	$default_text = '<h2>Sponsored Space</h2><p>Custom Addition Via Plugin</p>';
	
	if( !is_admin() ) {
		$html_editor = get_option('html_editor')?get_option('html_editor') : $default_text;
	}
	
	if( $testing ) { 
		echo 'Number of pages: ' .$numpages; echo '<br/>';
		echo 'Page No: ' . $page; echo '<br/>';
		//echo 'Pages: ' . print_r($pages); echo '<br/>';
		echo 'Is Multipage: ' . $multipage; echo '<br/>';
		echo 'Is More: ' .$more; echo '<br/>';
	}
	
	
	$numpages++;
	
	$output = '';
		// Add Last Page Content from Plugins Options Page
		//$output .= '<!--nextpage-->';
		$output .= '<div class="last-page">';
			$output .= $html_editor;
		$output .= '</div>';
		$output .= '<!-.last-page-->';
	
	$pages[] = $output; 
	
	
	if( $second_block AND $testing ) { 
		echo '<br/>After Increment<br/>';
		echo 'Number of pages: ' .$numpages; echo '<br/>';
		echo 'Page No: ' . $page; echo '<br/>';
		//echo 'Pages: ' . print_r($pages); echo '<br/>';
		echo 'Is Multipage: ' . $multipage; echo '<br/>';
		echo 'Is More: ' .$more; echo '<br/>';
	}
	
	return($post); 
}

?>