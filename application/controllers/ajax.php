<?php if( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Ajax extends Main_Controller {

	public function index()
	{

		/*http://saskatchewan.univ-ubs.fr:8080/SASStoredProcess/do?_username=DARTIES3-2012&_password=P@ssw0rd
		  &_program=%2FUtilisateurs%2FDARTIES3-2012%2FMon+dossier%2Faccueil_DC&_action=update%2Cnewwindow
		  &_promptkey=10484290 */
		$fields_string = '';
		// Set up static url values
		$urlArray = array(
			'url' => 'http://saskatchewan.univ-ubs.fr:8080/SASStoredProcess/do?_username=DARTIES3-2012',
			'_password' => 'P@ssw0rd',
			'_action' => 'execute',
		);

		// Import value from the filter
		foreach( $_POST as $item => $value )
		{
			// If the value of the filter isn't null add, add it to the array
			$value == 'null' || $urlArray[$item] = $value;
		}

		// Retrieve the url then remove it from the array to make looping easier
		$url = $urlArray['url'];
		unset( $urlArray['url'] );

		// Prepare the URL parameters for post
		foreach( $urlArray as $key => $value )
		{
			$fields_string .= $key . '=' . $value . '&';
		}
		// remove the last & from the generated url
		$fields_string = rtrim( $fields_string, '&' );

		// open curl connection
		$ch = curl_init();
		// set the url, number of POST variables, POST data
		curl_setopt( $ch, CURLOPT_URL, $url );
		curl_setopt( $ch, CURLOPT_POST, count( $_POST ) );
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $fields_string );

		// execute POST
		$result = curl_exec( $ch );
		// close curl connection
		curl_close( $ch );
	}
	
}