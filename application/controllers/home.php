<?php if( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Home extends Main_Controller {

	public function index()
	{
		$active_filters = $this->data['active_filters'];
		$default_filters = $this->data['default_filters'];

		if( $this->data['current_profile'] == 'commercial' )
		{
			// Set default and active filters
			$active_filters = array( 'date' );
			$default_filters['date'] = 26;

			// Load the view
			$this->template->load( 'default', 'home/' . $this->data['current_profile'], array(
				'title' => 'Darties &#8226; Accueil',
				'program' => '/Utilisateurs/DARTIES3-2012/Mon dossier/accueil_DC',
				'active_filters' => $active_filters,
				'default_filters' => $default_filters,
			));
		}
		else if( $this->data['current_profile'] == 'regional' )
		{
			// Set default and active filters
			$active_filters = array( 'date', 'region', 'enseigne' );
			$default_filters['date'] = 26;
			$default_filters['region'] = 1;
			$default_filters['enseigne'] = 'Darty';

			// Load the view
			$this->template->load( 'default', 'home/' . $this->data['current_profile'], array(
				'title' => 'Darties &#8226; Accueil',
				'program' => '/Utilisateurs/DARTIES3-2012/Mon dossier/ACCUEIL_DR',
				'active_filters' => $active_filters,
				'default_filters' => $default_filters,
			));
		}
		else if( $this->data['current_profile'] == 'magasin' )
		{
			// Set default and active filters
			$active_filters = array( 'date', 'region', 'enseigne' );
			$default_filters['date'] = 26;
			$default_filters['region'] = 1;
			$default_filters['enseigne'] = 'Darty';

			// Load the view
			$this->template->load( 'default', 'home/' . $this->data['current_profile'], array(
				'title' => 'Darties &#8226; Accueil',
				'program' => '/Utilisateurs/DARTIES3-2012/Mon dossier/ACCUEIL_DR',
				'active_filters' => $active_filters,
				'default_filters' => $default_filters,
			));
		}
		
	}


	public function logout()
	{
		$this->session->sess_destroy();
		redirect( site_url() );
	}
}