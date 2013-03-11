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
				'rules' => 'trim|required|min_length[3]|max_length[20]|xss_clean'
			),
			'mdp' => array(
				'field' => 'mdp',
				'label' => 'Mot de Passe',
				'rules' => 'trim|required|min_length[4]|max_length[20]|xss_clean'
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
				$this->session->set_flashdata( 'flash_form_error', 'Identifiant ou mot de passe invalide' );
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


	public function forgotten_password()
	{
		// Redirect user if already logged in
		$this->utilisateur->loggedin() == FALSE || redirect( site_url() );

		// Set up the form
		$this->form_validation->set_rules( array(
			'email' => array(
				'field' => 'email',
				'label' => 'Adresse Email',
				'rules' => 'trim|required|valid_email'
			),
		));

		// Process the form
		if( $this->form_validation->run() )
		{
			$user = $this->utilisateur->get_by_email();
			
			if( count( $user ) )
			{
				$this->utilisateur->send_forgotten_email( $user );
			}
			else
			{
				$this->session->set_flashdata( 'flash_error', 'Cette adresse email n\'existe pas' );
			}
			redirect( 'utilisateurs/forgotten_password', 'refresh' );
		}

		// Load view
		$this->template->load( 'utilisateurs/forgotten', null, array(
			'title' => 'Darties &#8226; Mot de Passe Oublié'
		));
	}


	function change_password( $login, $random )
	{
		// Redirect user if already logged in
		$this->utilisateur->loggedin() == FALSE || redirect( site_url() );
		// Redirect user if random string is invalid
		// strlen( $random ) == 16 || redirect( site_url() );

		// check if user exists
		$user = $this->utilisateur->get_by_login( $login );
		if( ! count( $user ) )
		{
			$this->session->set_flashdata( 'flash_error', 'Cet utilisateur n\'existe pas' );
			redirect( site_url() );
		}

		// Set up the form
		$this->form_validation->set_rules( array(
			'mdp' => array(
				'field' => 'mdp',
				'label' => 'Nouveau mot de passe',
				'rules' => 'trim|required|xss_clean'
			),
			'mdpc' => array(
				'field' => 'mdpc',
				'label' => 'Confirmation mot de passe',
				'rules' => 'trim|required|xss_clean|matches[mdp]'
			),
		));

		// Process the form
		if( $this->form_validation->run() )
		{
			$this->utilisateur->change_password( $login );
			$this->session->set_flashdata( 'flash_info', 'Votre mot de passe a été modifié. Vous pouvez vous connecter' );
			redirect( site_url() );
		}

		// Load view
		$this->template->load( 'utilisateurs/change-password', null, array(
			'title' => 'Darties &#8226; Modifier Mot de Passe'
		));
	}

}