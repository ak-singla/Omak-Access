<?php

// Building the admin interface

global $default;

?>
<div class="wrap">
	<h2 class="page-header">
		<?php echo $default['pluginPageTitle']; ?>
		<span class="branding-link"><a href="http://www.omaksolutions.com" title="Om Ak Solutions">Om Ak Solutions</a></span>
	</h2>
	
	<div class="form-container" style="">
		<form method="post" action="options.php">

			<?php settings_fields( $default['pluginId']. '-group' ); ?>		
			 <?php do_settings_sections( $default['pluginSlug'] ); ?> 
			
			<!-- Main Settings Section -->
			<div class="section closedsection main-section">
				<hr>
				<h3>Main Settings<span class="display-handle">Close</span></h3>
				<hr>
			
				<table id="main-options-table" class="form-table">
					<tr valign="top">
						<th scope="row">Plugin Switch</th>
						<td>
							<?php $switch = get_option('plugin_activation')?get_option('plugin_activation'):'activated'; ?>							
							<select name="plugin_activation" value="<?php echo get_option('plugin_activation'); ?>">
								<option <?php if($switch=='activated') echo 'selected="true"'; ?> value="activated">Activated</option>
								<option <?php if($switch=='deactivated') echo 'selected="true"'; ?> value="deactivated">Deactivated</option>
							</select>
						</td>
						<td><span class="default-text">Status: <?php echo $switch; ?></span></td>
					</tr>
					
					<tr valign="top">
						<th scope="row">Background Color</th>
						<td>
							<input type="color" name="background_color" value="<?php echo get_option('background_color'); ?>" />
							<input type="checkbox" name="use_background_color" <?php if(get_option('use_background_color')) echo 'checked'; ?> /> Use me
						</td>
						<td><span class="default-text">
							<?php
								if(get_option('use_background_color'))
									echo 'Current: ' .get_option('use_background_color'). '</td>';
								else
									echo 'Default: #333</td>';
							?>
							</span>
						</td>
						
					</tr>
					
					<tr valign="top">
						<th scope="row">Font Color</th>
						<td>
							<input type="color" name="font_color" value="<?php echo get_option('font_color'); ?>" />
							<input type="checkbox" name="use_font_color" <?php if(get_option('use_font_color')) echo 'checked'; ?> /> Use me
						</td>
						<td><span class="default-text">
							<?php
								if(get_option('use_font_color'))
									echo 'Current: ' .get_option('font_color'). '</td>';
								else
									echo 'Default: #FFFFFF</td>';
							?>
							</span>
						</td>
					</tr>
				
					<tr valign="top">
						<th scope="row">Link Color</th>
						<td>
							<input type="color" name="link_color" value="<?php echo get_option('link_color'); ?>" />
							<input type="checkbox" name="use_link_color" <?php if(get_option('use_link_color')) echo 'checked'; ?> /> Use me
						</td>
						<td><span class="default-text">
							<?php
								if(get_option('use_link_color'))
									echo 'Current: ' .get_option('link_color'). '</td>';
								else
									echo 'Default: Theme Default</td>';
							?>
							</span>
						</td>
					</tr>
					
					<tr valign="top">
						<th scope="row">HTML Input</th>
						<td>
							<?php
								$settings = array( 
									'textarea_name' => 'html_editor'
								);
								$editor_id = 'html_editor';
								wp_editor( get_option('html_editor'), $editor_id, $settings );
							?>
						</td>
						<td><span class="default-text">Place your HTMl here.</span></td>
					</tr>
					
					<tr valign="top">
						<th scope="row">Custom CSS</th>
						<td>
							<textarea style="width:100%; height:200px;" name="custom_css"><?php echo get_option('custom_css'); ?></textarea>
						</td>
						<td>
							<span class="default-text">
								Custom CSS without styles tag.
								<br/>Include .last-page prefix with styles
								<br/>Example: <strong>.last-page a { color: red; }</strong>
							</span>
						</td>
					</tr>
				</table>
				<!-- table options-table-->
			</div>
			<!-- Main Settings Section -->
			
			<!-- Access Control Section -->
			<div class="section closedsection section-access-control">
				<hr>
				<h3>Access Control<span class="display-handle">Close</span></h3>
				<hr>
				
				<table id="social-icons-table" class="form-table">
				
					<tr valign="top"><td colspan="3">This is the section to setup the access control for admin.</td></tr>
					<tr valign="top">
						<th scope="row">Plugin or Theme</th>
						<td>
							<?php $switch = get_option('plugin_or_theme')?get_option('plugin_or_theme'):'activated'; ?>							
							<select name="plugin_or_theme" value="<?php echo get_option('plugin_or_theme'); ?>">
								<option <?php if($switch=='theme') echo 'selected="true"'; ?> value="theme">Theme</option>
								<option <?php if($switch=='plugin') echo 'selected="true"'; ?> value="plugin">Plugin</option>
								<option <?php if($switch=='none') echo 'selected="true"'; ?> value="none">None</option>
							</select>
							<span class="default-text">Choose wether you provided a plugin or a theme.</span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">Restrict ACF Access</th>
						<td>
							<?php $switch = get_option('restrict_acf_access')?get_option('restrict_acf_access'):'activated'; ?>							
							<select name="restrict_acf_access" value="<?php echo get_option('restrict_acf_access'); ?>">
								<option <?php if($switch=='yes') echo 'selected="true"'; ?> value="yes">Yes</option>
								<option <?php if($switch=='no') echo 'selected="true"'; ?> value="no">No</option>
							</select>
							<span class="default-text">Choose weather to restrict access to ACF plugin. Have two filters in access-control.</span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">Block Admin Access</th>
						<td>
							<?php $switch = get_option('block_admin_access')?get_option('block_admin_access'):'activated'; ?>							
							<select name="block_admin_access" value="<?php echo get_option('block_admin_access'); ?>">
								<option <?php if($switch=='yes') echo 'selected="true"'; ?> value="yes">Yes</option>
								<option <?php if($switch=='no') echo 'selected="true"'; ?> value="no">No</option>
							</select>
							<span class="default-text">Redirect all except "admin" users to homepage. Block access to Dashboard.</span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">WP Core Updates</th>
						<td>
							<?php $switch = get_option('wp_core_updates')?get_option('wp_core_updates'):'activated'; ?>							
							<select name="wp_core_updates" value="<?php echo get_option('wp_core_updates'); ?>">
								<option <?php if($switch=='yes') echo 'selected="true"'; ?> value="yes">Yes</option>
								<option <?php if($switch=='no') echo 'selected="true"'; ?> value="no">No</option>
							</select>
							<span class="default-text">Yes, to disable. No to keep notifications on.</span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">Plugin Updates</th>
						<td>
							<?php $switch = get_option('plugin_updates')?get_option('plugin_updates'):'activated'; ?>
							<select name="plugin_updates" value="<?php echo get_option('plugin_updates'); ?>">
								<option <?php if($switch=='yes') echo 'selected="true"'; ?> value="yes">Yes</option>
								<option <?php if($switch=='no') echo 'selected="true"'; ?> value="no">No</option>
							</select>
							<span class="default-text">Yes, to disable. No to keep notifications on.</span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">All WP Notifications</th>
						<td>
							<?php $switch = get_option('all_wp_updates') ? get_option('all_wp_updates') : 'activated'; ?>
							<select name="all_wp_updates" value="<?php echo get_option('all_wp_updates'); ?>">
								<option <?php if($switch=='yes') echo 'selected="true"'; ?> value="yes">Yes</option>
								<option <?php if($switch=='no') echo 'selected="true"'; ?> value="no">No</option>
							</select>
							<span class="default-text">Yes, to disable. No to keep notifications on.</span>
						</td>
					</tr>
				</table>
				<!-- table social-icons-table-->
			</div>
			<!-- Access Control Section -->
			
			<!-- Section Icons Section -->
			<?php $icons = array( 'fb', 'twitter', 'gplus', 'linkedin', 'rss', 'website' ); ?>			
			<div class="section closedsection section-social-icons">
				<hr>
				<h3>Social Icons (optional)<span class="display-handle">Close</span></h3>
				<hr>
				
				<table id="social-icons-table" class="form-table">
				
					<tr valign="top"><td colspan="3">Use shortcode [OmakSocialLinks] to use the Social Icons anywhere.</td></tr>
					<?php 
						foreach( $icons as $icon ) { 
							//echo key( $icon ) ); 
							switch ( $icon ) {
								case 'fb': $title = 'Facebook'; $default_text = 'Like us on Facebook'; break; 
								case 'twitter': $title = 'Twitter'; $default_text = 'Follow us on Twitter'; break; 
								case 'gplus': $title = 'Google Plus'; $default_text = 'Connect on Gplus'; break; 
								case 'linkedin': $title = 'LinkedIn'; $default_text = 'Know us on LinkedIn'; break; 
								case 'rss': $title = 'RSS'; $default_text = 'Subscribe to RSS'; break; 
								case 'website': $title = 'Website URL'; $default_text = 'Web Presence'; break; 
							}
					?>
							<tr valign="top">
								<th scope="row"><?php echo $title; ?></th>
								<td>
									<input type="text" name="<?php echo $icon. '_url'; ?>" value="<?php echo get_option( $icon. '_url'); ?>" />
									<br/><span class="default-text">URL with http://</span>
								</td>
								<td>
									<input type="text" name="<?php echo $icon. '_alt'; ?>" value="<?php echo get_option( $icon. '_alt'); ?>" />
									<br/><span class="default-text">Alt Text, Default: <?php echo $default_text; ?></span>
								</td>
							</tr>
					<?php } ?>

				</table>
				<!-- table social-icons-table-->
			</div>
			<!-- Section Icons Section -->
			
			
			<?php submit_button(); ?>

		</form>

	</div> 
</div> 