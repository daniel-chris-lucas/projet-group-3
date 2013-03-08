<?php

class Utilisateur extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}


	function login()
	{
    	$this->db->from( 'utilisateur' );
    	$this->db->where( array(
    		'login' => "'" . $this->input->post( 'identifiant' ) . "'",
    		'mdp' => "'" . $this->input->post( 'mdp' ) . "'"
    	));
    	$this->db->join( 'profil', 'utilisateur.idprofil = profil.idprofil' );
    	$user = $this->db->get()->first_row();

    	if( count( $user ) )
    	{
    		$this->session->set_userdata( 'id', $user->IDUTILISATEUR );
    		$this->session->set_userdata( 'profile', $user->NOM_PROFIL );
    		$this->session->set_userdata( 'loggedin', TRUE );
    	}
	}


	function loggedin()
	{
		return (bool) $this->session->userdata( 'loggedin' );
	}


	function logout()
	{
		$this->session->sess_destroy();
		redirect( site_url() );
	}


	function get_by_id( $id )
	{
		return $this->db->get_where( 'utilisateur', array( 'idutilisateur' => $id ) )->first_row();
	}

}