<?php

class Blog extends Application
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
			'title' => 'Blog App',
			'page_name' => 'Test Blog',
			'authenticated' => $this->session->get_data('authenticated')
			);
		$this->template->init('default', $blocks, $data);
	}
	
	public function index()
	{
		$data['blog_title'] = 'Example Blog testing';
		$data['posts'] = $this->model->get_all_posts();
		$data['categories'] = $this->model->get_cat_hierarchy();
		$this->template->set_view('blog_index');
		$this->template->render($data);
		
	}
	
	public function post($vars)
	{
		if( count($vars) )
		{
			$id = $vars[0];
			if( !is_null($id) )
			{
				if( is_numeric($id) )
					$post = $this->model->get_post_by_id($id);
				else
					$post = $this->model->get_post_by_slug(Utility::gen_slug($id));
					
				if( !$post )
					$data['message'] = 'Post not found.';
				else
					$data['post'] = $post;
			}
			else
				$data['message'] = 'Invalid ID.';
		}
		else
			$data['message'] = 'No posts found.';

		$data['categories'] = $this->model->get_cat_hierarchy();
		$this->template->set_view('blog_post');
        $this->template->render($data);
	}
	
	public function category($vars)
	{
		if( count($vars) )
		{
			$id = $vars[0];
			if( !is_null($id) )
			{
				if( is_numeric($id) )
					$cat = $this->model->get_category($id);
				else
					$cat = $this->model->get_cat_by_slug(Utility::gen_slug($id));
					
				if( !$cat )
					$data['message'] = 'Category not found.';
				else
				{
					$posts = $this->model->get_posts_by_cat_id($cat->cat_id);
					if( ! $posts )
						$data['message'] = 'No posts found.';
					else
						$data['posts'] = $posts;
					$data['post_cat'] = $cat;
				}
			}
			else
				$data['message'] = 'Invalid ID.';
		}
		else
			$data['message'] = 'No categories found.';

		$data['categories'] = $this->model->get_cat_hierarchy();
		$this->template->set_view('blog_category');
        $this->template->render($data);
	}

}