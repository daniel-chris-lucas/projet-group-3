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


	function get_years( $year1 = 2011, $year2 = 2012 )
	{
		$this->db->select( 'annee' );
		$this->db->distinct();
		$this->db->where( 'annee', $year1 );
		$this->db->or_where( 'annee', $year2 );
		$this->db->order_by( 'annee desc' );
		return $this->db->get( 'temps' )->result();
	}


	function get_products()
	{
		$corbeille = "'" . 'Y' . "'";
		$this->db->select( 'idfamille_produit, lib_famille' );
		$this->db->where( 'corbeille_fam_prod', $corbeille, FALSE );
		return $this->db->get( 'famille_produit' )->result();
	}


	function get_regions()
	{
		$corbeille = "'" . 'Y' . "'";
		$this->db->select( 'idregion, libelle_region' );
		$this->db->where( 'corbeille_region', $corbeille, FALSE );
		return $this->db->get( 'region' )->result();
	}


	function get_enseignes()
	{
		$corbeille = "'" . 'Y' . "'";
		$this->db->select( 'enseigne' );
		$this->db->distinct();
		$this->db->where( 'corbeille_mag', $corbeille, FALSE );
		return $this->db->get( 'magasin' )->result();
	}

}