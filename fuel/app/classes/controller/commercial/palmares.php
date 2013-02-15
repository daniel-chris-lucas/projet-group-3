<?php

class Controller_Commercial_Palmares extends Controller_Base
{

	public function action_index()
	{
		// Load the view
		$this->template->title = "Darties &#8226; Palmares";
		$this->template->content = View::forge( "commercial/palmares" );
	}

}
