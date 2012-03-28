<?php

class Signin_Model
{
	
	private $conn;
	
	public function __construct()
	{
		$this->conn = new Database(DBUSER, DBPASS, DBNAME);
	}
	
	public function get_user($username)
    {
        return $this->conn->query('SELECT username, salt FROM users WHERE username = :username')
            ->bind(':username', $username)
            ->single();
    }
	
	public function auth_user($username, $password)
    {
        return $this->conn->query('SELECT NULL FROM users WHERE username = :username AND password = :password')
            ->bind(':username', $username)
            ->bind(':password', $password)
            ->single();
    }
	
}