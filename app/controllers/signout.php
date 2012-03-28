<?php

class Signout extends Application
{

	private $session;

	public function __construct()
	{
		$this->session = $this->load_lib('session');
	}
	
	public function index()
	{
		$this->session->close();
		header('Location: '._BASEURL_.'');
	}

}