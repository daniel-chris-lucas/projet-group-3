<?php

class Utilisateur extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}


	function login()
	{
		$login = "'" . $this->input->post( 'identifiant' ) . "'";
		$mdp = "'" . $this->input->post( 'mdp' ) . "'";

    	$this->db->where( 'login', $login, FALSE );
    	$this->db->where( 'mdp', $mdp, FALSE );
    	$this->db->join( 'profil', 'utilisateur.idprofil = profil.idprofil' );
    	$user = $this->db->get( 'utilisateur' )->first_row();

    	if( count( $user ) )
    	{
    		if( $this->input->post( 'souvenir' ) )
    		{
    			$rs = random_string( 'alnum', 32 );
    			$this->input->set_cookie( 'remember', $rs, 604800, '.www-i.univ-ubs.fr', '/etud/projets/e_12_darties_cgi3/', '', FALSE );
    			$this->update_user_cookie( $user->IDUTILISATEUR, $rs );
    		}
    		else
    		{
    			$this->session->set_userdata( 'id', $user->IDUTILISATEUR );
    			$this->session->set_userdata( 'profile', $user->NOM_PROFIL );
    			$this->session->set_userdata( 'loggedin', TRUE );
    		}
    	}
	}


	function update_user_cookie( $id, $cookie_val )
	{
		$cookie_val = "'" . $cookie_val . "'";
		$this->db->query( "UPDATE utilisateur SET remember = " . $cookie_val . " WHERE idutilisateur = " . $id );
	}


	function fetch_cookie()
	{
		$cookie = "'" . $this->input->cookie( 'remember' ) . "'";
		$this->db->where( 'remember', $cookie, FALSE );
		$this->db->join( 'profil', 'utilisateur.idprofil = profil.idprofil' );
		return $this->db->get( 'utilisateur' )->first_row();
	}


	function loggedin()
	{
		return (bool) $this->session->userdata( 'loggedin' );
	}


	function logout()
	{
		$this->session->sess_destroy();
		$expire = time() - 60*60*24*30;
		setcookie( 'remember', '', $expire, '/etud/projets/e_12_darties_cgi3/', '.www-i.univ-ubs.fr' );
        unset( $_COOKIE['remember'] );
		redirect( site_url() );
	}


	function get_by_id( $id )
	{
		$this->db->where( 'idutilisateur', $id, FALSE );
		return $this->db->get( 'utilisateur' )->first_row();		
	}


	function get_by_email()
	{
		$email = "'" . $this->input->post( 'email' ) . "'";

		$this->db->where( 'mail', $email, FALSE );
		return $this->db->get( 'utilisateur' )->first_row();
	}


	function get_by_login( $login )
	{
		$login = "'" . $login . "'";

		$this->db->where( 'login', $login, FALSE );
		return $this->db->get( 'utilisateur' )->first_row();
	}


	function send_forgotten_email( $user )
	{
		$this->load->library( 'email' );
		$this->load->helper( 'string' );

		$this->email->from( $this->email->smtp_user, 'DARTIES' );
		$this->email->to( $user->MAIL );
		$this->email->subject( 'Darties: Mot de passe oublié' );
		$this->email->set_mailtype( 'html' );
		$msg = $this->load->view( 'emails/forgotten_password', array(
			'link' => site_url( 'utilisateurs/change_password/' . $user->LOGIN . '/' . random_string( 'alnum', 16 ) )
		));
		$this->email->message( $msg );

		if( $this->email->send() )
		{
			$this->session->set_flashdata( 'flash_info', 'Veuillez vérifier votre boîte mail et cliquer sur le lien de modification' );
		}
		else
		{
			$this->session->set_flashdata( 'flash_error', 'L\'email n\'a pas été envoyé. Veuillez réessayer plus tard' );
		}
	}


	function change_password( $login )
	{
		$login = "'" . $login . "'";
		$mdp = "'" . $this->input->post( 'mdp' ) . "'";

		$this->db->query( "Update utilisateur SET mdp = " . $mdp . " WHERE login = " . $login );
	}

}