jQuery(document).ready(function($){

	var optionsthemer_upload;
	var optionsthemer_selector;

	function optionsthemer_add_file(event, selector) {

		var upload = $(".uploaded-file"), frame;
		var $el = $(this);
		optionsthemer_selector = selector;

		event.preventDefault();

		// If the media frame already exists, reopen it.
		if ( optionsthemer_upload ) {
			optionsthemer_upload.open();
			return;
		} else {
			// Create the media frame.
			optionsthemer_upload = wp.media.frames.optionsthemer_upload =  wp.media({
				// Set the title of the modal.
				title: "Select Image",

				// Customize the submit button.
				button: {
					// Set the text of the button.
					text: "Selected",
					// Tell the button not to close the modal, since we're
					// going to refresh the page when the image is selected.
					close: false
				}
			});

			// When an image is selected, run a callback.
			optionsthemer_upload.on( 'select', function() {
				// Grab the selected attachment.
				var attachment = optionsthemer_upload.state().get('selection').first();

				optionsthemer_upload.close();
				optionsthemer_selector.find('.upload_image').val(attachment.attributes.url).change();
				if ( attachment.attributes.type == 'image' ) {
					optionsthemer_selector.find('.screenshot').empty().hide().prepend('<img src="' + attachment.attributes.url + '">').slideDown('fast');
				}
			});

		}
		// Finally, open the modal.
		optionsthemer_upload.open();
	}

	function optionsthemer_remove_file(selector) {
		selector.find('.screenshot').slideUp('fast').next().val('').trigger('change');
	}
	
	$('body').on('click', '.upload_image_action .remove-image', function(event) {
		optionsthemer_remove_file( $(this).parent().parent() );
	});

	$('body').on('click', '.upload_image_action .add-image', function(event) {
		optionsthemer_add_file(event, $(this).parent().parent());
	});

});