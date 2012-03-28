<?php

class Admin_Model
{
	
	private $conn;
	
	public function __construct()
	{
		$this->conn = new Database(DBUSER, DBPASS, DBNAME);
	}

    // Takes in userdata array (field => value)
    public function add_user($userdata)
    {
        $sql = 'INSERT INTO users (';
        $size = count($userdata);
        $count = 0;
        foreach($userdata as $field=>$value)
        {
            $sql .= "$field";

            if($count < ($size-1))
                $sql .= ',';
            $count++;
        }
        $sql .= ') VALUES (';
        $count = 0;
        foreach($userdata as $field=>$value)
        {
            $sql .= ":$field";

            if($count < ($size-1))
                $sql .= ',';
            $count++;
        }
        $sql .= ')';

        $this->conn->query($sql);

        foreach($userdata as $field=>$value)
            $this->conn->bind(":$field", $value);

        $this->conn->execute();
    }

    // Takes in userdata array (field => value)
    public function edit_user($userdata,$user_id)
    {
        $sql = 'UPDATE users SET ';
        $size = count($userdata);
        $count = 0;
        foreach($userdata as $field=>$value)
        {
            $sql .= "$field = :$field";

            if($count < ($size-1))
                $sql .= ', ';
            $count++;
        }
        $sql .= ' WHERE user_id = :user_id';

        $this->conn->query($sql);

        foreach($userdata as $field=>$value)
            $this->conn->bind(":$field", $value);

        $this->conn->bind(":user_id", $user_id);

        $this->conn->execute();
    }

    public function delete_user($user_id)
    {
        $this->conn->query('DELETE FROM users WHERE user_id = :user_id')
            ->bind(':user_id', $user_id)
            ->execute();
    }

    public function get_user($user_id)
    {
        return $this->conn->query('SELECT * FROM users WHERE user_id = :user_id')
            ->bind(':user_id', $user_id)
            ->single();
    }

    // if where provided value required
    public function get_users($where=null,$value=null,$order_by=null,$order='DESC')
    {
        $sql = 'SELECT * FROM users';

        if( ! is_null($where) )
            $sql .= " WHERE $where = :$where";
        if( ! is_null($order_by) )
        {
            $sql .= " ORDER BY $order_by";
            if( $order == 'DESC' )
                $sql .= ' DESC';
            else
                $sql .= ' ASC';
        }

        $this->conn->query($sql);

        if( ! is_null($where) )
            $this->conn->bind(":$where", $value);

        return $this->conn->resultset();
    }
	
	public function add_category($name, $parent_id = 0)
	{
		$slug = Utility::gen_slug($name);
		$this->conn->query('INSERT INTO categories (parent_id, name, slug) VALUES (:parent_id, :name, :slug)')
			->bind(':parent_id', $parent_id)
			->bind(':name', $name)
			->bind(':slug', $slug)
			->execute();
	}
	
	public function edit_category($name, $slug, $cat_id, $parent_id = 0)
	{
		$this->conn->query('UPDATE categories SET parent_id = :parent_id, name = :name, slug = :slug WHERE cat_id = :cat_id')
			->bind(':parent_id', $parent_id)
			->bind(':name', $name)
			->bind(':slug', $slug)
			->bind(':cat_id', $cat_id)
			->execute();
	}
	
	public function get_category($cat_id)
	{
		return $this->conn->query('SELECT * FROM categories WHERE cat_id = :cat_id')
			->bind(':cat_id', $cat_id)
			->single();
	}
	
	public function delete_category($cat_id)
	{
		return $this->conn->query('DELETE FROM categories WHERE cat_id = :cat_id')
			->bind(':cat_id', $cat_id)
			->execute();
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
			$sub_cats = $this->get_sub_cats($root->cat_id);
			$categories["$root->cat_id"]->children = $sub_cats;
		}
		
		return $categories;
	}
	
	public function get_posts()
	{
		return $this->conn->query('SELECT * FROM posts ORDER BY date_posted DESC')->resultset();
	}
	
	public function get_post($post_id)
	{
		return $this->conn->query('SELECT * FROM posts WHERE id = :id')
		->bind(':id', $post_id)
		->single();
	}
	
	public function add_post($postdata)
    {
        $sql = 'INSERT INTO posts (';
        $size = count($postdata);
        $count = 0;
        foreach($postdata as $field=>$value)
        {
            $sql .= "$field";

            if($count < ($size-1))
                $sql .= ',';
            $count++;
        }
        $sql .= ') VALUES (';
        $count = 0;
        foreach($postdata as $field=>$value)
        {
            $sql .= ":$field";

            if($count < ($size-1))
                $sql .= ',';
            $count++;
        }
        $sql .= ')';

        $this->conn->query($sql);

        foreach($postdata as $field=>$value)
            $this->conn->bind(":$field", $value);

        $this->conn->execute();
    }
	
	public function edit_post($postdata,$post_id)
    {
        $sql = 'UPDATE posts SET ';
        $size = count($postdata);
        $count = 0;
        foreach($postdata as $field=>$value)
        {
            $sql .= "$field = :$field";

            if($count < ($size-1))
                $sql .= ', ';
            $count++;
        }
        $sql .= ' WHERE id = :post_id';

        $this->conn->query($sql);

        foreach($postdata as $field=>$value)
            $this->conn->bind(":$field", $value);

        $this->conn->bind(":post_id", $post_id);

        $this->conn->execute();
    }

    public function delete_post($post_id)
    {
        $this->conn->query('DELETE FROM posts WHERE id = :post_id')
            ->bind(':post_id', $post_id)
            ->execute();
    }
}