<?php if( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Main_Controller extends MY_Controller
{
    function __construct()
    {
        parent::__construct();

        // Check if username is in the Session & retrieve information on connected user
        if( $this->session->userdata( 'username' ) )
        {
            $this->data['current_user'] = $this->session->userdata( 'username' );
            $this->data['menu'] = get_menu( $this->session->userdata( 'profile' ) );
            $this->data['active'] = ( $this->uri->segment(1) == null ) ? "accueil" : $this->uri->segment(2);

            switch( $this->session->userdata( 'profile' ) )
            {
                case 'commercial' :
                    $this->data['current_profile'] = 'Directeur Commercial';
                    break;
                case 'regional' :
                    $this->data['current_profile'] = 'Directeur Régional';
                    break;
                case 'magasin' :
                    $this->data['current_profile'] = 'Directeur de Magasin';
                    break;
            }
            $this->data['active_filters'] = array( 'indicateur', 'date', 'devise', 'enseigne', 'region', 'cumul', 'produits' );
            $this->data['default_filters'] = array(
                'indicateur' => 'null',
                'date' => 'null',
                'devise' => 'null',
                'enseigne' => 'null',
                'region' => 'null',
                'cumul' => 'null',
                'produits' => 'null',
            );
        }
        else
        {
            $this->data['current_user'] = null;
            $this->data['current_profile'] = null;

            // If username is null and page different to base redirect
            if( $this->uri->uri_string() != '' )
            {
                redirect( base_url() );
            }
        }        
    }
}