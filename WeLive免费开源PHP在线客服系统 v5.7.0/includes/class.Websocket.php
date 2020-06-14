<?php if(!defined('ROOT')) die('Access denied.');

class Websocket{
	var $host = '127.0.0.1'; //监听服务器
	var $port = 843; //监听端口
	var $path = '/'; //监听路径
	var $domain = ''; //允许的域名
	var $socket = null; //监听的资源(即socket_create()函数生成的socket资源)
	var $accept = array(); //全部用户连接(即socket_accept()函数生成的连接资源)
	var $cycle = array(); //阻塞请求(循环时使用)
	var $type = array();//用户连接的类型: 1, 2, false, 其中: 1指10- 版本请求类型(不支持socket浏览器如IE);  2指10+ 版本请求类型(Firefox等); false指非法用户(未通过验证)
	var $class = array(); //数据储存类

	var $admin = array(); //客服数组
	var $guest = array(); //客人数组

	var $is_robot = 0; //是否是机器人服务(1表示无人值守, 即机器人自动回复, 此时留言功能失效)
	var $robot = array(); //机器人信息

	/**
	*	构造函数
	*
	*	1 参数 连接 host
	*	2 参数 连接 port
	*
	**/
	function __construct($host, $port, $path = '', $no_answers = array(), $no_answers_en = array()){
		$this->host = $host;
		$this->port = $port;
		if($path) $this->path = $path;
		$this->class[1] = new class_websocket_1;
		$this->class[2] = new class_websocket_2;
	
		//机器的aid为888888, 连接索引为-1
		$this->robot = array(
			"aid" => 888888, 
			"aix" => -1, 
			"fullname" => APP::$_CFG['RobotName'], 
			"fullname_en" => APP::$_CFG['RobotName_en'], 
			"post" => APP::$_CFG['RobotPost'], 
			"post_en" => APP::$_CFG['RobotPost_en'], 
			"totals" => 0, 
			"guests" => 0, 
		);
	}

	
	/**
	*	运行 run
	*
	*	返回 false or true
	**/
	function run() {
		if (!$this->socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) return false;

		// 允许端口释放后立即就可用
		socket_set_option($this->socket, SOL_SOCKET, SO_REUSEADDR, true);
		
		// 接收缓冲区 最大字节
		socket_set_option($this->socket, SOL_SOCKET, SO_RCVBUF, WEBSOCKET_MAX);
		
		// 发送缓冲区 最大字节
		socket_set_option($this->socket, SOL_SOCKET, SO_SNDBUF, WEBSOCKET_MAX);

		// 绑定端口
		if(WS_HEAD == "wss://"){
			$socket_port = "8431"; //https下绑定8431端口
		}else{
			$socket_port = $this->port;
		}
		if(!socket_bind($this->socket, "0.0.0.0", $socket_port)) return false;
	
		// 监听端口
		if(!socket_listen($this->socket, WEBSOCKET_MAX)) return false;

		//监听成功后修改mysql数据库wait_timeout, 否则当此socket进程长驻, 而mysql空闲8小时(默认), 此进程将针法连接数据库, 客服无法登录
		APP::$DB->query("SET session wait_timeout=31536000"); //一年

		
		while(true) {
			// 设置阻塞请求
			$this->cycle = $this->accept; //所有连接资源(用户)数组
			$this->cycle[] = $this->socket; //将当前的socket资源添加到cycle数组中

			//socket_select多路选择, 监视状态发生改变连接资源(即是否有数据传送). $write参数指写入状态未阻塞的连接资源数组, $except指前面除外的连接资源数组.
			//由于Zend Engine的限制, $write, $except参数可能需要以已存在的变量传递, 而不能直接将null类型的变量作为参数.
			//参数null表示阻塞函数运行, 用于监视连接, 也就是说只有传送来了数据, 才往下执行. 没有数据时等待
			socket_select($this->cycle, $write = null, $except = null, null);

			foreach($this->cycle as $v){
	
				if($v === $this->socket){ //如果是socket资源, 通过socket_accept函数获取新连接的用户

					//返回socket新连接资源, 如果某个socket上有多个新连接，则返回第一个连接资源
					//如果没有任何连接，此函数将阻塞，直接有一个新连接为止
					if(!$accept = socket_accept($v)) continue;

					//记录当前连接, 即用户. 如果是flash客户端(IE), 首次连接时将记录成两个用户连接(其中flash形成了一个socket连接, 且下面的代码中自动将其关闭)
					//当前脚本运行时不会识别成连接, 因为浏览器未传送websocket类型的数据
					$this->accept[] = $accept;

					$index = array_keys($this->accept); //连接的键值, 用户数组的索引值
					$index = end($index); //每次socket脚本重启后, index均从0开始递增
					$this->type[$index] = false; //当前用户类型, 先设置为false, 指未确实的用户类型(未通过验证)

					continue;
				}
				
				//在$this->accept数组中查找用户连接, 如果在循环中被删除了, 继续下一个循环
				if(($index = $this->search($v)) === false) continue;

				//接收数据, socket_recv返回接受数据的字节数, 参数0表示函数阻塞(block)直到WEBSOCKET_MAX长度的数据接收完毕
				if(!socket_recv($v, $data, WEBSOCKET_MAX, 0) || !$data) {

					//如果没有任何数据, 表示当前用户已断开连接, 则关闭此连接, 并更新用户列表等数据
					$this->close($v, $index); //10-类型(IE)连接断开时, 关闭连接
					continue;
				}

				$type = $this->type[$index]; //用户类型

				//对新连接的数据进行处理, 以确定其连接类型(连接的header信息只在第一次读取信息存在)
				if($type === false) {
					$type = $this->header($data, $v, $index); //验证header, 以便确定用户类型或是否为合法用户
					if($type === false) {
						$this->close($v, $index, 0); //关闭无效或不合法的连接且不发送通知信息(参数0表示不发送通知信息), flashsocket插件连接此时关闭. 如果连接总数超过限定总数, 此时也会关闭
						continue;
					}
					$this->type[$index] = $type; //设置当前用户的客户端类型

					continue;
				}

				//解析已确定类型的用户数据, 如果返回空数据, 则关闭
				if(!$data = $this->class[$type]->decode($data)){
					$this->close($v, $index); //10+类型(html5, firefox等)连接断开连接, 此时关闭
					continue;
				}

				//处理数据及发送
				//foreach($data as $d) $this->welive_call($d, $v, $index);
				$this->welive_call($data, $v, $index);
			}
		}
	
		return true;
	}


	//处理接收的数据或发送数据(不包括API)
	function welive_call($data, $accept, $index){
		$data = string_to_array($data);

		switch($data['x']){
			case 9: //心跳   为确保长联接发送的数据类型

				//既不客人也不是客服时, 断开连接
				/* 为高性能注释此代码
				if(!array_key_exists($index, $this->guest) AND !array_key_exists($index, $this->admin)){
 					$this->close($accept, $index, 0); //非法信息, 断开连接, 不通知
				}
				*/

				if($data['i'] != 1) $this->close($accept, $index, 0); //心跳数据为特殊格式: x=9&i=1

				return false; //不进行任何信息处理

				break;

			case 8: //人工客服发来的标记已读信息

				//客服发来的标记已读信息: x=9&g=gid
				if(!$this->checkAdmin($accept, $index)) return false;

				$gid = ForceInt($data['g']);
				$gix = $this->guestIndex($gid);

				if($gix !== false){
					$this->send(array('x' => 8), $this->accept[$gix], $gix); //给客人
				}

				break;

			case 4: //客人实时输入状态
				if(!$this->checkGuest($accept, $index)) return false;

				$aix = $this->guest[$index]['aix']; //客服的连接索引

				switch($data['a']){
					case 1: //有输入状态更新时

						$msg = decodeChar($data['i']); //将特殊处理的字符恢复, 写数据时再过滤
						if(strlen($msg) > 1024) $msg = "... too long ..."; //超过 1k 字节

						$this->send(array('x' => 4, 'a' => 1, 'g' => $this->guest[$index]['gid'], 'i' => $msg), $this->accept[$aix], $aix); //将信息发给客服

						break;

					case 2: //客人输入框已清空

						$this->send(array('x' => 4, 'a' => 2, 'g' => $this->guest[$index]['gid']), $this->accept[$aix], $aix);

						break;
				}

				break;

			case 1: //客服群聊
				if(!$this->checkAdmin($accept, $index)) return false;

				$msg = decodeChar($data['i']); //将特殊处理的字符恢复
				if(strlen($msg) > 2048) $msg = "... too long ..."; //超过 2k 字节

				//管理员特殊指令
				if($this->admin[$index]['type']){
					$spec = 0;
					switch($msg){
						case 'system die':
							APP::$DB->query("SET session wait_timeout=60"); //60秒后, 关闭mysql守护进程
							die(); //socket服务中断
							break;
						case 'all':
							$spec = 1;
							$msg = 'Total connections = ' . count($this->accept) . '<br>Total admins = ' . count($this->admin) . '<br>Total guests = ' . count($this->guest) . '<br>Admin services = ' . (count($this->guest) - $this->robot['guests']) . '<br>Robot services = ' . $this->robot['guests'];
							break;
						case 'admin':
							$spec = 1;
							$msg = 'Total admins = ' . count($this->admin);
							foreach($this->admin AS $a){
								$msg .= "<br>$a[fullname] = $a[guests]";
							}
							break;
						case 'guest':
							$spec = 1;
							$msg = 'Total guests = ' . count($this->guest);
							break;

						case 'robot':
							$spec = 1;
							$msg = 'Robot total guests = ' .  $this->robot['totals'] . '<br>Robot current guests = ' . $this->robot['guests'];
							break;
					}

					if($spec){
						$this->send(array('x' => 1, 'aid'=> $this->admin[$index]['aid'], 'av'=> $this->admin[$index]['avatar'], 'n'=> $this->admin[$index]['fullname'], 'p'=> $this->admin[$index]['post'], 't' => $this->admin[$index]['type'], 'i' => $msg), $accept, $index);
						return true;
					}
				}

				$this->ws_send_all(array('x' => 1, 'aid'=> $this->admin[$index]['aid'], 'av'=> $this->admin[$index]['avatar'], 'n'=> $this->admin[$index]['fullname'], 'p'=> $this->admin[$index]['post'], 't' => $this->admin[$index]['type'], 'i' => $msg));
				break;

			case 2: //客服特别操作及反馈信息
				if($data['a'] != 8 AND !$this->checkAdmin($accept, $index)) return false;

				switch($data['a']){
					case 3: //挂起
						if(isset($this->admin[$index])) $this->admin[$index]['busy'] = 1; //挂起状态
						$this->ws_send_all(array('x' => 2, 'a' => 3, 'ix' =>$index));
						break;

					case 4: //解除挂起
						if(isset($this->admin[$index])) $this->admin[$index]['busy'] = 0; //服务状态
						$this->ws_send_all(array('x' => 2, 'a' => 4, 'ix' =>$index));
						break;

					case 5: //获取客人信息
						$gid = ForceInt($data['g']);
						if($gid){
							$guest = APP::$DB->getOne("SELECT lastip, ipzone, fromurl, grade, fullname, address, phone, email, remark FROM " . TABLE_PREFIX . "guest WHERE gid = '$gid'");
							if(!empty($guest)) {
								$this->send(array('x' => 2, 'a' => 5, 'g' => $gid, 'd' => $guest), $accept, $index); //返回数据给自己
							}
						}

						break;

					case 6: //保存客人信息
						$gid = ForceInt($data['g']);
						if($gid){
							$grade = ForceInt($data['grade']);
							$fullname = ForceData($data['fullname']);
							$address = ForceData($data['address']);
							$phone = ForceData($data['phone']);
							$email = ForceData($data['email']);
							$remark = ForceData($data['remark']);

							//更新在线访客的姓名
							$gix = $this->guestIndex($gid);
							if($gix){
								$this->guest[$gix]['fullname'] = $fullname;
							}

							APP::$DB->exe("UPDATE " . TABLE_PREFIX . "guest SET grade = '$grade', fullname = '$fullname', address = '$address', phone = '$phone', email = '$email', remark = '$remark' WHERE gid = '$gid'");

							$this->send(array('x' => 2, 'a' => 6, 'g' => $gid, 'n' => $fullname), $accept, $index); //返回数据给自己
						}

						break;

					case 8: //管理员登录验证
						$aid = ForceInt($data['id']); //aid
						$sid = $data['s']; //session id
						$agent =  $data['ag']; //浏览器
						$from = ForceInt($data['fr']); //0来自web, 1来自移动端

						//过滤非法字符
						if(!$aid OR !IsAlnum($sid) OR !IsAlnum($agent)){
							$this->close($accept, $index, 0); //用户不合法, 断开连接, 不通知
							return false;
						}

						$sql = "SELECT a.aid, a.type, a.username, a.fullname, a.fullname_en, a.post, a.post_en, a.lastip AS ip
									FROM " . TABLE_PREFIX . "session s
									LEFT JOIN " . TABLE_PREFIX . "admin a ON a.aid = s.aid
									WHERE s.sid    = '$sid'
									AND s.aid = '$aid'
									AND s.agent = '$agent'
									AND a.activated = 1";

						$admin = APP::$DB->getOne($sql);
						if(!$admin OR !$admin['aid']){
							$this->close($accept, $index, 0); //用户不合法, 断开连接, 不通知
							return false;
						}

						//将客服状态设置成服务中
						APP::$DB->exe("UPDATE " . TABLE_PREFIX . "admin SET online = 1  WHERE aid = '$aid'");

						$avatar = GetAvatar($admin['aid'], 1); //仅返回文件名

						//清除重复登录的客服
						$this->clearAdmin($aid);

						//先通知已登录客服
						$this->ws_send_all(array('x' => 2, 'a' => 1, 'ix' =>$index, 'id' => $admin['aid'], 't' => $admin['type'], 'n' => $admin['fullname'], 'p' => $admin['post'], 'av' => $avatar, 'fr' => $from));

						//更新socket客服数组
						$this->admin[$index] = $admin;
						$this->admin[$index]['busy'] = 0; //是否忙碌(挂起状态)
						$this->admin[$index]['avatar'] = $avatar; //头像文件名
						$this->admin[$index]['from'] = $from; //0来自web, 1来自移动端

						//查找所有属于自己的客人并发送上线通知
						$guest_list = array();

						if(!$this->is_robot){ //非无人值守时
							foreach($this->guest AS $k => $g){
								if($g['aid'] == $aid){

									$this->guest[$k]['aix'] = $index; //更新客人信息中客服的连接索引

									$this->send(array('x' => 6, 'a' => 1), $this->accept[$k], $k);
									$guest_list[] = array('g' => $g['gid'], 'n' => $g['fullname'], 'iz' => $g['ipzone'], 'l' => $g['l'], 'au' => $g['au'], 'mb' => $g['mb']); //记录仍然在线的属于自己的客人, au指上传授权
								}
							}
						}
						$this->admin[$index]['guests'] = count($guest_list); //计算自己的客人数

						$admin_list = array();
						foreach($this->admin AS $k => $a) {
							$admin_list[] = array('ix' =>$k, 'id' => $a['aid'], 't' => $a['type'], 'n' => $a['fullname'], 'p' => $a['post'], 'av' => $a['avatar'], 'b' => $a['busy'], 'fr' => $a['from']);
						}

						//将所有已登录的客服数据(包括自己), 及属于自己且在线的客人信息发送给自己
						$this->send(array('x' => 2, 'a' => 8, 'ix' => $index, 'irb' => $this->is_robot, 'rn' => $this->robot['fullname'], 'rp' => $this->robot['post'], 'al' => $admin_list, 'gl' => $guest_list), $accept, $index);

						break;

					case 9: //重启socket
						if($this->admin[$index]['type'] == 1) {
							APP::$DB->query("SET session wait_timeout=60"); //60秒后, 关闭mysql守护进程
							die(); //socket服务中断, 再通过ajax重启
						}
						break;

					case 10: //开启无人值守

						break;

					case 11: //关闭无人值守

						break;
				
				}

				break;

			case 5: //客人与客服相互对话
				$msg = decodeChar($data['i']); //将特殊处理的字符恢复, 写数据时再过滤

				if(strlen($msg) > 2048) $msg = "... too long ..."; //超过 2k 字节

				if(array_key_exists($index, $this->guest)){ //来自客人
					$aix = $this->guest[$index]['aix']; //客服的连接索引

					$this->send(array('x' => 5, 'a' => 2), $accept, $index); //返回给客人自己一条简单信息

					$this->send(array('x' => 5, 'a' => 2, 'g' => $this->guest[$index]['gid'], 'i' => $msg), $this->accept[$aix], $aix); //将信息发给客服

					$fromid = $this->guest[$index]['gid'];
					$fromname = Iif($this->guest[$index]['fullname'], $this->guest[$index]['fullname'], Iif($this->guest[$index]['l'], '客人', 'Guest') . $fromid);
					$toid = $this->admin[$aix]['aid'];
					$toname = $this->admin[$aix]['fullname'];
					$msg = ForceData($msg);

					APP::$DB->exe("INSERT INTO " . TABLE_PREFIX . "msg (type, fromid, fromname, toid, toname, msg, time)
							VALUES (0, '$fromid', '$fromname', '$toid', '$toname', '$msg', '" . time() . "')");

				}elseif(array_key_exists($index, $this->admin)){ //来自客服
					$gid = ForceInt($data['g']);
					$gix = $this->guestIndex($gid);

					if($gix !== false){
						$this->send(array('x' => 5, 'a' => 1, 'i' => $msg), $this->accept[$gix], $gix); //给客人
						$this->send(array('x' => 5, 'a' => 1, 'g' => $gid, 'i' => $msg), $accept, $index); //给自己

						$fromid = $this->admin[$index]['aid'];
						$fromname = $this->admin[$index]['fullname'];
						$toname = Iif($this->guest[$gix]['fullname'], $this->guest[$gix]['fullname'], Iif($this->guest[$gix]['l'], '客人', 'Guest') . $gid);
						$msg = ForceData($msg);

						APP::$DB->exe("INSERT INTO " . TABLE_PREFIX . "msg (type, fromid, fromname, toid, toname, msg, time)
								VALUES (1, '$fromid', '$fromname', '$gid', '$toname', '$msg', '" . time() . "')");
					}

				}else{
					$this->close($accept, $index, 0); //非法信息, 断开连接, 不通知
				}

				break;

			case 6: //客人特别操作及反馈信息

				switch($data['a']){

					case 8: //客人连接验证及分配给客服
						$key = $data['k'];
						$code = decodeChar($data['c']); //code有特殊字符必须恢复, 否则无法验证客人登录
						$decode = authcode($code, 'DECODE', $key);
						if($decode != md5(WEBSITE_KEY . APP::$_CFG['KillRobotCode'])){
							$this->close($accept, $index, 0); //用户不合法, 断开连接, 不通知
							return false;
						}

						$gid = ForceInt($data['gid']);
						$aid = ForceInt($data['aid']);
						$fullname = ForceData($data['fn']); //客人姓名
						$first = Iif($aid, 0, 1); //如果返回了aid, 表示不是首次连接, 而是断线重连
						$hasRecord = 0; //客人是否在数据库里
						$authupload = ForceInt($data['au']); //客人是否有上传授权
						$session = ''; //客人第一次连接时(非重连), 产生一个session会话记录, 用于验证上传图片, 以免产生非法操作

						//清理已经存在的客人
						$this->clearGuest($gid);

						if($gid AND $first){ //首次连接且有gid时, 断线重连时无需更新访客信息
							$guest = APP::$DB->getOne("SELECT aid, fullname, upload FROM " . TABLE_PREFIX . "guest WHERE gid = '$gid'");
							if($guest AND $guest['aid']) {
								$aid = $guest['aid']; //以前服务过的客服aid
								if(!$fullname AND $guest['fullname']) $fullname = $guest['fullname'];
								$hasRecord = 1;
								$authupload = $guest['upload'];
							}
						}

						$admin_index = $this->select_admin($aid); //分配给客服
						if($admin_index === false){ //无法分配客服, 返回特殊信息通知客人

							$this->send(array('x' => 6, 'a' => 9), $accept, $index);
							$this->close($accept, $index, 0); //断开连接, 无通知(无法分配客服算非法连接)
							return false;
						}

						if(isset($this->admin[$admin_index])) $this->admin[$admin_index]['guests'] += 1; //客服的客人数加1
						$aid = $this->admin[$admin_index]['aid']; //选择客服成功后重新定义aid

						$lang = ForceInt($data['l']);
						$fromurl = ForceData($data['fr']); //将特殊处理的字符恢复
						$browser = ForceData($data['ag']);
						$mobile = ForceInt($data['mb']); //是否为移动端

						if(WS_HEAD == "wss://"){
							$lastip = ForceData($data['ip']); //从前台传送来的ip
						}else{
							$lastip = $this->ip($accept); //获得连接的ip
						}

						$ipzone = trim(convertip_tiny($lastip)); //IP归属地
						if($ipzone != "中国"){
							$ipzone = str_replace(array("中国", "台湾", "香港", "澳门"), array("", "中国台湾", "中国香港", "中国澳门"), $ipzone);
						}

						$timenow = time();

						$recs = array(); //聊天记录

						if($first AND $gid AND $hasRecord){  //首次连接, 有gid, 且在数据库中有记录时, 更新存在的客人信息 === 即老客人第一次登录, 非重连
							$session = md5(uniqid(COOKIE_KEY. microtime())); //每次登录更新客人的session

							APP::$DB->exe("UPDATE " . TABLE_PREFIX . "guest SET aid = '$aid', lang ='$lang', logins = (logins + 1), last = '$timenow', lastip = '$lastip', ipzone = '$ipzone', browser = '$browser', mobile = '$mobile', fromurl = '$fromurl', fullname = '$fullname', session = '$session' WHERE gid = '$gid'");

							$limit = ForceInt(APP::$_CFG['Record']);
							if($limit){
								$records = APP::$DB->query("SELECT type, fromid, fromname, msg, filetype, time FROM " . TABLE_PREFIX . "msg WHERE (type = 0 AND fromid = '$gid') OR (type = 1 AND toid = '$gid') ORDER BY mid DESC LIMIT $limit");

								while($r = APP::$DB->fetch($records)){
									$recs[] = array('t' =>$r['type'], 'fid' =>$r['fromid'], 'f' =>$r['fromname'], 'm' => $r['msg'], 'ft' => $r['filetype'], 'd' => DisplayDate($r['time'], 'H:i:s', 1));
								}

								$recs = array_reverse($recs); //数组反转一下
							}

						}elseif($first){ //首次连接且客人不存在时添加新客人

							$session = md5(uniqid(COOKIE_KEY. microtime())); //每次登录更新客人的session

							APP::$DB->exe("INSERT INTO " . TABLE_PREFIX . "guest (aid, upload, lang, last, lastip, ipzone, browser, mobile, fromurl, fullname, remark, session)
									VALUES ('$aid', '0', '$lang', '$timenow', '$lastip', '$ipzone', '$browser', '$mobile', '$fromurl', '$fullname', '', '$session')");

							$gid = APP::$DB->insert_id; //新客人的ID号

						}else{ //客人断线重新连接

						}

						//记录客人信息
						$this->guest[$index] = array('gid' => $gid, 'aid' => $aid, 'aix' => $admin_index, 'fullname' => $fullname, 'ipzone' => $ipzone, 'l' => $lang, 'mb' => $mobile, 'au' => $authupload);

						//给客服发送通知: 客人上线
						$this->send(array('x' => 6, 'a' => 8, 'g' => $gid, 'au' => $authupload, 'n' => $fullname, 'fr' => $fromurl, 'iz' => $ipzone, 'l' => $lang, 'mb' => $mobile, 're' => $recs), $this->accept[$admin_index], $admin_index);

						$is_robot = 0;

						//发送客人登录成功通知, 及客服信息
						if($lang){ //中文
							$a_n = $this->admin[$admin_index]['fullname'];
							$a_p = $this->admin[$admin_index]['post'];
						}else{
							$a_n = $this->admin[$admin_index]['fullname_en'];
							$a_p = $this->admin[$admin_index]['post_en'];
						}

						$avatar = $this->admin[$admin_index]['avatar'];

						//登录成功返回信息给自己
						$this->send(array('x' => 6, 'a' => 8, 'gid' => $gid, 'au' => $authupload, 'irb' => $is_robot, 'sess' => $session, 'fn' => $fullname, 'aid' => $aid, 'an' => $a_n, 'p' => $a_p, 'av' => $avatar, 're' => $recs), $accept, $index);

						break;

					case 5: //客人不活动超时, 自动离线
						if(!$this->checkGuest($accept, $index)) return false;

						$this->send(array('x' => 6, 'a' => 5), $accept, $index); //返回给自己

						$aix = $this->guest[$index]['aix']; //客服的连接索引

						$this->close($accept, $index); //断开连接合法连接

						break;

					case 6: //踢出客人, 验证客服
						if(!$this->checkAdmin($accept, $index)) return false;

						$gid = ForceInt($data['g']);
						$gix = $this->guestIndex($gid);

						if($gix !== false){ //客人在线时
							if(isset($this->admin[$index]) AND $this->admin[$index]['guests'] > 0) $this->admin[$index]['guests'] -= 1; //客服的客人数减1
							$this->send(array('x' => 6, 'a' => 6), $this->accept[$gix], $gix); //发踢出指令
							unset($this->guest[$gix]); //删除客人
							$this->close($this->accept[$gix], $gix, 0); //关闭其连接, 不发通知
						}
						if($gid) APP::$DB->exe("UPDATE " . TABLE_PREFIX . "guest SET banned = (banned + 1) WHERE gid = '$gid'"); //无论是否在线均记录在案

						break;

					case 7: //禁止客人发言
						if(!$this->checkAdmin($accept, $index)) return false;

						$gid = ForceInt($data['g']);
						$gix = $this->guestIndex($gid);
						if($gix !== false) $this->send(array('x' => 6, 'a' => 7), $this->accept[$gix], $gix);

						break;

					case 10: //解除禁言
						if(!$this->checkAdmin($accept, $index)) return false;

						$gid = ForceInt($data['g']);
						$gix = $this->guestIndex($gid);
						if($gix !== false) $this->send(array('x' => 6, 'a' => 10), $this->accept[$gix], $gix);

						break;

					case 11: //转接客人
						if(!$this->checkAdmin($accept, $index)) return false;

						$this->tranferGuest($data, $accept, $index, 0);

						break;

					case 12: //客人的当前客服断线, 等候超过限定时间后, 请求重新分配客服
						if(!$this->checkGuest($accept, $index)) return false;

						$this->tranferGuest($data, $accept, $index, 1); //1表示是来自客人的请求转接客服

						break;

					case 13: //客人请求立即回电话
						if(!$this->checkGuest($accept, $index)) return false;

						$msg = decodeChar($data['i']); //将特殊处理的字符恢复, 写数据时再过滤

						if(strlen($msg) > 100){
							$this->close($accept, $index, 0); //用户不合法, 断开连接, 不通知
							return false;
						}

						$this->send(array('x' => 6, 'a' => 13), $accept, $index); //返回给客人自己一条简单信息

						$aix = $this->guest[$index]['aix']; //客服的连接索引

						$this->send(array('x' => 6, 'a' => 13, 'g' => $this->guest[$index]['gid'], 'i' => $msg), $this->accept[$aix], $aix); //将信息发给客服

						$fromid = $this->guest[$index]['gid'];
						$fromname = Iif($this->guest[$index]['fullname'], $this->guest[$index]['fullname'], Iif($this->guest[$index]['l'], '客人', 'Guest') . $fromid);
						$toid = $this->admin[$aix]['aid'];
						$toname = $this->admin[$aix]['fullname'];
						$msg = ForceData($msg);

						APP::$DB->exe("INSERT INTO " . TABLE_PREFIX . "msg (type, fromid, fromname, toid, toname, msg, time)
								VALUES (0, '$fromid', '$fromname', '$toid', '$toname', '$msg', '" . time() . "')");

						break;

					case 14: //客人评价客服
						if(!$this->checkGuest($accept, $index)) return false;

						$gid = $this->guest[$index]['gid']; //客人id
						$aid = $this->guest[$index]['aid']; //客服id
						$score = ForceInt($data['s']);
						$msg = ForceData(decodeChar($data['i'])); //将特殊处理的字符恢复, 过滤

						if(!$score OR !$aid) return false;

						//每天仅允许评价2次
						$max_rating = 2;
						$sql_time = time() - 3600*24;
						$result = APP::$DB->getOne("SELECT COUNT(rid) AS nums FROM " . TABLE_PREFIX . "rating WHERE gid = '{$gid}' AND aid = '{$aid}' AND time > '{$sql_time}'");

						if($result AND $result['nums'] >= $max_rating){
							$this->send(array('x' => 6, 'a' => 14, 's' => 2), $accept, $index); //失败 评价超每天限制的数量
							return false;
						}

						APP::$DB->exe("INSERT INTO " . TABLE_PREFIX . "rating (gid, aid, score, msg, time)
								VALUES ('$gid', '$aid', '$score', '$msg', '" . time() . "')");

						$this->send(array('x' => 6, 'a' => 14, 's' => 1), $accept, $index); //成功 返回给客人自己

						break;

				}

				break;

			case 7: //客人上传图片

				break;

			default: //其它数据类型为非法, 关闭连接无通知
				$this->close($accept, $index, 0);
				break;
		}
	}


	//转接客人给指定客服: guest_query = 1表示客人请求转接客服
	function tranferGuest($data, $accept, $index, $guest_query = 0){
		$gid = ForceInt($data['g']);
		$gix = $this->guestIndex($gid);

		if($guest_query){//客人请求转接客服时 分配客服

			$aix = $this->select_admin(0); 
			$aid = $this->admin[$aix]['aid'];

			if(!$gid OR $gix === false OR $aix === false){ //无法分配客服, 返回特殊信息通知客人

				$this->send(array('x' => 6, 'a' => 9), $accept, $index);
				$this->close($accept, $index, 0); //断开客人连接, 无通知
				return false;
			}

		}else{ //客服转接客人

			$aix = ForceInt($data['aix']); //收受的客服连接索引
			$aid = $this->admin[$aix]['aid'];

			if(!$gid OR $gix === false OR !isset($this->admin[$aix])){
				$this->send(array('x' => 6, 'a' => 11, 'g' => $gid, 'i' => 0), $accept, $index); //转接失败 通知当前客服
				return false;
			}
		}


		//更新客人的信息
		if(isset($this->guest[$gix])){
			$this->guest[$gix]['aid'] = $aid;
			$this->guest[$gix]['aix'] = $aix;
		}


		$is_robot = 0;

		//根据客人的语言选择客服信息
		if($this->guest[$gix]['l']){ //中文
			$a_n = $this->admin[$aix]['fullname'];
			$a_p = $this->admin[$aix]['post'];
		}else{
			$a_n = $this->admin[$aix]['fullname_en'];
			$a_p = $this->admin[$aix]['post_en'];
		}

		$avatar = $this->admin[$aix]['avatar'];

		$recs = array(); //聊天记录
		$limit = ForceInt(APP::$_CFG['Record']);
		if($limit){
			$records = APP::$DB->query("SELECT type, fromid, fromname, msg, filetype, time FROM " . TABLE_PREFIX . "msg WHERE (type = 0 AND fromid = '$gid') OR (type = 1 AND toid = '$gid') ORDER BY mid DESC LIMIT $limit");

			while($r = APP::$DB->fetch($records)){
				$recs[] = array('t' =>$r['type'], 'fid' =>$r['fromid'], 'f' =>$r['fromname'], 'm' => $r['msg'], 'ft' => $r['filetype'], 'd' => DisplayDate($r['time'], 'H:i:s', 1));
			}

			$recs = array_reverse($recs); //数组反转一下
		}

		//给接收的客服发一条客人上线通知, 及最近的对话记录 
		$this->send(array('x' => 6, 'a' => 8, 'g' => $gid, 'n' => $this->guest[$gix]['fullname'], 'au' => $this->guest[$gix]['au'], 'l' => $this->guest[$gix]['l'], 'mb' => $this->guest[$gix]['mb'], 're' => $recs), $this->accept[$aix], $aix);

		if($guest_query){//客人请求转接时
			//给客人自己发转接通知
			$this->send(array('x' => 6, 'a' => 11, 'aid' => $aid, 'an' => $a_n, 'p' => $a_p, 'av' => $avatar, 'au' => $this->guest[$gix]['au'], 'irb' => $is_robot), $accept, $index);

		}else{//客服转接客人时
			//给被转接的客人发通知
			$this->send(array('x' => 6, 'a' => 11, 'aid' => $aid, 'an' => $a_n, 'p' => $a_p, 'av' => $avatar, 'au' => $this->guest[$gix]['au'], 'irb' => $is_robot), $this->accept[$gix], $gix);

			//给客服自己发一条转接成功的信息
			$this->send(array('x' => 6, 'a' => 11, 'g' => $gid, 'i' => 1), $accept, $index);

			if(isset($this->admin[$index]) AND $this->admin[$index]['guests'] > 0) $this->admin[$index]['guests'] -= 1; //当前客服的客人数减1
			if(isset($this->admin[$aix])) $this->admin[$aix]['guests'] += 1; //接收的客服客人数加1
		}
		
		APP::$DB->exe("UPDATE " . TABLE_PREFIX . "guest SET aid = '$aid' WHERE gid = '$gid'"); //更新数据库
	}



	//清除已存在的相同aid的客服连接
	function clearAdmin($aid){
		foreach($this->admin AS $k => $a){
			if($a['aid'] == $aid) {

				//给原客服连接发送重复登录通知
				$this->send(array('x' => 2, 'a' => 7), $this->accept[$k], $k);

				socket_close($this->accept[$k]);

				unset($this->accept[$k]);
				unset($this->cycle[$k]);
				unset($this->type[$k]);

				$fullname = $this->admin[$k]['fullname'];
				unset($this->admin[$k]); //删除客服

				//给其他客服发送离线信息
				$this->ws_send_all(array('x' => 2, 'a' => 2, 'ix' => $k, 'i' => $fullname)); //更新列表

				break;
			}
		}
	}


	//清除已存在的相同gid的客人连接
	function clearGuest($gid){

		if(!$gid) return;

		foreach($this->guest AS $k => $g){
			if($g['gid'] == $gid) {
				$this->send(array('x' => 6, 'a' => 4), $this->accept[$k], $k); //客人重复连接

				socket_close($this->accept[$k]);

				unset($this->accept[$k]);
				unset($this->cycle[$k]);
				unset($this->type[$k]);

				$aix =$g['aix']; //此客人的客服连接索引

				if(isset($this->admin[$aix]) AND $this->admin[$aix]['guests'] > 0) $this->admin[$aix]['guests'] -= 1; //客服的客人数减1

				unset($this->guest[$k]); //删除客人

				break;
			}
		}
	}

	//按id获取客人的连接索引
	function guestIndex($gid){
		foreach($this->guest AS $index => $g){
			if($g['gid'] == $gid) return $index;
		}
		
		return false;
	}

	//验证客服
	function checkAdmin($accept, $index){
		if(array_key_exists($index, $this->admin)) return true;
		$this->close($accept, $index, 0); //无通知
		return false;
	}

	//验证客人
	function checkGuest($accept, $index){
		if(array_key_exists($index, $this->guest)) return true;
		$this->close($accept, $index, 0); //无通知
		return false;
	}

	//给已连接的客人分配客服
	function select_admin($aid) {
		$aix = false; //预定义客服的index
		$min = 100000;

		//先匹配曾经服务过的客服(老客人优生分配给老客服), 且老客服未挂起时
		if($aid){
			foreach($this->admin as $k => $a) {
				if($a['aid'] == $aid AND !$a['busy']) return $k;
			}
		}

		//未找到老客服, 继续分配
		$keys = array_keys($this->admin);
		shuffle($keys); //随机打乱数组顺序

		//找最少客人且未挂起的客服
		foreach($keys as $k) {
			if(!$this->admin[$k]['busy']){ //找未挂起的客服
				if($this->admin[$k]['guests'] < $min){
					$min = $this->admin[$k]['guests'];
					$aix = $k;
				}
			}
		}

		//如果未找客服(无客服或都挂起), 重新查找(不限挂起状态)
		if($aix === false){
			foreach($keys as $k) {
				if($this->admin[$k]['guests'] < $min){
					$min = $this->admin[$k]['guests'];
					$aix = $k;
				}
			}
		}

		return $aix; //找到客服返回客服的连接索引(可能为0), 未找到返回false
	}

	//给已登录的所有客服人员发信息
	function ws_send_all($arr, $index = false) {
		foreach($this->admin as $k => $a) {
			/*
			if($index === $k) {
				$this->send(array('x' => 1, 'u'=> 0, 'i' => $arr['i']), $this->accept[$k], $k); //给自己发的信息
			}else{
				$this->send($arr, $this->accept[$k], $k);
			}
			*/

			$this->send($arr, $this->accept[$k], $k);
		}
	}

	//搜索用户 返回值 key
	function search($accept) {
		$search = array_search($accept, $this->accept, true);
		if($search === null) $search = false;
		return $search;
	}
	
	//关闭连接  参数$valid = 1表示是合法的连接, 0为非法
	function close($accept, $index, $valid = 1) {
		socket_close($accept); //socket_close函数可以关闭socket资源或连接资源

		unset($this->accept[$index]); //删除当前用户连接
		unset($this->cycle[$index]); //在循环数组中删除当前用户连接
		unset($this->type[$index]); //删除连接的类型

		if(!$valid) return true; //非法或无效连接

		if(array_key_exists($index, $this->guest)){
			$aix = $this->guest[$index]['aix']; //此客人的客服连接索引

			if(isset($this->admin[$aix])){ //如果客服存在
				if($this->admin[$aix]['guests'] > 0) $this->admin[$aix]['guests'] -= 1; //客服的客人数减1

				$gid = $this->guest[$index]['gid'];

				$this->send(array('x' => 6, 'a' => 3, 'g' => $gid), $this->accept[$aix], $aix); //给客服发通知

				APP::$DB->exe("UPDATE " . TABLE_PREFIX . "guest SET session = '' WHERE gid = '$gid'"); //删除此客人的session
			}

			unset($this->guest[$index]); //删除客人

		}elseif(array_key_exists($index, $this->admin)){

			$aid = $this->admin[$index]['aid'];
			$fullname = $this->admin[$index]['fullname'];

			unset($this->admin[$index]); //删除客服

			//给所有属于自己的客人发指令, 通知并禁止发言
			foreach($this->guest AS $k => $g){
				if($g['aix'] == $index) $this->send(array('x' => 6, 'a' => 2), $this->accept[$k], $k);
			}

			//将此客服状态设置成离席
			APP::$DB->exe("UPDATE " . TABLE_PREFIX . "admin SET online = 0  WHERE aid = '$aid'");

			//如果没有客服了，将socket监听进程终止
			$admin_nums = count($this->admin);
			if(!$this->is_robot AND $admin_nums <= 0){
				APP::$DB->query("SET session wait_timeout=60"); //60秒后, 关闭mysql守护进程
				die(); //非无人值守时
			}

			//给仍在线的客服发客服离线信息
			$this->ws_send_all(array('x' => 2, 'a' => 2, 'ix' => $index, 'i' => $fullname)); //更新列表

		}

		return true;
	}

	
	//发送数据  dataArr参数: 数组
	function send($dataArr, $accept, $index) {
		if(!$accept) return false;

		$type = $this->type[$index];
		if(empty($this->class[$type])) return false;
		if(!$data = $this->class[$type]->encode($dataArr)) return false;

		//用户离线或不存在时, 关闭连接
		if(!$write = socket_write($accept, $data, strlen($data))){
			$this->close($accept, $index, 0);//不发信息
			return false;
		}

		return true;
	}
	
	//获得 连接ip 返回值 连接的ip
	function ip($accept){
		socket_getpeername($accept, $ip);
		return $ip;
	}

	//获取错误代码
	function error(){
		if(!$this->socket) return -1;
		return socket_last_error($this->socket);
	}
	
	//验证用户类型 header	返回值: false 或 连接类型
	function header($data, $accept, $index = 0) {
		$header = parse_header($data, true); //返回header数组

		// 最多 4096 信息
		if(strlen($data) >= 4096) return false;

		//超过最大在线人数时, 返回false, 将自动关闭此连接
		if(count($this->accept) > WEBSOCKET_ONLINE) return false;

		$msg = '';

		// 验证为flash
		if(trim(implode('', $header)) == '<policy-file-request/>') {
			$msg .= '<?xml version="1.0"?>';
			$msg .= '<cross-domain-policy>';
			$msg .= '<allow-access-from domain="'. ( $this->domain ? '*.' . $this->domain : '*' ) .'" to-ports="*"/>';
			$msg .= '</cross-domain-policy>';
			$msg .= "\0";
			socket_write($accept, $msg, strlen($msg));
			return false;
		}

		// 来路
		$origin = empty( $header['origin'] ) ? empty( $header['websocket-origin'] ) ? '' : $header['websocket-origin'] : $header['origin'];
		$parse = parse_url( $origin );
		$scheme = empty( $parse['scheme'] ) || $parse['scheme'] != 'https' ? '' : 's';
		$origin = $origin && !empty( $parse['host'] ) ? 'http' . $scheme . '://' . $parse['host'] : '';
		
		// 无效来路
		if ( $this->domain && !empty( $parse['host'] ) && !preg_match( '/(^|\.)'. preg_quote( $this->domain, '/' ) .'$/i', $parse['host'] ) ) {
			return false;
		}
		
		//  10+ 版本的
		if ( !empty( $header['sec-websocket-key'] ) ) {

			$a = base64_encode( sha1( trim( $header['sec-websocket-key'] ) . '258EAFA5-E914-47DA-95CA-C5AB0DC85B11', true ) );
			
			$msg .= "HTTP/1.1 101 Switching Protocols\r\n";
			$msg .= "Upgrade: websocket\r\n";
			$msg .= "Connection: Upgrade\r\n";
			if ( $origin ) {
				$msg .= "Sec-WebSocket-Origin: {$origin}\r\n";
			}
			$msg .= "Sec-WebSocket-Accept: $a\r\n";
			$msg .= "\r\n";
			
			if ( !socket_write( $accept, $msg, strlen( $msg ) ) ) {
				return false;
			}
			
			return 2;
		}
		
		// 10- 版本的
		if ( !empty( $header['sec-websocket-key1'] ) && !empty( $header['sec-websocket-key2'] ) && !empty( $header['html'] ) ) {			
			$key1 = $header['sec-websocket-key1'];
			$key2 = $header['sec-websocket-key2'];
			$key3 = $header['html'];
			if ( !preg_match_all('/([\d]+)/', $key1, $key1_num ) || !preg_match_all('/([\d]+)/', $key2, $key2_num ) ) {
				return false;
			}
			$key1_num = implode( $key1_num[0] );
			$key2_num = implode( $key2_num[0] );
			
			if ( !preg_match_all('/([ ]+)/', $key1, $key1_spc ) || !preg_match_all('/([ ]+)/', $key2, $key2_spc ) ) {
				return false;
			}
			
			$key1_spc = strlen( implode( $key1_spc[0] ) );
			$key2_spc = strlen( implode( $key2_spc[0] ) );
			
			$key1_sec = pack("N", $key1_num / $key1_spc );
			$key2_sec = pack("N", $key2_num / $key2_spc );
	
			$msg .= "HTTP/1.1 101 Web Socket Protocol Handshake\r\n";
			$msg .= "Upgrade: WebSocket\r\n";
			$msg .= "Connection: Upgrade\r\n";
			if ( $origin ) {
				$msg .= "Sec-WebSocket-Origin: {$origin}\r\n";
			}
			$msg .= "Sec-WebSocket-Location: ws{$scheme}://{$this->host}:{$this->port}{$this->path}\r\n";
			$msg .= "\r\n";
			$msg .= md5( $key1_sec.$key2_sec . $key3, true );
			if ( !socket_write( $accept, $msg, strlen( $msg ) ) ) {
				return false;
			}
			return 1;
		}
		
		return false;
	}
}




/**
*	websocket  第一个版本的
***/
class class_websocket_1{
	function decode( $data ) {
		$len = strlen( $data );
		if ( $len < 3 ) {
			return false;
		}
		$r = '';
		$k = -1;
		$str = '';
		
		for( $i = 0; $i < $len; $i++ ) {
			$ord = ord( $data[$i] );
			if ( $ord == 0 ) {
				$k++;
				$str = '';
				continue;
			}
			if ( $ord == 255 ) {
				$r = $str;
				continue;
			}
			
			$str .= $data[$i];
		}
		return $r;
	}
	
	function encode( $data ) {
		$data = is_array( $data ) || is_object( $data ) ? json_encode( $data ) : (string) $data;
		return chr(0) . $data . chr(255);
	}
}


/**
*	websocket  第二个版本的
**/
class class_websocket_2{
	/**
	*	解码
	**/
	function decode( $data ) {
		if ( strlen( $data ) < 6 ) {
			return '';
		}
		
		$r = '';
		$back = $data;
		while( $back ) {
			$type = bindec( substr( sprintf( '%08b', ord( $back[0] ) ) , 4, 4 ) );
			$encrypt = (bool) substr( sprintf( '%08b', ord( $back[1] ) ), 0, 1 );
			$payload = ord( $back[1] ) & 127;
			$datalen = strlen( $back );
			if( $payload == 126 ) {
				if ( $datalen <= 8 ) {
					break;
				}
				$len = substr( $back, 2, 2 );
				$len = unpack('n*', $len );
				$len = end( $len );
				
				if ( $datalen < 8 + $len ) {
					break;
				}
				$mask = substr( $back, 4, 4 );
				$data = substr( $back, 8, $len );
				$back = substr( $back, 8 + $len );
			} elseif( $payload == 127 ) {
				if ( $datalen <= 14 ) {
					break;
				}
				$len = substr( $back, 2, 8 );
				$len = unpack('N*', $len );
				$len = end( $len );
				if ( $datalen < 14 + $len ) {
					break;
				}
				$mask = substr( $back, 10, 4 );
				$data = substr( $back, 14, $len );
				$back = substr( $back, 14 + $len );
			} else {
				$len = $payload;
				if ( $datalen < 6 + $len ) {
					break;
				}
				$mask = substr( $back, 2, 4 );
				$data = substr( $back, 6, $len );
				$back = substr( $back, 6 + $len );
			}
			
			if ( $type != 1 ) {
				continue;
			}
			$str = '';
			if ( $encrypt ) {
				$len = strlen( $data );
				for ( $i = 0; $i < $len; $i++ ) {
					$str .= $data[$i] ^ $mask[$i % 4];
				}
			} else {
				$str = $data;
			}
			$r = $str;
		}
		return $r;
	}
	
	/**
	*	编码
	**/
	function encode( $data ) {
		$data = is_array( $data ) || is_object( $data ) ? json_encode( $data ) : (string) $data;
		$len = strlen( $data );
		$head[0] = 129;
		if ( $len <= 125 ) {
			$head[1] = $len;
		} elseif ( $len <= 65535 ) {
			$split = str_split( sprintf('%016b', $len ), 8 );
			$head[1] = 126;
			$head[2] = bindec( $split[0] );
			$head[3] = bindec( $split[1] );
		} else {
			$split = str_split( sprintf('%064b', $len ), 8 );
			$head[1] = 127;
			for ( $i = 0; $i < 8; $i++ ) {
				$head[$i+2] = bindec( $split[$i] );
			}
			if ( $head[2] > 127 ) {
				return false;
			}
		}
		foreach( $head as $k => $v ) {
			$head[$k] = chr( $v );
		}

		return implode('', $head ) . $data;
	}
}



/**
*	解析 header
*
*	1 参数 header
*	2 参数 strtolower是否转换成小写
*
*	返回值 数组
**/
function parse_header($html = '', $strtolower = false) {
	if (!$html) return array();

	$html = str_replace( "\r\n", "\n", $html );
	$html = explode( "\n\n", $html, 2 );
	$header = explode( "\n", $html[0] );
	$r = array();
	foreach ( $header as $k => $v ) {
		if ( $v ) {
			$v = explode( ':', $v, 2 );
			if( isset( $v[1] ) ) {
				if ( $strtolower ) {
					$v[0] = strtolower( $v[0] );
				}
				
				if ( substr( $v[1], 0 , 1 ) == ' ' ) {
					$v[1] = substr( $v[1], 1 );
				}
				$r[trim($v[0])] = $v[1];
			} elseif ( empty( $r['status'] ) && preg_match( '/^(HTTP|GET|POST)/', $v[0] ) ) {
				$r['status'] = $v[0];
			} else {
				$r[] = $v[0];
			}
		}
	}

	if (!empty($html[1])) $r['html'] = $html[1];

	return $r;
}


/**
*	字符串转换成数组
* 
*	1 参数 输入GET类型字符串
*
*	返回值 GET数组
**/
function string_to_array($s) {
	//if(is_array($s)) return $s;
	if(get_magic_quotes_gpc()) $s = stripslashes($s);

	$s = str_replace('+', '||6||', $s); //先将+号转换成特殊字符串||6||
	parse_str($s, $r); //此函数会将+转换成空格

	foreach($r AS $k => $v) {
		$r[$k] = htmlspecialchars($v, ENT_QUOTES); //处理特殊代码
	}

	return $r;
}

//将特殊字符恢复(不写入数据库时使用)
function decodeChar($s) {
	$s = str_replace(array('||4||', '||6||'), array('&', '+'), $s);
	return $s;
}

//需要写入数据库时, 为socket数据特别过滤, 避免重复处理
function ForceData($str) {
	$str = str_replace(array('\0', '　', '||4||', '||6||'), array('', '', '&amp;', '+'), $str);

	if(APP::$DB->type == "mysqli"){
		if(function_exists('mysqli_real_escape_string')) {
			$str = mysqli_real_escape_string(APP::$DB->conn, $str);
		}else{
			$str = addslashes($str);
		}
	}else{
		if(function_exists('mysql_real_escape_string')) {
			$str = mysql_real_escape_string($str);
		}else if(function_exists('mysql_escape_string')){
			$str = mysql_escape_string($str);
		}else{
			$str = addslashes($str);
		}
	}

	return $str;
}

?>