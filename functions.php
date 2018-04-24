<?php
	//-----------------------------------------------------
	// [1] Required WordPress setup
	//-----------------------------------------------------
	//  Make sure have the Advanced Custom Fields plugin activated in your WordPress install.
	// This code example is based on a repeater field called 'website_background_carousel'.
	
	
	//-----------------------------------------------------
	// [2] Enqueue scripts and add localized parameters
	//-----------------------------------------------------
	add_action( 'wp_enqueue_scripts', 'pp_custom_scripts_enqueue' );
	function pp_custom_scripts_enqueue() {
	
		$theme = wp_get_theme(); // Get the current theme version numbers for bumping scripts to load
	
		// Make sure jQuery is being enqueued, otherwise you will need to do this.
	
		// Register custom scripts
		wp_register_script( 'backstretch', '//cdnjs.cloudflare.com/ajax/libs/jquery-backstretch/2.0.4/jquery.backstretch.min.js', array( 'jquery' ), $theme['Version'], true); // Register script with depenancies and version in the footer
		wp_register_script( 'pp_backstretch', get_stylesheet_directory_uri() . '/scripts/pp_backstretch.js', array( 'jquery' ), $theme['Version'], true); // Register script with depenancies and version in the footer
	
		// Enqueue scripts
		wp_enqueue_script('backstretch');
		wp_enqueue_script('pp_backstretch');
		
		// Add localized scripts for php variables to be used in enqueued js files
		if ( function_exists( 'get_field' ) ) {
			// Get the global defined background image if defined in the background options page
			// wp_get_attachment_image_src - Array - [0] => url, [1] => width, [2] => height 
			$global_bkg_image = wp_get_attachment_image_src(get_field('website_background_image', 'options'), 'full');
			
			// Get an array of images if defines in the background options page
			if( have_rows('website_background_carousel', 'options') ):
				while( have_rows('website_background_carousel', 'options') ): the_row();
					$global_bkg_slide = get_sub_field('background_image_slide'); 
					//$global_bkg_slides[] = $global_bkg_slide['sizes']['large'];
					$global_bkg_slides[] = $global_bkg_slide['url'];
				endwhile;
			endif;
		}
		$data = array(
			'home_url' => home_url(),
			'theme_url' => get_stylesheet_directory_uri(),
			'acf_bkg_image' => $global_bkg_image[0],
			'acf_bkg_slides' => $global_bkg_slides
		);
		wp_localize_script( 'pp_js', 'wp_variables', $data );
	
	}

	
	//-----------------------------------------------------
	// [4] Make the element 'body.home > #sb-site' exists in your markup
	//-----------------------------------------------------
	
	
?>