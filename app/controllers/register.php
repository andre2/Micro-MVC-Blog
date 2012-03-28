<?php

class Register extends Application
{

	private $session;

	public function __construct()
	{
		$this->load_model('register');
		$this->session = $this->load_lib('session');
		$this->template = $this->load_lib('template');
		
		$blocks = array(
			'header' => 'header',
			'sidebar' => 'sidebar',
			'index' => 'index',
			'footer' => 'footer'
			);
		$data = array(
			'title' => 'Register',
			'page_name' => 'Register'
			);
		$this->template->init('default', $blocks, $data);
	}
	
	public function index()
	{
		$authenticated = $this->session->get_data('authenticated');
		if( isset($authenticated) )
			header('Location: '._BASEURL_.'');
	
		$this->template->set_view('register_index');
		
		$form_token = md5(uniqid());
		$this->session->set_data('old_token', $this->session->get_data('token'));
		$this->session->set_data('token', $form_token);
		$data['token'] = $form_token;
		
		if( isset($_POST['c']) && $_POST['c'] == 'go' )
		{
		
			$old_token = $this->session->get_data('old_token');
			if($_POST['t'] != $old_token)
			{
				header('Location: '._BASEURL_.'');
				exit;
			}
			
			if( strlen($_POST['username']) < 2 )
			{
				$data['message'] = 'Username must be 3 or more characters!';
				$this->template->render($data);
				exit;
			}

			if( strlen($_POST['username']) > 64 )
			{
				$data['message'] = 'Username must be 64 characters or less!';
				$this->template->render($data);
				exit;
			}

			if( ! Utility::email_valid($_POST['email']) )
			{
				$data['message'] = 'Email must be valid!';
				$this->template->render($data);
				exit;
			}

			if( $_POST['email'] > 320 )
			{
				$data['message'] = 'Email must be 320 characters or less!';
				$this->template->render($data);
				exit;
			}

			if( strlen($_POST['password']) < 6 )
			{
				$data['message'] = 'Password must be 6 or more characters!';
				$this->template->render($data);
				exit;
			}

			if( strlen($_POST['password']) > 123 )
			{
				$data['message'] = 'Password must be 123 characters or less!';
				$this->template->render($data);
				exit;
			}
			
			if( $_POST['password'] != $_POST['vpassword'] )
			{
				$data['message'] = 'Passwords must be equal!';
				$this->template->render($data);
				exit;
			}

			$salt = Utility::gen_rand_str();
			$password = $_POST['username'].$_POST['password'].$salt;
			$password = Utility::encrypt($password, $salt);
			
			$val_code = Utility::gen_rand_str();

			$userdata = array('role_id' => '0',
							  'email' => $_POST['email'],
							  'username' => $_POST['username'],
							  'password' => $password,
							  'salt' => $salt,
							  'ip' => Utility::get_real_ip(),
							  'date_registered' => time(),
							  'validated' => 0,
							  'val_code' => $val_code);
			$this->model->add_user($userdata);
			$data['message'] = 'You\'ve successfully registered!';
		}
		
		$this->template->render($data);
	}

}