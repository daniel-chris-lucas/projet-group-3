<?php if( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Home extends Main_Controller {

	public function index()
	{
		// Create validation rules
		$val = array(
			array(
				'field' => 'identifiant',
				'label' => 'Identifiant',
				'rules' => 'required|min_length[3]|max_length[20]|xss_clean'
			),
			array(
				'field' => 'mdp',
				'label' => 'Mot de Passe',
				'rules' => 'required|min_length[4]|max_length[20]|xss_clean'
			)
		);

		$this->form_validation->set_rules( $val );
		if( $this->form_validation->run() )
		{
			$this->session->set_userdata( 'username', set_value( 'identifiant' ) );
			$this->session->set_userdata( 'profile', 'commercial' );
			redirect( base_url() );
		}

		// Load the view
		if( $this->session->userdata( 'username' ) )
			$this->template->load( 'default', 'home/index', array(
				'title' => 'Darties &#8226; Accueil',
				'program' => '/Utilisateurs/DARTIES3-2012/Mon dossier/accueil_DC',
			));
		else
			$this->template->load( 'login', null, array(
				'title' => 'Darties &#8226; Connexion'
			));
	}


	public function logout()
	{
		$this->session->sess_destroy();
		redirect( site_url() );
	}
}