<?php

class Controller_Commercial_Analyse extends Controller_Base
{

	public function action_index()
	{
		// Load the view
		$this->template->title = "Darties &#8226; Analyse";
		$this->template->content = View::forge( "commercial/analyse" );
	}

}
