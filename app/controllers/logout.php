<?php

class Logout extends Application
{

	private $session;

	public function __construct()
	{
		$this->session = $this->load_lib('session');
	}
	
	public function index()
	{
		echo '<h2>Logout</h2>Logging out...';
		echo $this->session->close();
	}

}