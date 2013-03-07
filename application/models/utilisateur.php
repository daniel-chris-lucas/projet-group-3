<?php

class Utilisateur extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}


	function login()
	{
		/* "A.Madison"
    	   "ju4Omr" */
    	$this->db->from( 'utilisateur' );
    	$this->db->where( 'login', 'A.Madison' );
		$this->db->where( 'mdp', 'ju4Omr' );
    	$user = $this->db->get();

		dump( $user );
	}

}