<?php

function get_menu( $profile )
{
    switch( $profile )
    {
        default :
            $menu = array(
                'accueil' => array( 'nom' => 'Accueil', 'img_width' => '23', 'img_height' => '20', 'lien' => base_url() ),
                'historique' => array( 'nom' => 'Historique', 'img_width' => '23', 'img_height' => '20', 'lien' => null ),
                'palmares' => array( 'nom' => 'Palmarès', 'img_width' => '25', 'img_height' => '22', 'lien' => null ),
                'analyse' => array( 'nom' => 'Analyse', 'img_width' => '22', 'img_height' => '17', 'lien' => null ),
                'dicoDonnees' => array( 'nom' => 'Dictionnaire des Données', 'img_width' => '20', 'img_height' => '21', 'lien' => null ),
                'contacts' => array( 'nom' => 'Contacts', 'img_width' => '24', 'img_height' => '16', 'lien' => null ),
                'aide' => array( 'nom' => 'Aide', 'img_width' => '22', 'img_height' => '21', 'lien' => null ),
            );
            break;
        case 'regional' :
            $menu = array(
                'accueil' => array( 'nom' => 'Accueil', 'img_width' => '23', 'img_height' => '20', 'lien' => base_url() ),
                'historique' => array( 'nom' => 'Historique', 'img_width' => '23', 'img_height' => '20', 'lien' => null ),
                'palmares' => array( 'nom' => 'Palmarès', 'img_width' => '25', 'img_height' => '22', 'lien' => null ),
                'analyse' => array( 'nom' => 'Analyse', 'img_width' => '22', 'img_height' => '17', 'lien' => null ),
                'dicodonnees' => array( 'nom' => 'Dictionnaire des Données', 'img_width' => '20', 'img_height' => '21', 'lien' => null ),
                'contacts' => array( 'nom' => 'Contacts', 'img_width' => '24', 'img_height' => '16', 'lien' => null ),
                'aide' => array( 'nom' => 'Aide', 'img_width' => '22', 'img_height' => '21', 'lien' => null ),
            );
            break;
        case 'magasin' :
            $menu = array(
                'accueil' => array( 'nom' => 'Accueil', 'img_width' => '23', 'img_height' => '20', 'lien' => base_url() ),
                'historique' => array( 'nom' => 'Historique', 'img_width' => '23', 'img_height' => '20', 'lien' => null ),
                'palmares' => array( 'nom' => 'Palmarès', 'img_width' => '25', 'img_height' => '22', 'lien' => null ),
                'analyse' => array( 'nom' => 'Analyse', 'img_width' => '22', 'img_height' => '17', 'lien' => null ),
                'dicodonnees' => array( 'nom' => 'Dictionnaire des Données', 'img_width' => '20', 'img_height' => '21', 'lien' => null ),
                'contacts' => array( 'nom' => 'Contacts', 'img_width' => '24', 'img_height' => '16', 'lien' => null ),
                'aide' => array( 'nom' => 'Aide', 'img_width' => '22', 'img_height' => '21', 'lien' => null ),
            );
            break;
    }

    return $menu;
}



if (!function_exists('dump')) {
    function dump ($var, $label = 'Dump', $echo = TRUE)
    {
        // Store dump in variable
        ob_start();
        var_dump($var);
        $output = ob_get_clean();
        
        // Add formatting
        $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
        $output = '<pre style="background: #FFFEEF; color: #000; border: 1px dotted #000; padding: 10px; margin: 10px 0; text-align: left;">' . $label . ' => ' . $output . '</pre>';
        
        // Output
        if ($echo == TRUE) {
            echo $output;
        }
        else {
            return $output;
        }
    }
}



if (!function_exists('dump_exit')) {
    function dump_exit($var, $label = 'Dump', $echo = TRUE) {
        dump ($var, $label, $echo);
        exit;
    }
}