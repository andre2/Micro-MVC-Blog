<?php
/**
 * User: Austin
 * Date: 12/18/11
 * Time: 8:13 PM
 * Utilities class which contains basic functions for mundane tasks
 */
class Utility
{
    private static $instance;

    private function __construct() { }

    public static function get_instance()
    {
        if( empty( self::$instance ) )
        {
            self::$instance = new Utility();
        }
        return self::$instance;
    }

    public static function email_valid($email)
    {
        if( strlen($email) < 3 )
            return false;

        if( strpos( $email, '@' ) == false )
            return false;

        if( strpos( $email, '.' ) == false )
            return false;

        return true;
    }

    public static function gen_rand_str($length=10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $string = '';
        for ($p = 0; $p < $length; $p++)
        {
            $string .= $characters[mt_rand(0, strlen($characters)-1)];
        }
        return $string;
    }

    public static function get_real_ip()
    {
        if( ! empty($_SERVER['HTTP_CLIENT_IP']) )   //check ip from share internet
        {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
        elseif( ! empty($_SERVER['HTTP_X_FORWARDED_FOR']) )   //to check ip is pass from proxy
        {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else
        {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    public static function encrypt($string, $salt)
	{
		return crypt($string, '$6$rounds=5000$'.$salt.'$');
	}
	
	public static function gen_slug($raw)
	{
		$slug = str_replace(' ', '-', $raw);
		$slug = strtolower($slug);
		$slug = urlencode($slug);
		
		return $slug;
	}
	
}
