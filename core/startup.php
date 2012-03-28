<?php

function set_environment()
{
	switch( _ENVIRONMENT_ )
	{
		case 'development':
			error_reporting(E_ALL|E_STRICT); 
			ini_set('display_errors',true);
			break;
		case 'staging':
			error_reporting(E_ALL|E_STRICT);
			ini_set('display_errors',true);
			break;
		case 'production':
			error_reporting(E_ALL|E_STRICT);
			ini_set('log_errors',true);
			ini_set('html_errors',false);
			ini_set('error_log',_ROOTPATH_.'tmp/logs/error_log.txt');
			ini_set('display_errors',false);
			break;
		default:
			error_reporting(0);
			ini_set('display_errors','Off');
			echo 'Environment variable not properly set.';
			die;
	}
}

function startup()
{
	global $url;
	global $route;
	
	if(isset($_GET['url']))
		$url = strtolower($_GET['url']);

	$tmp_uri = preg_split("/[\/]+/", $url, -1, PREG_SPLIT_NO_EMPTY);
	
	$uri['controller'] = (!empty($tmp_uri[0]))? $tmp_uri[0] : $route['default'];
	array_shift($tmp_uri);
	$uri['method'] = (!empty($tmp_uri[0]))? $tmp_uri[0] : 'index';
	array_shift($tmp_uri);
	$uri['vars'] = $tmp_uri;
	
	$app = new Application($uri);
	$app->load_controller();
}

set_environment();
startup();