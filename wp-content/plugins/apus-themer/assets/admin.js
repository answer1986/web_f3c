jQuery(document).ready(function($){
	$('.submit-new-preset').click(function(){
		var form = $('#redux-form-wrapper');
		jQuery.ajax(
            {
                type: "post",
                dataType: "json",
                url: ajaxurl,
                data: {
                    action: "apus_themer_new_preset",
                    nonce: form.data('nonce'),
                    new_preset: $('.new_preset').val()
                },
                error: function( response ) {
                    if ( !window.console ) console = {};
                    console.log = console.log || function( name, data ) {
                    };
                    console.log( redux.ajax.console );
                    console.log( response.responseText );
                    jQuery( '.redux-action_bar input' ).removeAttr( 'disabled' );
                    overlay.fadeOut( 'fast' );
                    jQuery( '.redux-action_bar .spinner' ).removeClass( 'is-active' );
                    alert( redux.ajax.alert );
                },
                success: function( response ) {
                    location.reload();
                }
            }
        );
	});

	$('.submit-preset').click(function(){
		var form = $('#redux-form-wrapper');
		jQuery.ajax(
            {
                type: "post",
                dataType: "json",
                url: ajaxurl,
                data: {
                    action: "apus_themer_set_default_preset",
                    nonce: form.data('nonce'),
                    default_preset: $('.set_default_preset').val()
                },
                error: function( response ) {
                    if ( !window.console ) console = {};
                    console.log = console.log || function( name, data ) {
                    };
                    console.log( redux.ajax.console );
                    console.log( response.responseText );
                    jQuery( '.redux-action_bar input' ).removeAttr( 'disabled' );
                    overlay.fadeOut( 'fast' );
                    jQuery( '.redux-action_bar .spinner' ).removeClass( 'is-active' );
                    alert( redux.ajax.alert );
                },
                success: function( response ) {
                    location.reload();
                }
            }
        );
	});
    $('.submit-duplicate-preset').click(function(){
        var form = $('#redux-form-wrapper');
        var title = prompt("Please enter preset name", "");
        if ( title ) {
            jQuery.ajax(
                {
                    type: "post",
                    dataType: "json",
                    url: ajaxurl,
                    data: {
                        action: "apus_themer_duplicate_preset",
                        nonce: form.data('nonce'),
                        default_preset: $('.set_default_preset').val(),
                        title: title
                    },
                    error: function( response ) {
                        if ( !window.console ) console = {};
                        console.log = console.log || function( name, data ) {
                        };
                        console.log( redux.ajax.console );
                        console.log( response.responseText );
                        jQuery( '.redux-action_bar input' ).removeAttr( 'disabled' );
                        overlay.fadeOut( 'fast' );
                        jQuery( '.redux-action_bar .spinner' ).removeClass( 'is-active' );
                        alert( redux.ajax.alert );
                    },
                    success: function( response ) {
                        location.reload();
                    }
                }
            );
        }
    });
    $('.submit-delete-preset').click(function(){
        var form = $('#redux-form-wrapper');
        jQuery.ajax(
            {
                type: "post",
                dataType: "json",
                url: ajaxurl,
                data: {
                    action: "apus_themer_delete_preset",
                    nonce: form.data('nonce'),
                    default_preset: $('.set_default_preset').val()
                },
                error: function( response ) {
                    if ( !window.console ) console = {};
                    console.log = console.log || function( name, data ) {
                    };
                    console.log( redux.ajax.console );
                    console.log( response.responseText );
                    jQuery( '.redux-action_bar input' ).removeAttr( 'disabled' );
                    overlay.fadeOut( 'fast' );
                    jQuery( '.redux-action_bar .spinner' ).removeClass( 'is-active' );
                    alert( redux.ajax.alert );
                },
                success: function( response ) {
                    location.reload();
                }
            }
        );
    });
	$('.set_default_preset').change(function(){
		$('.preset_des .key').text( $(this).val() );
	});
    $('.preset_des .key').text( $('.set_default_preset').val() );

    // check
    $( "body" ).on( "click", ".apus-checkbox", function() {
        jQuery('.'+this.id).toggle();
    });
    $('.apus-wpcolorpicker').each(function(){
        $(this).wpColorPicker();
    });
});
