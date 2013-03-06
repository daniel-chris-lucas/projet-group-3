<?php

class DicoDonnees extends Main_Controller
{

	public function index()
	{
		// set the active filters for the page
		$active_filters = $this->data['active_filters'];
		$default_filters = $this->data['default_filters'];

		$handle = fopen( base_url() . "assets/dico-donnees.csv", "r" );
		// $handle = \File::read( DOCROOT . "assets" . DS . "dico-donnees.csv", true );

		// convert csv to utf8
		/* if( mb_detect_encoding( $handle, "ISO-8859-1, UTF-8" ) == "ISO-8859-1" )
			$handle = mb_convert_encoding( $handle, "UTF-8", "ISO-8859-1" );

		$handle = \File::read( DOCROOT . "assets" . DS . "dico-donnees.csv" ); */
		$row = 1;
		$csv = array();

		while( ( $data = fgetcsv( $handle, 5000, "," ) ) !== FALSE )
		{
			if( $row == 1 )
				$csv['headers'] = $data;
			else
				$csv['content'][] = $data;

			$row++;
		}

		// Load the view
		$this->template->load( 'default', 'commercial/dico-donnees', array(
			'title' => 'Darties &#8226 Dictionnaire des Données',
			'csv' => $csv,
			'active_filters' => $active_filters,
			'default_filters' => $default_filters,
		));
	}

}