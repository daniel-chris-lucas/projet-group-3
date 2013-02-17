<?php if( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Home extends Main_Controller {

	public function index()
	{
		// Create validation rules
		$val = array(
			array(
				'field' => 'identifiant',
				'label' => 'Identifiant',
				'rules' => 'required | min_length[3] | max_length[20]'
			),
			array(
				'field' => 'mdp',
				'label' => 'Mot de Passe',
				'rules' => 'required | min_length[4] | max_length[20]'
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
		$data['title'] = 'Darties &#8226; Accueil';

		if( $this->session->userdata( 'username' ) )
			$this->template->load( 'default', null, $data );
		else
			$this->template->load( 'login', null, $data );

	}
}