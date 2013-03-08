<?php if( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Home extends Main_Controller {

	public function index()
	{
		// Load the view
		$active_filters = $this->data['active_filters'];
		$default_filters = $this->data['default_filters'];

		$this->template->load( 'default', 'home/index', array(
			'title' => 'Darties &#8226; Accueil',
			'program' => '/Utilisateurs/DARTIES3-2012/Mon dossier/accueil_DC',
			'active_filters' => $active_filters,
			'default_filters' => $default_filters,
		));
	}


	public function logout()
	{
		$this->session->sess_destroy();
		redirect( site_url() );
	}
}