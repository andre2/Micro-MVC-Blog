<?php

class Signin extends Application
{

	private $session;

	public function __construct()
	{
		$this->load_model('signin');
		$this->session = $this->load_lib('session');
		$this->template = $this->load_lib('template');
		
		$blocks = array(
			'header' => 'header',
			'sidebar' => 'sidebar',
			'index' => 'index',
			'footer' => 'footer'
			);
		$data = array(
			'title' => 'Sign In',
			'page_name' => 'Sign In'
			);
		$this->template->init('default', $blocks, $data);
	}
	
	public function index()
	{
		$this->template->set_view('signin_index');
			
		if( !$_POST['username'] )
		{
			$data['message'] = 'You must enter a username!';
			$this->template->render($data);
			exit;
		}

		if( !$_POST['password'] )
		{	
			$data['message'] = 'You must enter a password!';
			$this->template->render($data);
			exit;
		}
		
		$user = $this->model->get_user($_POST['username']);
		
		if( !$user )
		{
			$data['message'] = 'That user does not exist!';
			$this->template->render($data);
			exit;
		}
		
		$password = $_POST['username'].$_POST['password'].$user->salt;
		$password = Utility::encrypt($password, $user->salt);
		
		$authenticated = $this->model->auth_user($_POST['username'], $password);
		
		if($authenticated)
		{
			// login OK
			$this->session->set_data('username', $username);
			$this->session->set_data('password', $password);
			$this->session->set_data('authenticated', true);
			
			header('Location: '._BASEURL_.'');
			exit;
		}
		else
		{
			$this->session->close();
			$data['message'] = 'The login information was incorrect.';
			$this->template->render($data);
			exit;
		}
	}

}