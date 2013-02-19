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