<?php

class Controller_Commercial_Aide extends Controller_Base
{

	public function action_index()
	{
		// Load the view
		$this->template->title = "Darties &#8226; Aide";
		$this->template->content = View::forge( "commercial/aide" );
	}

}
