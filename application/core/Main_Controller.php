<?php if( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Main_Controller extends MY_Controller
{
    function __construct()
    {
        parent::__construct();

        // import models used all the time
        $this->load->model( 'utilisateur' );

        // Check if username is in the Session & retrieve information on connected user
        if( $this->session->userdata( 'id' ) )
        {
            $this->data['current_user'] = $this->utilisateur->get_by_id( $this->session->userdata( 'id' ) );
            $this->data['menu'] = get_menu( $this->session->userdata( 'profile' ) );
            $this->data['active'] = ( $this->uri->segment(1) == null ) ? "accueil" : $this->uri->segment(2);

            switch( $this->session->userdata( 'profile' ) )
            {
                case 'Directeur Commercial' :
                    $this->data['current_profile'] = 'commercial';
                    break;
                case 'Directeur Regional' :
                    $this->data['current_profile'] = 'regional';
                    break;
                case 'Directeur Magasin' :
                    $this->data['current_profile'] = 'magasin';
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
            if( current_url() != site_url( 'utilisateurs/login' ) )
                redirect( 'utilisateurs/login' );
        }        
    }
}