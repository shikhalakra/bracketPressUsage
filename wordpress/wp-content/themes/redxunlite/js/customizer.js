/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.blog-title, .blog-description, .blog-description a, .home .blog-title, .home .blog-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.blog-title, .blog-description, .blog-description a, .home .blog-title, .home .blog-title a' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.blog-title, .blog-description, .blog-description a, .home .blog-title, .home .blog-title a' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.blog-title, .blog-description, .blog-description a, .home .blog-title, .home .blog-title a' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.blog-title, .blog-description, .blog-description a, .home .blog-title, .home .blog-title a' ).css( {
					'color': to
				} );
			}
		} );
	} );
} )( jQuery );
