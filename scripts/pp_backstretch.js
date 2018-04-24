(function($) {
	"use strict";
	$(function() {

		//-----------------------------------------------------
		// [3] Attach Backstretch to a dfull page div with id
		//-----------------------------------------------------
		$("body.home #sb-site").backstretch(
			wp_variables.acf_bkg_slides, // include images from an array
			{centeredX: false, centeredY: false, duration: 3000, fade: 750} // background image and slidesow settings
		);

	});
}(jQuery));