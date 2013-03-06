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


function curl_exec_utf8($ch) {
    $data = curl_exec($ch);
    if (!is_string($data)) return $data;

    unset($charset);
    $content_type = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);

    /* 1: HTTP Content-Type: header */
    preg_match( '@([\w/+]+)(;\s*charset=(\S+))?@i', $content_type, $matches );
    if ( isset( $matches[3] ) )
        $charset = $matches[3];

    /* 2: <meta> element in the page */
    if (!isset($charset)) {
        preg_match( '@<meta\s+http-equiv="Content-Type"\s+content="([\w/]+)(;\s*charset=([^\s"]+))?@i', $data, $matches );
        if ( isset( $matches[3] ) )
            $charset = $matches[3];
    }

    /* 3: <xml> element in the page */
    if (!isset($charset)) {
        preg_match( '@<\?xml.+encoding="([^\s"]+)@si', $data, $matches );
        if ( isset( $matches[1] ) )
            $charset = $matches[1];
    }

    /* 4: PHP's heuristic detection */
    if (!isset($charset)) {
        $encoding = mb_detect_encoding($data);
        if ($encoding)
            $charset = $encoding;
    }

    /* 5: Default for HTML */
    if (!isset($charset)) {
        if (strstr($content_type, "text/html") === 0)
            $charset = "UTF-8";
    }

    /* Convert it if it is anything but UTF-8 */
    /* You can change "UTF-8"  to "UTF-8//IGNORE" to 
       ignore conversion errors and still output something reasonable */
    if (isset($charset) && strtoupper($charset) != "UTF-8")
        $data = iconv($charset, 'UTF-8', $data);

    return $data;
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