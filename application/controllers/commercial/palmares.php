<?php

class Palmares extends Main_Controller
{

	public function index()
	{
		// Load the view
		$this->template->load( 'default', 'commercial/palmares', array(
			'title' => 'Darties &#8226 Palmarès'
		));
	}

}