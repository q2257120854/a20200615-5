<?php if(!defined('ROOT')) die('Access denied.');

class APP{
	/**
	 * 当前控制器对象
	 * @var object
	 */
	public static $C; //调用时注意是大写C

	/**
	 * 数据库访问对象
	 * @var object
	 */
	public static $DB;

	/**
	 * 系统设置数组
	 * @var array
	 */
	public static $_CFG;

	/**
	 * 默认控制器名
	 * @var string
	 */
	public static $defaultController="index";

	/**
	 * 默认动作(方法)名
	 * @var string
	 */
	public static $defaultAction="index";

	/**
	 * 框架主方法 !!!
	 *
	 * @return boolean
	 */
	public static function run(){
		$controller = ForceStringFrom('c'); //注意POST或GET中c和a变量名称被占用
		$action = ForceStringFrom('a');

		$controller	= Iif($controller, $controller, self::$defaultController);
		$action	= Iif($action, $action, self::$defaultAction);

		$app_file = "./controllers/" . $controller . ".php";
		if(!is_file($app_file)){
			self::debug("file[$app_file] does not exists.");
			return false;
		}else{
			require_once(realpath($app_file));
		}

		$classname = 'c_' . $controller;
		if(!class_exists($classname, false)){
			self::debug("class[$classname] does not exists.");
			return false;
		}

		$path[0] = $controller;
		$path[1] = $action;

		self::$C = new $classname($path); //实例化控件类, 设置为APP当前的控件对像

		if(!method_exists(self::$C, $action)){
			self::debug("method[$action] does not exists in class[$classname].");
			return false;
		}

		return call_user_func(array(& self::$C, $action), $path);
	}

	/**
	 * @var boolean 显示调试信息
	 */
	private static function debug($debugmsg){
		include('errors/404.php');
	}
}

?>