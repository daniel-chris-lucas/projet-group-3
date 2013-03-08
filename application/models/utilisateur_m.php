<?php

class Utilisateur_m extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}


	function login()
	{
		$login = $this->input->post( 'login' );
		$password = $this->input->post( 'password' );

    	$sql = "SELECT * FROM utilisateur WHERE login = ? AND password = ? LIMIT 1";
    	$user = $this->db->query( $sql, array( $login, $password ) );
    	$user->result();
    	dump( $user );
	}

}