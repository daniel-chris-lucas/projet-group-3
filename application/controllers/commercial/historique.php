<?php

class Historique extends Main_Controller
{

	public function index()
	{
		// set the active filters for the page
		$active_filters = $this->data['active_filters'];
		$active_filters = array( 'indicateur', 'date' );
		$default_filters = $this->data['default_filters'];
		$default_filters['indicateur'] = 'CA';
		$default_filters['date'] = '26';

		// Load the view
		$this->template->load( 'default', 'commercial/historique', array(
			'title' => 'Darties &#8226 Historique',
			'active_filters' => $active_filters,
			'program' => '/Utilisateurs/DARTIES3-2012/Mon dossier/historique_DC',
			'default_filters' => $default_filters,
		));
	}

}