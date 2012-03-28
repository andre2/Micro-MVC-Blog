<?php

class Dashboard extends Application
{

	private $session;
	private $template;

	public function __construct()
	{
		$this->load_model('blog');
		$this->session = $this->load_lib('session');
		$this->template = $this->load_lib('template');
		
		$blocks = array(
			'header' => 'header',
			'sidebar' => 'sidebar',
			'index' => 'index',
			'footer' => 'footer'
			);
		$data = array(
			'title' => 'Dashboard',
			'page_name' => 'Dashboard',
			'authenticated' => $this->session->get_data('authenticated')
			);
		$this->template->init('default', $blocks, $data);
	}
	
	public function index()
	{
		$authenticated = $this->session->get_data('authenticated');
		if( ! isset($authenticated) )
			header('Location: '._BASEURL_.'');
	
		$this->template->set_view('dashboard_index');
		$this->template->render();
		
	}
	
}