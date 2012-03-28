<?php

class Session
{

	public function __construct()
	{
		session_start();
		session_regenerate_id();
	}
	
	public function get_session()
	{
		return $_SESSION;
	}
	
	public function set_data($key, $val)
	{
		$_SESSION["$key"] = $val;
	}
	
	public function get_data($key)
	{
		if( ! isset($_SESSION["$key"]) )
			return null;
			
		return $_SESSION["$key"];
	}
	
	public function unset_data($key)
	{
		unset($_SESSION["$key"]);
	}
	
	public function close()
	{
		$_SESSION = array();

		// If it's desired to kill the session, also delete the session cookie.
		// Note: This will destroy the session, and not just the session data!
		if (ini_get("session.use_cookies")) {
			$params = session_get_cookie_params();
			setcookie(session_name(), '', time() - 42000,
				$params["path"], $params["domain"],
				$params["secure"], $params["httponly"]
			);
		}

		session_destroy();
	}

}