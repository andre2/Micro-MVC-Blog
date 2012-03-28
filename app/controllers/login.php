<?php

class Login extends Application
{

	private $session;

	public function __construct()
	{
		$this->session = $this->load_lib('session');
	}
	
	public function index()
	{
		echo '<h2>Login</h2>';
		echo $this->session->get_data('test');
	}

}