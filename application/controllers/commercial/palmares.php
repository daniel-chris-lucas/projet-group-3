<?php

class Palmares extends Main_Controller
{

	public function index()
	{
		// set the active filters for the page
		$active_filters = $this->data['active_filters'];
		$active_filters = array( 'date', 'region', 'produits' );
		$default_filters = $this->data['default_filters'];
		$default_filters['date'] = '26';
		$default_filters['region'] = 'null';
		$default_filters['produits'] = '1';

		// Load the view
		$this->template->load( 'default', 'commercial/palmares', array(
			'title' => 'Darties &#8226 Palmarès',
			'program' => '/Utilisateurs/DARTIES3-2012/Mon dossier/palm_DC',
			'active_filters' => $active_filters,
			'default_filters' => $default_filters,
		));
	}

}