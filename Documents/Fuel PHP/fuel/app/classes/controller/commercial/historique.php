<?php

class Controller_Commercial_Historique extends Controller_Base
{

	public function action_index()
	{
		// Load the view
		$this->template->title = "Darties &#8226; Historique";
		$this->template->content = View::forge( "commercial/historique" );
	}

}
