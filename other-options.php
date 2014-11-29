<?php
add_action( 'admin_menu', 'omakso__add_admin_menu' );
add_action( 'admin_init', 'omakso__settings_init' );


function omakso__add_admin_menu(  ) { 

	add_menu_page( 'Slick Popup', 'Slick Popup', 'manage_options', 'slick_popup', 'slick_popup_options_page' );

}


function omakso__settings_exist(  ) { 

	if( false == get_option( 'slick_popup_settings' ) ) { 

		add_option( 'slick_popup_settings' );

	}

}


function omakso__settings_init(  ) { 

	register_setting( 'pluginPage', 'omakso__settings' );

	add_settings_section(
		'omakso__pluginPage_section', 
		__( 'Your section description', 'slick-options' ), 
		'omakso__settings_section_callback', 
		'pluginPage'
	);

	add_settings_field( 
		'form_title', 
		__( 'Form Title', 'slick-options' ), 
		'omakso__text_field_0_render', 
		'pluginPage', 
		'omakso__pluginPage_section' 
	);

	add_settings_field( 
		'omakso__text_field_1', 
		__( 'Settings field description', 'slick-options' ), 
		'omakso__text_field_1_render', 
		'pluginPage', 
		'omakso__pluginPage_section' 
	);

	add_settings_field( 
		'omakso__textarea_field_2', 
		__( 'Settings field description', 'slick-options' ), 
		'omakso__textarea_field_2_render', 
		'pluginPage', 
		'omakso__pluginPage_section' 
	);


}


function omakso__text_field_0_render(  ) { 

	$options = get_option( 'omakso__settings' );
	?>
	<input type='text' name='omakso__settings[omakso__text_field_0]' value='<?php echo $options['omakso__text_field_0']; ?>'>
	<?php

}


function omakso__text_field_1_render(  ) { 

	$options = get_option( 'omakso__settings' );
	?>
	<input type='text' name='omakso__settings[omakso__text_field_1]' value='<?php echo $options['omakso__text_field_1']; ?>'>
	<?php

}


function omakso__textarea_field_2_render(  ) { 

	$options = get_option( 'omakso__settings' );
	?>
	<textarea cols='40' rows='5' name='omakso__settings[omakso__textarea_field_2]'> 
		<?php echo $options['omakso__textarea_field_2']; ?>
 	</textarea>
	<?php

}


function omakso__settings_section_callback(  ) { 

	echo __( 'This section description', 'slick-options' );

}


function slick_popup_options_page(  ) { 

	?>
	<form action='options.php' method='post'>
		
		<h2>Slick Popup</h2>
		
		<?php
		settings_fields( 'pluginPage' );
		do_settings_sections( 'pluginPage' );
		submit_button();
		?>
		
	</form>
	<?php

}

?>