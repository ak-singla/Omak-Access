<?php



////////////////////////////////////////
// OmakSocialLinks Shortcode 
////////////////////////////////////////
add_shortcode( 'OmakSocialLinks', 'omakaccess_create_share_button' ); 
function omakaccess_create_share_button() {

	$atts = shortcode_atts( array(
		'fb' => array(
			'url' => 'http://www.facebook.com/OmAkSolutions',
			'alt' => 'Like us on Facebook',
			'class' => 'fb',
		),
		'twitter' => array(
			'url' => 'https://twitter.com/SinglaAk',
			'alt' => 'Follow us on Twitter',
			'class' => 'twitter',
		),
		'gplus' => array(
			'url' => 'http://in.linkedin.com/pub/ankit-singla/62/647/4b4',
			'alt' => 'Connect on Gplus',
			'class' => 'gplus',
		),
		'linkedin' => array(
			'url' => 'http://in.linkedin.com/pub/ankit-singla/62/647/4b4',
			'alt' => 'Know us on LinkedIn',
			'class' => 'linkedin',
		),
		'rss' => array(
			'url' => 'http://in.linkedin.com/pub/ankit-singla/62/647/4b4',
			'alt' => 'Subscribe to RSS',
			'class' => 'rss',
		),
		'website' => array(
			'url' => 'http://in.linkedin.com/pub/ankit-singla/62/647/4b4',
			'alt' => 'Web Presence',
			'class' => 'website',
		)
	), $atts );
	
	 
	 // Get Values From Options Page
	$icons = array( 'fb', 'twitter', 'gplus', 'linkedin', 'rss', 'website' );
		foreach( $icons as $icon ) {
			$atts[$icon]['url'] = get_option($icon. '_url') ? get_option($icon. '_url') : '';
			//$atts[$icon]['alt'] = get_option($icon. '_alt') ? get_option($icon. '_alt') : '';
		}
	
	$output = ''; 
	$is_True = True;
	
	//$output .= '<br/>KeyAtts: ' .key($atts);
	if( 0 ) {
		foreach( $atts as $attri ) {
			if( isset($attri['url']) AND ! empty($attri['url']) ) {
				$output .= '<br/>Key: ' .key($attri). ' URL: ' .$attri['url']. ' Alt: ' .$attri['alt'];
			}
		}
	}
	
	$output .= '<ul class="omaksociallinks">';
	
	foreach( $atts as $attri ) {
		
		if( isset($attri['url']) AND ! empty($attri['url']) ) {
			
			if( $attri['class'] == 'website' )
				$target_window = ''; 
			else 
				$target_window = ' target="_blank" '; 
				
			$output .= '<li class="' .$attri['class']. '">';
				$output .= '<a href="' .$attri['url']. '" title="' .$attri['alt']. '"' .$target_window. '>';
					//$output .= $attri['alt'];
					$output .= 'A';
				$output .=  '</a>';
			$output .= '</li>';
			$output .= '<!-- icon icon-' .$attri['class']. '-->';
		}
	}
	
	$output .= '</ul>';
	/*
	$output .= '<div class="omaksharer">';
		$output .= '<a onclick="' .$onClick. '" href="http://www.facebook.com/sharer/sharer.php?u=' .get_the_permalink(). '&t=' .get_the_title(). '" class="fb-share" id="onclick-popup">';
			$output .= '<img class="fb-icon" src="' .plugins_url( 'images/fb-icon.png', __FILE__ ). '" style="border:0 !important;">';
			$output .= '<span class="share-text">' .$atts['button_text']. '</span>';
			$output .= '<span id="fb-share-count" style="">';
				$output .= '<img src="' .plugins_url( 'images/arrow-white.png', __FILE__ ). '" style="border:0 !important;">';
				$output .= $fb_data;
			$output .= '</span>';
		$output .= '</a>';
	$output .= '</div>';
	*/
	return $output;
}

?>