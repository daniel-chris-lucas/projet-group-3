<?php

class Contacts extends Main_Controller
{

	public function index()
	{
		// set the active filters for the page
		$active_filters = $this->data['active_filters'];
		$default_filters = $this->data['default_filters'];

		// Load the view
		$this->template->load( 'default', 'commercial/contacts', array(
			'title' => 'Darties &#8226 Contacts',
			'active_filters' => $active_filters,
			'default_filters' => $default_filters,
		));
	}

}