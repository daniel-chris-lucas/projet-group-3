<?php

class Controller_Base extends Controller_Template
{

	public $template = "layouts/template";

	public function before()
	{
		parent::before();

		// Check if username is in the Session & retrieve information on connected user
		if( Session::get( "username" ) )
		{
			$this->current_user = Session::get( "username" );
			switch( Session::get( "profile" ) )
			{
				case "commercial" :
					$this->current_profile = "Directeur Commercial";
					break;
				case "regional" :
					$this->current_profile = "Directeur Régional";
					break;
				case "magasin" :
					$this->current_profile = "Directeur de Magasin";
					break;
			}
		}
		else
		{
			$this->current_user = null;
			$this->current_profile = null;
		}

		// Send information to the view
		View::set_global( "current_user", $this->current_user );
		View::set_global( "current_profile", $this->current_profile );
	}

}