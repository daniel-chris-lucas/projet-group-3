<?php

class Aide extends Main_Controller
{

	public function index()
	{
		// Load the view
		$this->template->load( 'default', 'commercial/aide', array(
			'title' => 'Darties &#8226 Aide'
		));
	}

}