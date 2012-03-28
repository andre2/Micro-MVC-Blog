<?php

class Blog_Model
{
	
	private $conn;
	
	public function __construct()
	{
		$this->conn = new Database(DBUSER, DBPASS, DBNAME);
	}
	
	public function get_all_posts()
	{
		return $this->conn->query('SELECT * FROM posts ORDER BY date_posted DESC')
			->resultset();
	}
	
	public function get_post_by_id($id)
	{
		return $this->conn->query('SELECT * FROM posts WHERE id = :id')
			->bind(':id',$id)
			->single();
	}
	
	public function get_post_by_slug($slug)
	{
		return $this->conn->query('SELECT * FROM posts WHERE slug = :slug')
			->bind(':slug',$slug)
			->single();
	}
	
	public function get_posts_by_cat_id($cat_id)
	{
		return $this->conn->query('SELECT * FROM posts WHERE cat_id = :cat_id')
			->bind(':cat_id',$cat_id)
			->resultset();
	}
	
	public function get_category($cat_id)
	{
		return $this->conn->query('SELECT * FROM categories WHERE cat_id = :cat_id')
			->bind(':cat_id', $cat_id)
			->single();
	}
	
	public function get_cat_by_slug($slug)
	{
		return $this->conn->query('SELECT * FROM categories WHERE slug = :slug')
			->bind(':slug', $slug)
			->single();
	}
	
	public function get_root_cats()
	{
		return $this->conn->query('SELECT * FROM categories WHERE parent_id = 0 ORDER BY name ASC')->resultset();
	}
	
	public function get_sub_cats($parent_id)
	{
		return $this->conn->query('SELECT * FROM categories WHERE parent_id = :parent_id ORDER BY name ASC')
			->bind(':parent_id', $parent_id)
			->resultset();
	}
	
	public function get_cat_hierarchy()
	{
		$categories = array();
		$root_cats = $this->get_root_cats();
		foreach( $root_cats as $root )
		{
			$categories["$root->cat_id"] = new stdClass;
			$categories["$root->cat_id"]->name = "$root->name";
			$categories["$root->cat_id"]->slug = "$root->slug";
			$sub_cats = $this->get_sub_cats($root->cat_id);
			$categories["$root->cat_id"]->children = $sub_cats;
		}
		
		return $categories;
	}

}