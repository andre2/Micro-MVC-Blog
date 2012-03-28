<?php

// base url to the application, include http:// and trailing /
define('_BASEURL_', 'http://localhost/blog/');

// development, staging, production
define('_ENVIRONMENT_', 'development');

// database credientials
switch( _ENVIRONMENT_ )
{
	// development database
	case 'development':
		define('DBUSER', 'root');
		define('DBPASS', '');
		define('DBNAME', 'exblog');
		break;
	// staging database
	case 'staging':
		define('DBUSER', 'root');
		define('DBPASS', '');
		define('DBNAME', 'exblog');
		break;
	// production database
	case 'production':
		define('DBUSER', 'root');
		define('DBPASS', '');
		define('DBNAME', 'exblog');
		break;
	default:
		echo 'Environment variable not properly set.';
		die;
}