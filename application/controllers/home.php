<?php if( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Home extends Main_Controller {

	public function index()
	{
		// Set default and active filters
		$active_filters = $this->data['active_filters'];
		$active_filters = array( 'date' );
		$default_filters = $this->data['default_filters'];
		$default_filters['date'] = '26';

		// Load the view
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