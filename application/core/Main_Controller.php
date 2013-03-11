<?php if( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Main_Controller extends MY_Controller
{
    function __construct()
    {
        parent::__construct();

        // import models used all the time
        $this->load->model( 'utilisateur' );

        // if user isn't logged in check the cookie
        if( $this->input->cookie( 'remember' ) )
        {
            $user = $this->utilisateur->fetch_cookie();

            // if the user exists log him in
            if( count( $user ) )
            {
                $this->session->set_userdata( 'id', $user->IDUTILISATEUR );
                $this->session->set_userdata( 'profile', $user->NOM_PROFIL );
                $this->session->set_userdata( 'loggedin', TRUE );
            }
            // if not remove the cookie
            else
            {
                $expire = time() - 60*60*24*30;
                setcookie( 'remember', '', $expire, '/etud/projets/e_12_darties_cgi3/', '.www-i.univ-ubs.fr' );
                unset( $_COOKIE['remember'] );
            }
        }

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
            if( current_url() != site_url( 'utilisateurs/login' ) &&  
                current_url() != site_url( 'utilisateurs/forgotten_password' ) &&
                $this->uri->segment(2) != 'change_password'
            )
                redirect( 'utilisateurs/login' );
        }        
    }
}