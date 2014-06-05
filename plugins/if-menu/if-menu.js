jQuery( function( $ ) {

	$( '.menu-item-if-menu-enable' ).change( function() {
		$( this ).closest( '.if-menu-enable' ).next().toggle( $( this ).prop( 'checked' ) );
	} ).trigger( 'change' );

} );