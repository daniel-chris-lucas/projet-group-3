( function( $ ) {

	/*$( '#filters-nav form p' ).children( 'select' ).dropkick({
		theme: 'darties',
	});*/

	// Set up scrolling tables
	$( '.scroll-table' ).fixedHeaderTable({
		footer: true,
		height: 400
	});

	$maxFhtWidth = $( '.fht-thead' ).width();
	$( '.fht-tbody' ).css( 'max-width', $maxFhtWidth );

	//$( 'form' ).validate();

	// Set up height and position of filters
	$( 'nav#filters-nav' ).css( 'margin-top', $( 'nav#main-nav' ).height() + 1 );
	$( 'nav#filters-nav' ).height( $( 'div#main' ).height() + parseInt( $( 'div#main' ).css( 'padding-bottom' ) ) +1 );
})( jQuery );