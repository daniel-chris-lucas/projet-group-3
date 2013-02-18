<?php

class Analyse extends Main_Controller
{

	public function index()
	{
		// Load the view
		$this->template->load( 'default', 'commercial/analyse', array(
			'title' => 'Darties &#8226 Analyse'
		));
	}

}