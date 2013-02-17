<?php if( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Main_Controller extends MY_Controller
{
    function __construct()
    {
        parent::__construct();

        // Check if username is in the Session & retrieve information on connected user
        if( ! $this->session->userdata( 'username' ) )
        {
            $this->current_user = $this->session->userdata( 'username' );

            switch( $this->session->userdata( 'profile' ) )
            {
                case 'commercial' :
                    $this->current_profile = 'Directeur Commercial';
                    break;
                case 'regional' :
                    $this->current_profile = 'Directeur Régional';
                    break;
                case 'magasin' :
                    $this->current_profile = 'Directeur de Magasin';
                    break;
            }
        }
        else
        {
            $this->current_user = null;
            $this->current_profile = null;
        }
        
    }
}