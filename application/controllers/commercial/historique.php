<?php

class Historique extends Main_Controller
{

	public function index()
	{
		// set the active filters for the page
		$active_filters = $this->data['active_filters'];
		$default_filters = $this->data['default_filters'];

		// Load the view
		$this->template->load( 'default', 'commercial/historique', array(
			'title' => 'Darties &#8226 Historique',
			'active_filters' => $active_filters,
			'default_filters' => $default_filters,
		));
	}

}