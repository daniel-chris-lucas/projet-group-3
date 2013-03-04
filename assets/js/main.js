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


	/* run ajax when filters are changed */
	/*$( '.filter-dropkick' ).on( 'change', function() {
		$.get( 'http://saskatchewan.univ-ubs.fr:8080/SASStoredProcess/do?_username=DARTIES3-2012&_password=P@ssw0rd&_program=%2FUtilisateurs%2FDARTIES3-2012%2FMon+dossier%2Fanalyse_dc&annee=2012&ind=V&_action=execute',
		function( data) {
			console.log( data );
		});
	});*/

})( jQuery );