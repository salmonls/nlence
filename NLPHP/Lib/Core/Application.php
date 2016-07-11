<?php

class Application
{
	public static function run()
	{
		self::__init__();
		self::_set_url();
		spl_autoload_register(array(__CLASS__,'_autoload'));
		self::boot();
		//echo 'app:run';
	}

	private static function __init__()
	{
		C(include CONFIG_PATH . '/Config.php');
		date_default_timezone_set(C('DEFAULT_TIME_ZONE'));
		C('SESSION_START') && session_start();
	}

	private static function _set_url()
	{
		$path = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'];
		define('__APP__', $path);
		define('__ROOT__', dirname(__APP__));
		define('__TPL__',__ROOT__ . '/' . APP_NAME . '/Tpl');
		define('__PUBLIC__',__TPL__ . '/Public');
	}

	private static function _autoload($class_name)
	{
		// $class_name = IndexController.php就不会进来？
		 require APP_PATH . '/Controller/' . $class_name . '.php'; 
	}

	private static function boot()
	{
		$controller = $_GET[C('CONTROLLER_NAME')] ?: 'Index';
		$action = $_GET[C('ACTION_NAME')] ?: 'index';
		//$controller = ucfirst($controller).'Controller'; // 第一次知道类名、方法名不区分大小写
		$controller .= 'Controller';
		$obj = new $controller;
		$obj->$action();
	}
}
?>