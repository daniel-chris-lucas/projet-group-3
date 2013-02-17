<?php

class Controller_Commercial_DicoDonnees extends Controller_Base
{

	public function action_index()
	{
		$handle = fopen( Uri::base() . "assets/dico-donnees.csv", "r" );
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
		$this->template->title = "Darties &#8226; Dictionnaire des Données";
		$this->template->content = View::forge( "commercial/dico-donnees", array(
			"csv" => $csv
		));
	}

}