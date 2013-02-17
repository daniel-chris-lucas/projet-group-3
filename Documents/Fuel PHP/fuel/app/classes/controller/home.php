<?php

class Controller_Home extends Controller_Base
{

	public function action_index()
	{
		// Create validation rules
		$val = Validation::forge();
		$val->add( "identifiant", "Identifiant" )
			->add_rule( "min_length", 3 )
			->add_rule( "max_length", 20 );

		$val->add( "mdp", "Mot de Passe" )
			->add_rule( "min_length", 4 )
			->add_rule( "max_length", 20 );

		// Check if the form has been filled correctly
		if( Input::method() == "POST" && $val->run() )
		{
			Session::set( "username", $val->validated( "identifiant" ) );
			Session::set( "profile", "commercial" );
			Response::redirect( Uri::base() );
		}

		// Load the view
		$this->template->title = "Darties &#8226; Accueil";
		if( Session::get("username") )
			$this->template->content = View::forge( "home/index" );
		else
			return new Response( View::forge( "home/login", array(
					'title' => "Darties &#8226; Connexion"
				) 
			));
	}


	public function action_logout()
	{
		Session::destroy();
		Response::redirect( Uri::base() );
	}

}
