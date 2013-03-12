<?php

class Analyse extends Main_Controller
{

	public function index()
	{
		// set the active and default filters for the page
		$active_filters = $this->data['active_filters'];
		$active_filters = array( 'indicateur', 'annee' );
		$default_filters = $this->data['default_filters'];
		$default_filters['indicateur'] = 'CA';
		$default_filters['annee'] = '2012';

		// Load the view
		$this->template->load( 'default', 'commercial/analyse', array(
			'title' => 'Darties &#8226 Analyse',
			'program' => '/Utilisateurs/DARTIES3-2012/Mon dossier/analyse_DC',
			'active_filters' => $active_filters,
			'default_filters' => $default_filters,
		));
	}

}