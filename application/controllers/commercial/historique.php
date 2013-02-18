<?php

class Historique extends Main_Controller
{

	public function index()
	{
		// Load the view
		$this->template->load( 'default', 'commercial/historique', array(
			'title' => 'Darties &#8226 Historique'
		));
	}

}