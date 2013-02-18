<?php

class Contacts extends Main_Controller
{

	public function index()
	{
		// Load the view
		$this->template->load( 'default', 'commercial/contacts', array(
			'title' => 'Darties &#8226 Contacts'
		));
	}

}