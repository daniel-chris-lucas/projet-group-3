<?php

class Site extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}


	function get_dates( $year1 = 2011, $year2 = 2012, $year3 = 2013 )
	{
		$this->db->select( 'idtemps, annee, semestre, mois, trimestre' );
		$this->db->where( 'annee', $year1 );
		$this->db->or_where( 'annee', $year2 );
		$this->db->or_where( 'annee', $year3 );
		$this->db->order_by( 'annee desc, idtemps desc' );
		return $this->db->get( 'temps' )->result();		
	}

}