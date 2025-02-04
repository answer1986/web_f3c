/**
 * Live-update changed settings in real time in the Customizer preview.
 */

( function( $ ) {
	var $style = $( '#tumbas-color-scheme-css' ),
		api = wp.customize;

	api( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	api( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );
	// Header text color.
	api( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title,  .site-description' ).css( {
					'clip': 'auto',
					'position': 'static'
				} );

				$( '.site-title a' ).css( {
					'color': to
				} );
			}
		} );
	} );


	//Update site link color in real time...
	api( 'page_bg', function( value ) {
		value.bind( function( newval ) {  
			$('#page').css('background-color', newval );
		} );
	} );


	//Update site link color in real time...
	api( 'body_text_color', function( value ) {
		value.bind( function( newval ) {  
			$('body').css('color', newval );
		} );
	} );



	//Update site link color in real time...
	api( 'topbar_bg', function( value ) {
		value.bind( function( newval ) {  
			$('#apus-topbar').css('background-color', newval );
		} );
	} );

	//Update site link color in real time...
	api( 'topbar_color', function( value ) {
		value.bind( function( newval ) {  
			$('#apus-topbar, #apus-topbar a, #apus-topbar span').css('color', newval );
		} );
	} );



	//Update site link color in real time...
	api( 'footer_bg', function( value ) {
		value.bind( function( newval ) {  
			$('#apus-footer').css('background-color', newval );
		} );
	} );

	//Update site link color in real time...
	api( 'footer_color', function( value ) {
		value.bind( function( newval ) {  
			$('#apus-footer, #apus-footer a').css('color', newval );
		} );
	} );

	//Update site link color in real time...
	api( 'footer_heading_color', function( value ) {
		value.bind( function( newval ) {  
			$('#apus-footer h2, #apus-footer h3, #apus-footer h4').css('color', newval );
		} );
	} );
} )( jQuery );
