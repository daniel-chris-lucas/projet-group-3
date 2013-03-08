<?php if( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Utilisateurs extends Main_Controller
{

	public function __construct()
	{
		parent::__construct();
	}


	public function login()
	{
		// Redirect user if already logged in
		$this->utilisateur->loggedin() == FALSE || redirect( site_url() );

		// Set up the form
		$this->form_validation->set_rules( array(
			'identifiant' => array(
				'field' => 'identifiant',
				'label' => 'Identifiant',
				'rules' => 'required|min_length[3]|max_length[20]|xss_clean'
			),
			'mdp' => array(
				'field' => 'mdp',
				'label' => 'Mot de Passe',
				'rules' => 'required|min_length[4]|max_length[20]|xss_clean'
			),
		));

		// Process the form
		if( $this->form_validation->run() )
		{
			if( $this->utilisateur->login() )
			{
				redirect( site_url() );
			}
			else
			{
				$this->session->set_flashdata( 'flash_error', 'Identifiant ou mot de passe invalide' );
				redirect( 'utilisateurs/login', 'refresh' );
			}
		}

		// Load view
		$this->template->load( 'utilisateurs/login', null, array(
			'title' => 'Darties &#8226; Connexion'
		));
	}


	public function logout()
	{
		$this->utilisateur->logout();
	}

}