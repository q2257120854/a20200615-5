<?php if(!defined('ROOT')) die('Access denied.');

class c_opensocket extends Admin{

	public function __construct($path){
		parent::__construct($path);

		header_nocache(); //不缓存
	}

	public function ajax(){
		//判断Socket模块是否加载
		if(!extension_loaded('sockets')) die('php sockets extension not loaded!');

		//判断websocket服务器是否已运行, 没有运行则执行下面的代码创建, 防止重复创建websocket
		if(!add_lock('welive')) die('WEBSOCKET server is running ...');

		// socket接受或发送的最大数据限制(字节) 128K
		define('WEBSOCKET_MAX', 1024 * 128);

		// 最大连接数(设置大些, 可能有: 仅连接不传送信息的非法连接, 无法关闭)
		define('WEBSOCKET_ONLINE', 8000);

		// 屏蔽错误代码
		error_reporting(0);

		// 设置超时时间
		@set_time_limit(0);
		@ignore_user_abort(true); //忽略用户断开连接, 服务器脚本仍运行

		// 设置当前脚本可使用的最大内存, 默认为1024M, 同时连接人数太多时，可能不够
		@ini_set('memory_limit', '1024M');

		//机器人无法匹配答案时随机回复内容数组, 可增减改
		$no_answers = array("呵呵，没搞懂你的意思！[:6:]", 
										"你说啥？请写详细点好吗？我还不是很聪明啊。[:10:]", 
										"这个问题太复杂，请电话联系客服吧！[:9:]", 
										"我暂时无法帮您解答这个问题，请咨询其它事宜吧。",
										"您的问题好难啊，请等真人客服上线吧！[:11:]",
										"唉，没法说，不是我傻就是你不聪明啰。",
										"不懂你说的这些，但我会越来越聪明的。",
										"嗯，记下了您的问题，待俺老孙先研究一番 …… [:9:][:9:][:7:][:7:]",
								);

		//English, 不必同上面中文回复对应, 可多可少
		$no_answers_en = array("Oh, I didn't catch your meaning! [:6:]", 
											"What do you say? Could you write more details, please? I'm not very smart yet. [:10:]", 
											"This question is so complicated. Please contact customer service by telephone. [:9:]", 
											"I can not help you solve this problem for the time being. Please consult other matters.",
											"Your question is very difficult. Please wait for the real customer service online! [:11:]",
											"Alas, there is no way to say that I am not stupid or you are not smart.",
											"I don't understand what you say, but I will become more and more intelligent.",
											"Well, I've written your question, please wait a couple of days for study it ...... [:9:][:9:][:7:][:7:]",
									);

		$websocket = new Websocket(WS_HOST, WS_PORT, '', $no_answers, $no_answers_en);
		$websocket->domain = ''; //允许的域名

		$websocket->run();
		echo socket_strerror($websocket->error());
	}
} 


//锁定文件
function add_lock($keys) {
	global $_lock;

	if(!isset($_lock)) $_lock = array();
	if(isset($_lock[$keys])) return false;
	
	$_lock[$keys]['file'] = ROOT. 'config/'. md5($keys) . '.txt';
	$_lock[$keys]['data'] = fopen($_lock[$keys]['file'], 'w+');

	$locked = flock($_lock[$keys]['data'], LOCK_EX|LOCK_NB);
	
	if(!$locked) {
		fclose($_lock[$keys]['data']);
		unset($_lock[$keys]);
		return false;
	}
	
	return true;
}

//查找IP归属地
function convertip($ip) {
	$return = 'LAN';
	if(preg_match("/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$/", $ip)) {
		$iparray = explode('.', $ip);

		if($iparray[0] == 10 || $iparray[0] == 127 || ($iparray[0] == 192 && $iparray[1] == 168) || ($iparray[0] == 172 && ($iparray[1] >= 16 && $iparray[1] <= 31))) {
			$return = 'LAN';
		} elseif($iparray[0] > 255 || $iparray[1] > 255 || $iparray[2] > 255 || $iparray[3] > 255) {
			$return = '未知'; //无效的IP地址!
		} else {
			$return = convertip_tiny($ip);
		}
	}

	return $return;
}

// ##
function convertip_tiny($ip) {
	static $fp = NULL, $offset = array(), $index = NULL;

	$ipdot = explode('.', $ip);
	$ip    = pack('N', ip2long($ip));

	$ipdot[0] = (int)$ipdot[0];
	$ipdot[1] = (int)$ipdot[1];

	if($fp === NULL && $fp = @fopen(ROOT . 'includes/tinyipdata.dat', 'rb')) {
		$offset = @unpack('Nlen', @fread($fp, 4));
		$index  = @fread($fp, $offset['len'] - 4);
	}elseif($fp == FALSE) {
		return  '未知'; //IP数据库文件不可用
	}

	$length = $offset['len'] - 1028;
	$start  = @unpack('Vlen', $index[$ipdot[0] * 4] . $index[$ipdot[0] * 4 + 1] . $index[$ipdot[0] * 4 + 2] . $index[$ipdot[0] * 4 + 3]);

	for ($start = $start['len'] * 8 + 1024; $start < $length; $start += 8) {
		if ($index{$start} . $index{$start + 1} . $index{$start + 2} . $index{$start + 3} >= $ip) {
			$index_offset = @unpack('Vlen', $index{$start + 4} . $index{$start + 5} . $index{$start + 6} . "\x0");
			$index_length = @unpack('Clen', $index{$start + 7});
			break;
		}
	}

	@fseek($fp, $offset['len'] + $index_offset['len'] - 1024);
	if($index_length['len']) {
		return @fread($fp, $index_length['len']);
	} else {
		return '未知';
	}
}


?>