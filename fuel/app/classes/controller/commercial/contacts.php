<?php

class Controller_Commercial_Contacts extends Controller_Base
{

	public function action_index()
	{
		// Load the view
		$this->template->title = "Darties &#8226; Contacts";
		$this->template->content = View::forge( "commercial/contacts" );
	}

}
