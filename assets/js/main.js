( function( $ ) {

	/*$( '#filters-nav form p' ).children( 'select' ).dropkick({
		theme: 'darties',
	});*/

	$( '.scroll-table' ).fixedHeaderTable({
		footer: true,
		height: 400
	});

	$maxFhtWidth = $( '.fht-thead' ).width();
	$( '.fht-tbody' ).css( 'max-width', $maxFhtWidth );

	//$( 'form' ).validate();

})( jQuery );