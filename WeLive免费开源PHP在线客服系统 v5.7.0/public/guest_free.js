
//根据select设置对象显示title
function show_title(select, position){
	if(!position || position != "left") position = "right";

	$(select).mouseover(function (e) {
		if(!this.title) return;
		this.Mytitle = this.title;
		this.title = "";
		$("body").append("<div id='welive_div_toop' style='border: 1px solid #000;background:#ffff00;padding:2px 3px;'>" + this.Mytitle + "</div>");

		if(position == "right"){
			$("#welive_div_toop").css({"top": (e.pageY - 25) + "px","position": "absolute","left": (e.pageX + 10) + "px"}).show("fast");
		}else{
			$("#welive_div_toop").css({"top": (e.pageY - 25) + "px","position": "absolute","right": (350 - e.pageX) + "px"}).show("fast");
		}

	}).mouseout(function () {

		if(!this.Mytitle) return;
		this.title = this.Mytitle;
		$("#welive_div_toop").remove();

	}).mousemove(function (e) {
		if(position == "right"){
			$("#welive_div_toop").css({"top": (e.pageY - 25) + "px","position": "absolute","left": (e.pageX + 10) + "px"}).show("fast");
		}else{
			$("#welive_div_toop").css({"top": (e.pageY - 25) + "px","position": "absolute","right": (350 - e.pageX) + "px"}).show("fast");
		}
	});
}


//JQ闪动特效  ele: JQ要闪动的对象; cls: 闪动的类(className); times: 闪动次数
function shake(ele, cls, times){
	var i = 0, t = false, o = ele.attr("class")+" ", c = "", times = times||3;
	if(t) return;
	t= setInterval(function(){
		i++;
		c = i%2 ? o+cls : o;
		ele.attr("class",c);
		if(i==2*times){
			clearInterval(t);
			ele.removeClass(cls);
		}
	},200);
}

//表单验证
function validate_input(value, name){
	value = $.trim(value); //去掉空格, 并检查
	if(!value) return false;

	switch(name){
		case "fullname": var pattern = /^[\w\.\-\u0391-\uFFE5]{2,30}$/; break;
		case "email": var pattern = /^\w+([-+.]\w+)*@\w+([-.]\w+)+$/i; break;
		case "vvc": var pattern = /^[\d+]{1,4}$/; break;
		case "content":
			var len = value.length;
			if(len < 6 || len > 600) return false;
			break;
	}

	if(name && pattern){
		return pattern.test(value);
	}else{
		return true;  //没有正则比较时, 返回成功
	}
}

//Ajax封装
var ajax_isOk = 1;
function ajax(url, send_data, callback) {
	if(!ajax_isOk) return false;
	$.ajax({
		url: url,
		data: send_data,
		type: "post",
		cache: false,
		dataType: "json",
		beforeSend: function(){ajax_isOk = 0;},
		complete: function(){ajax_isOk = 1;},
		success: function(data){
			if(callback)	callback(data);
		},
		error: function(XHR, Status, Error) {
			show_alert("ajax error!");
			//show_alert("Data: " + XHR.responseText + "\r\nStatus: " + Status + "\r\nError: " + Error, 200000);
		}
	});
}

//设置cookie
function setCookie(n,val,d) {
	var e = "";
	if(d) {
		var dt = new Date();
		dt.setTime(dt.getTime() + parseInt(d)*24*60*60*1000);
		e = "; expires="+dt.toGMTString();
	}
	document.cookie = n+"="+val+e+"; path=/";
}

//获取cookie
function getCookie(n) {
	var a = document.cookie.match(new RegExp("(^| )" + n + "=([^;]*)(;|$)"));
	if (a != null) return a[2];
	return '';
}

//将json数据转换成json对象
function parseJSON(data) {
	if(window.JSON && window.JSON.parse) return window.JSON.parse(data);
	if(data === null) return data;
	if(typeof data === "string") {
		data = $.trim(data);
		if(data) {
			var rvalidchars = /^[\],:{}\s]*$/,
				rvalidbraces = /(?:^|:|,)(?:\s*\[)+/g,
				rvalidescape = /\\(?:["\\\/bfnrt]|u[\da-fA-F]{4})/g,
				rvalidtokens = /"[^"\\\r\n]*"|true|false|null|-?(?:\d+\.|)\d+(?:[eE][+-]?\d+|)/g;

			if(rvalidchars.test(data.replace(rvalidescape, "@").replace(rvalidtokens, "]").replace(rvalidbraces, ""))) {
				return (new Function("return " + data))();
			}
		}
	}
	return false;
}

//新消息闪动页面标题
function flashTitle() {
	clearInterval(ttt_3);
	flashtitle_step=1;
	ttt_3 = setInterval(function(){
		if (flashtitle_step==1) {
			welive_cprt.addClass("hover");
			flashtitle_step=2;
		}else{
			welive_cprt.removeClass("hover");
			flashtitle_step=1;
		}
	}, 200);
}

//停止闪动页面标题
function stopFlashTitle() {
	if(flashtitle_step != 0){
		flashtitle_step=0;
		clearInterval(ttt_3);
		welive_cprt.removeClass("hover");
	}
}

//获得计算机当前时间
function getLocalTime() {
	var date = new Date();

	function addZeros(value, len) {
		var i;
		value = "" + value;
		if (value.length < len) {
			for (i=0; i<(len-value.length); i++)
				value = "0" + value;
		}
		return value;
	}
	return addZeros(date.getHours(), 2) + ':' + addZeros(date.getMinutes(), 2) + ':' + addZeros(date.getSeconds(), 2);
}

//显示警告信息
function show_alert(info, time) {
	var alert_div = $("#alert_info");
	alert_div.html(info).show();

	setTimeout(function() {
		alert_div.hide();
	}, time ? time : 4000);
}

//websocket
var WebSocket = window.WebSocket || window.MozWebSocket;
if(!WebSocket) {
	var ws_obj = {};
	var ws_ready = false;
	$(window).load(function(){ws_ready = true;});
	$(function(){
		$.ajax({
			url: SYSDIR + 'public/jquery.swfobject.js',
			dataType: 'script',
			async: false,
			cache: true
		});
		
		window.WebSocket = function( a ) {
			a = a.match( /wss{0,1}\:\/\/([0-9a-z_.-]+)(?:\:(\d+)){0,1}/i );
			this.host = a[1];
			this.port = a[2] || 843;
			this.onopen = function(){};
			this.onclose = function(){};
			this.onmessage = function(){};
			this.onerror = function(){};
			this.ready = function(b){return true;};
			this.send = function(b){return ws_obj.call.Send(b);};
			this.close = function(){return ws_obj.call.Close();};
			this.ping = function(){return ws_obj.call.Ping();};
			this.connect = function(){
				ws_obj.call = $('#flash_websocket')[0];
				ws_obj.call.Connect(this.host,this.port );
			};
			this.onmessage_escape = function( d ){
				this.onmessage( {data:unescape( d )} );
			};
			if($('#websocket1212').size()) {
				this.connect();
			}else{
				var div = $('<div id="websocket1212"></div>').css({position:'absolute', top:-999, left:-999});
				div.flash({
					swf: SYSDIR + 'public/websocket.swf?r=' + Math.random(),
					wmode: "window",
					scale: "showall",
					allowFullscreen : true,
					allowScriptAccess : 'always',
					id: 'flash_websocket',
					width : 1,
					height : 1,
					flashvars : {call: 'ws_obj._this'}
				});
				$('body').append(div);
			}
			ws_obj._this = this;
		}
	});
}

//格式化输出信息
function format_output(data) {
	//生成URL链接
	data = data.replace(/((((https?|ftp):\/\/)|www\.)([\w\-]+\.)+[\w\.\/=\?%\-&~\':+!#;]*)/ig, function($1){return getURL($1);});
	//将表情代码换成图标路径
	data = data.replace(/\[:(\d*):\]/g, '<img src="' + SYSDIR + 'public/smilies/$1.png">').replace(/\\/g, '');
	return data;
}

//格式化生成URL
function getURL(url, limit) {
	if(!limit) limit = 60;
	var urllink = '<a href="' + (url.substr(0, 4).toLowerCase() == 'www.' ? 'http://' + url : url) + '" target="_blank" title="' + url + '">';
	if(url.length > limit) {
		url = url.substr(0, 30) + ' ... ' + url.substr(url.length - 18);
	}
	urllink += url + '</a>';
	return urllink;
}

//插入表情符号
function insertSmilie(code) {
	code = '[:' + code + ':]';
	var obj = msger[0];

	var selection = document.selection;
	obj.focus();

	if(typeof obj.selectionStart != 'undefined') {
		var opn = obj.selectionStart + 0;
		obj.value = obj.value.substr(0, obj.selectionStart) + code + obj.value.substr(obj.selectionEnd);
	} else if(selection && selection.createRange) {
		var sel = selection.createRange();
		sel.text = code;
		sel.moveStart('character', -code.length);
	} else {
		obj.value += code;
	}
}


//socket连接
function welive_link(){
	welive.ws = new WebSocket(WS_HEAD + WS_HOST + ':'+ WS_PORT);
	welive.ws.onopen = function(){setTimeout(function(){welive_verify();}, 100);}; //连接成功后, 小延时再验证用户, 否则IE下刷新时发送数据失败
	welive.ws.onclose = function(){welive_close();};
	welive.ws.onmessage = function(get){welive_parseOut(get);};
}


//记住访客id
function remember_guest(gid){

	if(!guest.gid || guest.gid != gid){

		guest.gid = gid; //新客人更新ID号, 重新连接时用

		setCookie(COOKIE_USER, gid, 365); //写cookie, 记住ID号

		var new_gid = getCookie(COOKIE_USER); 
		
		//写入后立即读出, 如果没有值, 说明浏览器禁止了第三方cookie, 使用hash方式实现跨域
		if(!new_gid){
			/*
			var ifrproxy = document.createElement('iframe');
			ifrproxy.style.display = 'none';
			ifrproxy.src = guest.fromurl + "#" + gid;
			document.body.appendChild(ifrproxy);
			*/

			$(document.body).append('<iframe id="welive_null" src="' + guest.fromurl + "#" + gid + '" style="width:1px;height:1px;overflow:hidden;display:none;"></iframe>');

			//18秒后删除
			setTimeout(function(){	$("#welive_null").remove();}, 18000);
		}
	}
}


//将客人发出的未读消息标记为已读
function remove_unread(){
	historier.find("s.un").html(langs.readed).removeClass("un");
}

//解析数据并输出
function welive_parseOut(get){
	var d = false, type = 0, data = parseJSON(get.data);
	if(!data) return; //没有数据返回

	switch(data.x){
		case 5: //客人与客服对话
			if(data.a == 1){
				welive.flashTitle = 1;

				type = 1; d = data.i; //客服发来的
			}else{
				type = 2; d = welive.msg.replace(/</g, "&lt;").replace(/>/g, "&gt;"); //自己发出的对话
				welive.status = 1; //发送完成允许发送第二条信息
				sender.removeClass('loading2');
			}

			break;

		case 8: //人工客服发来的标记已读信息

			remove_unread();
			return true;

			break;

		case 6: //客服特别操作及反馈信息
			switch(data.a){

				case 8: //客人登录成功
					welive.linked = 1; //连接成功
					welive.status = 1; //允许发信息
					welive.autolink = 1; //允许自动重连
					welive_relink_times = 8; //重连次数

					guest.fn = data.fn; //客人姓名
					guest.aid = data.aid; //更新客服的id, 重新连接时用
					guest.an = data.an; //客服姓名
					guest.au = parseInt(data.au); //上传授权, 强制转成数字1或0, 方便判断, JS里if("0") 是true, php里为false

					 //更新头像及身份
					welive_name = data.an;
					welive_duty = data.p;
					welive_op.find("#welive_avatar").attr("src", SYSDIR + "avatar/" + data.av);
					welive_op.find("#welive_name").html(welive_name);
					welive_op.find("#welive_duty").html(welive_duty);
					historyViewport.removeClass('loading3');

					//如果有聊天记录时, 先输出记录
					var recs = '';
					$.each(data.re, function(i, rec){
						if(rec.t == 1){ //客服的
							if(rec.fid == guest.aid){
								var welive_duty_i = welive_duty;
							}else{
								var welive_duty_i = langs.welive;
							}
							recs += '<div class="msg l"><div class="a">' +  rec.f + ' - ' + welive_duty_i + '<i>' + rec.d + '</i></div><b></b><div class="b"><div class="i">' + format_output(rec.m) + '</div></div></div>';
						}else{ //自己的

							recs += '<div class="msg r"><b class="welive_p_' + COLOR_STYLE + '"></b><div class="b welive_cb_' + COLOR_STYLE + '"><div class="i">' + format_output(rec.m) + '</div></div><i>' + rec.d + '</i></div>';
						}
					});

					historier.append('<div class="msg s"><div class="b"><div class="i">' + langs.connected + '</div></div></div>'); //连接成功

					if(recs != '') {
						recs += '<div class="msg s"><div class="b"><div class="i">' + langs.records + '</div></div></div>';
						historier.append(recs); //输出
					}

					remember_guest(data.gid); //记住访客id

					msger.focus();
					welive.flashTitle = 1;
					type = 8; d = welcome;

					autoOffline(); //启动自动离线

					welive.temp = '';
					welive_runtime();

					//启动心跳, 即每隔25秒自动发送一个特殊信息, 解决IE下30秒自动断线的问题
					ttt_1 = setInterval(function() {

						//只要连接状态, 均要发送心跳数据, 设置一个怪异的数字避免与自动离线的时间间隔重合, 避免在同一时间点上send数据上可能产生 -----幽灵bug
						if(welive.linked) welive.ws.send('x=9&i=1');

					}, 25357);

					break;

				case 1: //客服重新上线

					clearTimeout(welive.ttt_3); //清除客服离线时自动转接
					
					welive.status = 1;
					welive.flashTitle = 1;
					type = 3; d = guest.an + langs.aback;

					break;

				case 2: //客服离线
					welive.flashTitle = 1;
					welive.status = 0;
					type = 4; d = guest.an + langs.offline;

					//1分钟后发送请求重新分配客服的请求
					welive.ttt_3 = setTimeout(function(){
						if(welive.linked) welive.ws.send('x=6&a=12&g=' + guest.gid);

					}, 59973);

					break;

				case 4: //重复连接返回的指令
					welive.status = 0;
					welive.autolink = 0; //不允许自动重连
					type = 4; d = langs.relinked + '<br><a onclick="welive_link();$(this).parents(\'.msg\').hide();return false;" class="relink welive_color_' + COLOR_STYLE + '">' + langs.rebtn + '</a>';

					stopFlashTitle();
					$("#websocket1212").remove(); //如果不清除, IE下有冲突
					break;

				case 5: //客人自动离线返回的通知
					welive.status = 0;
					welive.autolink = 0; //不允许自动重连

					welive.flashTitle = 1;
					type = 4; d = langs.autooff + '<br><a onclick="welive_link();$(this).parents(\'.msg\').hide();return false;" class="relink welive_color_' + COLOR_STYLE + '">' + langs.rebtn + '</a>';
					$("#websocket1212").remove(); //如果不清除, IE下有冲突

					break;

				case 6: //被踢出
					welive.autolink = 0; //不允许自动重连

					welive.flashTitle = 1;
					type = 4; d = langs.kickout;

					break;

				case 7: //被禁言
					welive.status = 0;
					welive.autolink = 0; //不允许自动重连

					welive.flashTitle = 1;
					type = 4; d = langs.banned;

					break;

				case 9: //无客服在线时
					welive.status = 0;
					welive.autolink = 0; //不允许自动重连
					welive.linked = 0; //伪装成未连接, 在关闭连接时切换到留言板

					break;

				case 10: //解除禁言
					welive.status = 1;
					welive.autolink = 1; //允许自动重连

					welive.flashTitle = 1;
					type = 3; d = langs.unbann;

					break;

				case 11: //被转接
					welive.status = 1;
					welive.autolink = 1; //允许自动重连

					guest.aid = data.aid; //更新客服的id, 重新连接时用
					guest.an = data.an; //客服姓名
					guest.au = parseInt(data.au); //上传权限

					 //更新头像及身份
					welive_name = data.an;
					welive_duty = data.p;

					welive_op.find("#welive_avatar").attr("src", SYSDIR + "avatar/" + data.av);
					welive_op.find("#welive_name").html(welive_name);
					welive_op.find("#welive_duty").html(welive_duty);

					msger.focus();
					welive.flashTitle = 1;
					type = 3; d = langs.transfer + data.an;

					break;

				case 13: //请求回拨电话 返回

					welive.status = 1;
					$("#phone_num").val("");
					msger.focus();

					type = 2; d = '<div class="spec_info">' + welive.msg + '</div>';

					break;

				case 14: //评价返回

					msger.focus();

					if(data.s == "1"){
						welive.flashTitle = 1;
						type = 1; d = '<font color=red>' + langs.rating_thanks + '</font>[:16:]';
					}else{
						show_alert(langs.rating_limit, 6000);
						return false;
					}

					break;

			}

			break;

		case 7: //上传图片等

			break;
	}

	welive_output(d, type); //输出
}

//客服交流输出信息
function welive_output(d, type){
	if(d === false || !type) return; //没有信息及类型返回

	if(welive.flashTitle){
		flashTitle();
		if(welive.sound) sounder.html(welive.sound1);
		welive.flashTitle = 0;
	}

	//如果不用try, iframe跨域时运行出错
    try{
		//如果未展开, 有新信息时自动展开
		if(!window.parent.welive_opened && welive.linked){
			window.parent.welive_opened = 1;
			window.parent.welive_wrap.style.display = "block";
			window.parent.welive_online.style.display = "none";

			window.parent.welive_drag(window.parent.welive_wrap);

			msger.focus(); //输入框焦点
		}
     }catch(e){}


	switch(type){
		case 1: //客服
			d = '<div class="msg l"><div class="a">' + welive_name + ' - ' + welive_duty + '<i>' + getLocalTime() + '</i></div><b></b><div class="b"><div class="i">' + format_output(d) + '</div></div></div>';
			break;
		case 2: //客人
			d = '<div class="msg r"><b class="welive_p_' + COLOR_STYLE + '"></b><div class="b welive_cb_' + COLOR_STYLE + '"><div class="i">' + format_output(d) + '</div></div><i>' + getLocalTime() + '<br><s class="un">' + langs.unread + '</s></i></div>';
			break;
		case 3: //正常提示
			d = '<div class="msg s"><div class="b"><div class="i">' + d + '</div></div></div>';
			break;
		case 4: //错误提示
			d = '<div class="msg e"><div class="b"><div class="i">' + d + '</div></div></div>';
			break;
		case 8: //问候语, 不解析URL
			d = '<div class="msg l"><div class="a">' + welive_name + ' - ' + welive_duty + '<i>' + getLocalTime() + '</i></div><b></b><div class="b"><div class="i">' + d + '</div></div></div>';
			break;
	}

	historier.append(d);

	//解决跨站调用客服, welive面板最小化后接收信息再展开时, 最新消息无法显示的问题
	if(historyViewport.height() <=0){
		historier.css({"top":"auto", "bottom": 0});
	}else{
		history_wrap.welivebar_update('bottom'); //滚动到底部
	}
}

//客服连接验证
function welive_verify(){
	welive.ws.send('x=6&a=8&gid=' + guest.gid + '&fn=' + guest.fn + '&au=' + guest.au + '&aid=' + guest.aid + '&l=' + guest.lang + '&k=' + SYSKEY + '&c=' + SYSCODE + '&fr=' +  guest.fromurl.replace(/&/g, "||4||") + '&ag=' + guest.agent + '&ip=' + guest.ip + '&mb=0');
}

//连接断开时执行
function welive_close(){
	welive.status = 0; //不允许发信息

	clearInterval(ttt_1); //连接断开后停止发送心跳数据
	clearInterval(welive.ttt_2); //更新输入状态
	clearTimeout(welive.ttt_3); //清除客服离线时自动转接

	if(welive.autolink){ //允许重连
		$("#websocket1212").remove(); //如果不清除, IE下有冲突

		if(welive_relink_times > 0){
			welive_relink_times -= 1;
			welive_output(langs.failed, 4);
			setTimeout(function(){welive_link();}, 6000); //6秒后自动重连
		}else{
			welive_comment();
		}

	}else if(!welive.linked){ //之前没有连接, 表示首次连接失败时, 或者已连接但没有客服在线, 切换到留言页面, 不再重试连接
		welive_comment();
	}

	welive.linked = 0; //标记连接失败
}

//发送信息
function welive_send(){
	if(welive.status && welive.linked) {
		var msg = $.trim(msger.val());

		if(msg){
			if(msg.length > 2048){
				show_alert(langs.msg_too_long, 2000);
				return false;
			}

			welive.temp = ''; //终止实时输入提交数据
			sender.addClass('loading2');
			welive.msg = msg; //先记录客人的发言
			msg = msg.replace(/&/g, "||4||"); //将&转换成特殊标记, 否则与传送的其它数据冲突
			welive.ws.send('x=5&i=' + msg);
			msger.val('');
			welive.status = 0; //发送后，改变状态避免未完成时发送第二条信息

			autoOffline(); //信息发送完成后, 自动离线计时开始
		}
	}

	msger.focus();
}

//自动离线
function autoOffline(){
	if(! welive.linked) return; //如果未连接, 无需要自动离线

	if(welive.ttt_1) clearTimeout(welive.ttt_1);//清除自动离线

	welive.ttt_1 = setTimeout(function(){
		if(welive.linked) welive.ws.send("x=6&a=5"); //发送一条自动离线指令
	}, offline_time);
}

//启动输入状态更新
function welive_runtime(){
	welive.ttt_2 = setInterval(function(){

		if(welive.status && welive.linked) {

			var msg = $.trim(msger.val());
			msg = msg.replace(/&/g, "||4||"); //将&转换成特殊标记, 否则与传送的其它数据冲突

			if(msg && msg != welive.temp){
				welive.ws.send('x=4&a=1&i=' + msg);
				welive.temp = msg; //记录正在输入的信息
			}else if(!msg && welive.temp){ //清空输入框后, 给客服发通知, 去掉输入状态
				welive.ws.send('x=4&a=2');
				welive.temp = '';
			}
		}

	}, update_time);
}

//进入留言板
function welive_comment(){
	shakeobj = function(obj){shake(obj, "shake");obj.focus();return false;};

	historyViewport.removeClass('loading3');
	drag_to_bottom = drag_to_bottom - 75;

	historier.remove();

	$(".enter").html('').addClass('comment_enter').html('<div id="alert_info"></div><a class="sender comment_send welive_color_' + COLOR_STYLE + '" onclick="submit_comment();return false;">' + langs.submit + '</a>');

	welive_op.find("#welive_avatar").attr("src", SYSDIR + "public/img/welive.png");
	welive_op.find("#welive_name").html(langs.leavemsg);
	welive_op.find("#welive_duty").html(langs.nosuppert);

	var vid = 0;
	$.ajaxSetup({async: false}); //设置ajax为同步!!!
	ajax(SYSDIR + 'welive_ajax.php?ajax=1&act=vvc', {key:SYSKEY, code:SYSCODE}, function(data){
		vid = parseInt(data.s);
	});
	$.ajaxSetup({async: true});

	historyViewport.append('<div class="overview" style="padding-bottom:0;height:100%;"><div class="comment"><div class="comment_note">' + comment_note + '</div><form id="comment_form" onsubmit="return false;"><input type="hidden" name="act" value="comment"><input type="hidden" name="vid" value="' + vid + '"><input type="hidden" name="key" value="' + SYSKEY + '"><input type="hidden" name="code" value="' + SYSCODE + '"><li><s>' + langs.yourname + ':</s><input name="fullname" type="text"><i>*</i></li><li><s>' + langs.email + ':</s><input name="email" type="text"></li><li><s>' + langs.phone + ':</s><input name="phone" type="text"></li><li><s>' + langs.content + ':</s><textarea name="content"></textarea><i>*</i></li><li><s></s><img src="' + SYSDIR + 'welive_ajax.php?ajax=1&act=get&vid='+ vid +'" onclick="ChangeCaptcha(this);" title="' + langs.newcaptcha + '"> = <input name="vvc" type="text" class="vvc"><i>*</i></li></form></div></div>');

	historier = historyViewport.find(".overview");
	history_wrap.height($(window).height() - drag_to_bottom);
	history_wrap.welivebar_update('bottom'); //滚动到底部

	$("#alert_info").css("bottom", "41px");
}

//更新验证码
function ChangeCaptcha(i){i.src= i.src + '&' + Math.random();}

//提交留言
function submit_comment(){
	$("#alert_info").hide(); //隐藏alert

	//使用cookie限制每天留言次数
	var welive_comms = getCookie(COOKIE_USER + "_comms");
	welive_comms = parseInt(welive_comms);

	if(!welive_comms || welive_comms < 1) welive_comms = 1;
	if(welive_comms > 5){
		show_alert(langs.comm_alert);
		return false;
	}

	var form = $("#comment_form");
	var fullname = form.find("input[name=fullname]");
	var email = form.find("input[name=email]");
	var content = form.find("textarea[name=content]");
	var vvc = form.find("input[name=vvc]");

	if(!validate_input(fullname.val(), 'fullname')) return shakeobj(fullname);
	if(!validate_input(content.val(), 'content')) return shakeobj(content);
	if(!validate_input(vvc.val(), 'vvc')) return shakeobj(vvc);

	ajax(SYSDIR + 'welive_ajax.php?ajax=1&gid=' + guest.gid, form.serialize(), function(data){
		if(data.s == 0){
			show_alert(langs.badcookie); //验证码过期

		}else if(data.s == 1){ //留言保存成功
			$(".enter").html('');
			historier.html('<div class="comsaved">' + langs.saved + '</div>');

			setTimeout(function(){

				setCookie(COOKIE_USER + "_comms", (welive_comms + 1), 1); //写cookie, 记住第几次留言

				//如果不用try, iframe跨域时运行出错
				try{
					window.parent.welive_close_btn.click(); //3秒后自动关闭
				}catch(e){}

			}, 3000);

		}else if(data.s == 2){
			shakeobj(fullname);
		}else if(data.s == 3){
			shakeobj(email);
		}else if(data.s == 4){
			shakeobj(content);
		}else if(data.s == 5){
			shakeobj(vvc);
		}
	});

}


//向客服发送回拨电话
function send_callback_phone(){
	if(!welive.status || !welive.linked) return false; 

	$("#welive_div_toop").remove(); //隐藏title
	$("#alert_info").hide(); //隐藏alert

	var reg = /^[\s_#\-\+\(\)\*\d]{5,20}$/;
	var phone = $.trim($("#phone_num").val());
	
	if(!phone){
		show_alert(langs.phone_err_1, 2000);
		return false; 
	}

	if(!(reg.test(phone))){ 
		show_alert(langs.phone_err_2, 2000); 
		return false; 
	}

	welive.msg = langs.require_callback + ': ' + phone; //先记录

	//发送立即回电特殊请求
	welive.status = 0; //不允许发送其它信息
	welive.ws.send("x=6&a=13&i=" + welive.msg);
}


//发送服务评价
function send_evaluate(){
	if(rating_star == 0){
		$("#starRating").hide();
		show_alert(langs.select_star, 1000);
		return false;
	}

	if(welive.status && welive.linked){
		$("#starRating").hide();

		var msg = $.trim($("#rating_advise").val());

		if(msg.length > 600){
			show_alert(langs.too_long, 1000);
			return false;
		}

		welive.ws.send("x=6&a=14&s=" + rating_star + "&i=" + msg);
	}
}


//welive初始化
function welive_init(){
	sender = $("#sender_msg");
	msger = $(".msger");
	historier = history_wrap.find(".overview");
	sounder = $("#wl_sounder");
	sound_btn = $("#toolbar_sound");

	welive_link(); //socket连接
	history_wrap.welivebar(); //滚动条

	msger.keydown(function(e){
		if(e.keyCode ==13){
			welive_send();
			e.preventDefault();
		}
	});

	$(window).resize(function(){//窗口大小改变时
		history_wrap.height($(window).height() - drag_to_bottom);
		history_wrap.welivebar_update('bottom'); //滚动到底部
		msger.focus(); //输入框焦点
	});

	//发送信息
	sender.click(function(e) {
		welive_send();
		e.preventDefault();
	});

	//工具栏按钮title
	show_title("div.tool_bar_i");

	//评价按钮动作
	$("#toolbar_evaluate").click(function(){
		rating_star = 0;
		$("#starRating .star span").find('.high').css('z-index',0);
		$(".starInfo").html(langs.select_star);
		$("#starRating").toggle();
	});

	//星星打分
	$("#starRating .star span").mouseover(function () {
		rating_star = parseInt($(this).attr("star_val"));

		$(this).prevAll().find('.high').css('z-index',1);
		$(this).find('.high').css('z-index',1);
		$(this).nextAll().find('.high').css('z-index',0);

		$('.starInfo').html(star_info[rating_star -1]);
	});

	//电话按钮title
	show_title("#phone_call_back", "left");

	//电话按钮动作
	$("#phone_call_back").click(function(){
		send_callback_phone();
	});

	//电话输入框回车发送
	$("#phone_num").keyup(function(e){
		if(e.keyCode ==13) send_callback_phone();
	});

	//表情符号
	$("#toolbar_emotion").click(function(){
		$("#starRating").hide();
		clearTimeout(ttt_3);
		smilies_div.toggle();
	}).mouseout(function(){
		ttt_3 = setTimeout(function() {
			smilies_div.hide();
		}, 800);
	});

	smilies_div.mousemove(function(){
		clearTimeout(ttt_3);
	}).mouseout(function(){
		ttt_3 = setTimeout(function() {
			smilies_div.hide();
		}, 800);
	});

	//获取当前的声音状态
	var wl_soundoff = parseInt(getCookie('wl_soundoff'));
	if(wl_soundoff == 1){
		welive.sound = 0;
		sound_btn.addClass('sound_off');
	}

	//开关声音
	sound_btn.click(function(){
		if(welive.sound){
			welive.sound = 0;
			sound_btn.addClass('sound_off');

			setCookie('wl_soundoff', 1, 2); //关闭声音cookie保持2天
		
		}else{
			welive.sound = 1;
			sound_btn.removeClass('sound_off');
			sounder.html(welive.sound1);
			setCookie('wl_soundoff', 0, 0);
		}
		msger.focus(); //输入框焦点
	});

	//上传图片按钮
	$("#toolbar_photo").click(function(){
		$("#starRating").hide();
		$("#welive_div_toop").hide(); //隐藏title
		$("#alert_info").hide(); //隐藏alert

		show_alert(langs.no_upload_auth);

		return false;
	});

	//上传文件按钮
	$("#toolbar_file").click(function(){
		$("#starRating").hide();
		$("#welive_div_toop").hide(); //隐藏title
		$("#alert_info").hide(); //隐藏alert

		show_alert(langs.no_upload_auth);

		return false;
	});

	$(document).mousedown(stopFlashTitle).keydown(stopFlashTitle);

	welive.sound1 = '<audio src="' + SYSDIR + 'public/sound1.mp3" autoplay="autoplay"></audio>';

	window.onbeforeunload=function(event){clearTimeout(welive.ttt_1);clearInterval(welive.ttt_2);clearTimeout(welive.ttt_3);clearInterval(ttt_1);clearInterval(ttt_2);clearInterval(ttt_3);};
	$(window).unload(function(){clearTimeout(welive.ttt_1);clearInterval(welive.ttt_2);clearTimeout(welive.ttt_3);clearInterval(ttt_1);clearInterval(ttt_2);clearInterval(ttt_3);});
}

//定义全局变量
var ttt_1 = 0, ttt_2 = 0, ttt_3 = 0, ttt_4 = 0, rating_star = 0, pagetitle, flashtitle_step = 0, sounder, sound_btn, sending_mask, sending_mask_h;
var welive_op, welive_cprt, history_wrap, historyViewport, historier, sender, msger, smilies_div, shakeobj;

var welive_name; //客服姓名
var welive_duty; //客服职位
var drag_to_bottom = 160; //窗口拖动时离底部距离

var welive_relink_times = 8; //重连次数超过后转到留言页面

//linked        1已连接,   0未连接
//status        1登录成功允许发信息,   0不允许发信息
//autolink     1允许重新连接,   0不允许重新连接
var welive = {ws:{}, linked: 0, status: 0, autolink: 0, ttt_1: 0, ttt_2: 0, ttt_3: 0, flashTitle: 0, ic: '', sound: 1, sound1: '', msg: '', temp: '', is_robot: 0};

var star_info = ['<img src="' + SYSDIR + 'public/img/star_icon1.png">' + langs.star_1, '<img src="' + SYSDIR + 'public/img/star_icon2.png">' + langs.star_2, '<img src="' + SYSDIR + 'public/img/star_icon3.png">' + langs.star_3, '<img src="' + SYSDIR + 'public/img/star_icon4.png">' + langs.star_4, '<img src="' + SYSDIR + 'public/img/star_icon5.png">' + langs.star_5];

$(function(){
	welive_op = $("#welive_operator");
	welive_cprt = $("#welive_copyright");
	history_wrap = $(".history");
	historyViewport = history_wrap.find(".viewport");
	smilies_div = $(".smilies_div");

	//获取客人的gid
	var gid = parseInt(getCookie(COOKIE_USER));
	if(gid) guest.gid = gid;

	WS_HOST = document.domain; //先记录下来供websocket连接使用
	try{document.domain = welive_domain;}catch(e){} //设置主域名, 解决主域名相同时的跨域问题

	welive_init();
});