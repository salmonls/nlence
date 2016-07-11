<?php
	
final class NLPHP
{
	public static function run()
	{
		self::_set_const();
		self::_create_files();
		self::_import_files();
		Application::run();
	}

	private static function _set_const()
	{
		// /Library/WebServer/Documents/nl/NLPHP/NLPHP.php
		define('NLPHP_PATH',dirname(__FILE__));
		define('CONFIG_PATH',NLPHP_PATH . '/Config');
		define('DATA_PATH',NLPHP_PATH . '/Data');
		define('LIB_PATH',NLPHP_PATH . '/Lib');
		define('CORE_PATH',LIB_PATH . '/Core');
		define('FUNCTION_PATH',LIB_PATH . '/Function');

		define('ROOT_PATH', dirname(NLPHP_PATH));
		define('APP_PATH', ROOT_PATH . '/' . APP_NAME);

		// 应用常量
		define('APP_CONFIG_PATH', APP_PATH . '/Config');
		define('APP_CONTROLLER_PATH', APP_PATH . '/Controller');
		define('APP_MODEL_PATH', APP_PATH . '/Model');
		define('APP_TPL_PATH', APP_PATH . '/Tpl');
		define('APP_PUBLIC_PATH', APP_TPL_PATH . '/Public');
		//echo APP_PUBLIC_PATH;
	}

	private static function _create_files()
	{
		$app_dir = array(
			APP_CONFIG_PATH,
			APP_CONTROLLER_PATH,
			APP_MODEL_PATH,
			APP_TPL_PATH,
			APP_PUBLIC_PATH
			);

		foreach ($app_dir as $dir) {
			is_dir($dir) OR mkdir($dir, 0777, true);
		}
	}

	//  ？不用自动加载呢
	private static function _import_files()
	{
		$load_file = array(
			CORE_PATH . '/Application.php',
			FUNCTION_PATH . '/Function.php'
			);
		foreach ($load_file as $file) {
			require_once $file;
		}
	}
}

NLPHP::run();

// the end of the script