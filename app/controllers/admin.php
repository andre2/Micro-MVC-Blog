<?php

class Admin extends Application
{

	private $session;
	private $template;

	public function __construct()
	{
		$this->load_model('admin');
		$this->session = $this->load_lib('session');
		$this->template = $this->load_lib('template');
		
		$blocks = array(
			'header' => 'header',
			'sidebar' => 'sidebar',
			'index' => 'index',
			'footer' => 'footer'
			);
		$data = array(
			'title' => 'Admin Panel',
			'page_name' => 'Admin Panel'
			);
		$this->template->init('admin', $blocks, $data);
	}
	
	public function index()
	{
		//$this->session->set_data('test', '123456');
		
		$data['page_title'] = 'Site Statistics';
		//$data['articles'] = $this->model->get_all_posts();
		$this->template->set_view('admin_index');
		$this->template->render($data);
    }

	public function posts($vars)
	{	
		$action = ($vars) ? $vars[0] : null;
		switch($action)
		{
			case 'add':
				$data['page_title'] = 'Add Post';
				$this->template->set_view('admin_posts_add');
				
				if( isset($_POST['c']) && $_POST['c'] == 'submit' )
				{
					if( $_POST['slug'] == '' )
						$slug = Utility::gen_slug($_POST['title']);
					else
						$slug = $_POST['slug'];
				
					$postdata = array(
							'author' => 'Austin',
							'title' => $_POST['title'],
							'slug' => $slug,
							'post' => $_POST['post'],
							'date_posted' => time(),
							'cat_id' => $_POST['cid']
						);
					$this->model->add_post($postdata);
					$data['message'] = 'Post Published!';
				}
				
				$data['categories'] = $this->model->get_cat_hierarchy();
				
				break;
			case 'edit':
				$data['page_title'] = 'Edit Post';
				$this->template->set_view('admin_posts_edit');
				
				if( isset($_POST['pid']) )
				{
					if( isset($_POST['c']) && $_POST['c'] == 'submit' )
					{
						
						if( $_POST['slug'] == '' )
							$slug = Utility::gen_slug($_POST['title']);
						else
							$slug = $_POST['slug'];
							
						$postdata = array(
							'author' => 'Austin',
							'title' => $_POST['title'],
							'slug' => $slug,
							'post' => $_POST['post'],
							'cat_id' => $_POST['cid']
						);
					
						$this->model->edit_post($postdata, $_POST['pid']);
						$data['message'] = 'Post edited!';
						
					}

					$data['post'] = $this->model->get_post($_POST['pid']);
				}
				
				$data['categories'] = $this->model->get_cat_hierarchy();
				
				break;
		default:
			$data['page_title'] = 'Manage Posts';
			$this->template->set_view('admin_posts');
			
			if( isset($_POST['c']) && isset($_POST['pid']) && $_POST['c'] == 'delete' )
			{
				$this->model->delete_post($_POST['pid']);
				$data['message'] = 'Post deleted!';
			}
			
			$data['posts'] = $this->model->get_posts();
			break;
		}
		
		$this->template->render($data);
		
	}
	
	public function categories($vars)
	{	
		$action = ($vars) ? $vars[0] : null;
		switch($action)
		{
			case 'add':
				$data['page_title'] = 'Add Category';
				$this->template->set_view('admin_categories_add');
				
				if( isset($_POST['c']) && $_POST['c'] == 'submit' )
				{
					$this->model->add_category($_POST['name'], $_POST['parent']);
					$data['message'] = 'Category added!';
				}
				
				$data['categories'] = $this->model->get_cat_hierarchy();
				
				break;
			case 'edit':
				$data['page_title'] = 'Edit Category';
				$this->template->set_view('admin_categories_edit');
				if( isset($_POST['cid']) )
				{
					if( isset($_POST['c']) && $_POST['c'] == 'submit' )
					{
						if( $_POST['cid'] == $_POST['parent'] )
						{
							$data['message'] = 'You can not set a category to be it\'s own parent!';
						}
						else
						{
							if( $_POST['slug'] == '' )
								$slug = Utility::gen_slug($_POST['name']);
							else
								$slug = $_POST['slug'];
						
							$this->model->edit_category($_POST['name'], $slug, $_POST['cid'], $_POST['parent']);
							$data['message'] = 'Category edited!';
						}
					}
					$data['curcat'] = $this->model->get_category($_POST['cid']);
				}
				$data['categories'] = $this->model->get_cat_hierarchy();
				break;
			default:
				$data['page_title'] = 'Manage Categories';
				$this->template->set_view('admin_categories');
			
				if( isset($_POST['c']) && isset($_POST['cid']) && $_POST['c'] == 'delete' )
				{
					$this->model->delete_category($_POST['cid']);
					$data['message'] = 'Category deleted!';
				}
				
				$data['categories'] = $this->model->get_cat_hierarchy();
				break;
		}
		
		$this->template->render($data);
		
	}
	
	public function users($vars)
	{
		$action = ($vars) ? $vars[0] : null;
		switch($action)
		{
			case 'add':
				$data['page_title'] = 'Add User';
				$this->template->set_view('admin_users_add');
				
				if( isset($_POST['c']) && $_POST['c'] == 'submit' )
				{
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
                                      'validated' => $_POST['validated'],
                                      'val_code' => $val_code);
                    $this->model->add_user($userdata);
					$data['message'] = 'User added!';
				}
				break;
			case 'edit':
				$data['page_title'] = 'Edit User';
				$this->template->set_view('admin_users_edit');

                if( isset($_POST['c']) && isset($_POST['uid']) && $_POST['c'] == 'submit' )
                {
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
					
                    $userdata = array('email' => $_POST['email'],
                                      'username' => $_POST['username'],
                                      'validated' => $_POST['validated']);
                    $this->model->edit_user($userdata, $_POST['uid']);
                    $data['message'] = 'User edited!';
                }

                $data['user'] = $this->model->get_user($_POST['uid']);
				break;
			default:
				$data['page_title'] = 'Manage Users';
				$this->template->set_view('admin_users');

                if( isset($_POST['c']) && isset($_POST['uid']) && $_POST['c'] == 'delete' )
                {
                    $this->model->delete_user($_POST['uid']);
                    $data['message'] = 'User deleted!';
                }

                $data['users'] = $this->model->get_users(null, null, 'date_registered');
				break;
		}
		
		$this->template->render($data);
	}

}