<?php if( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Ajax extends Main_Controller {

	public function index()
	{
		print_r( $_POST ); exit();
		$url = $this->input->post( 'url' );
		unset( $_POST['url'] );

		$fields_string = '';
		// Prepare the url for POST
		foreach( $_POST as $key => $value )
		{
			$fields_string .= $key . '=' . $value . '&';
		}
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

		print_r( $result );
	}
	
}