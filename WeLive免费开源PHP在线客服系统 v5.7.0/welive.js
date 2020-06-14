//以下4个变量请勿手动修改, 否则可能与welive配置文件不一致, 建议在 "后台管理 --> 系统设置" 中统一设置

var welive_actived = 1; //welive是否对外提供客服服务, 0表示不提供
var welive_auto = 0; //客服对话窗口自动展开时间(秒), 0表示不自动展开
var welive_color_style = 1; //客服小面板配色风格, 1-5可选, 与welive后台设置保持一致
var welive_lang = "Auto"; //客服小面板语言


//Cookie functions
function welive_setCookie(n,val,d){
	var e = "";
	if(d) {
		var dt = new Date();
		dt.setTime(dt.getTime() + parseInt(d)*24*60*60*1000);
		e = "; expires="+dt.toGMTString();
	}
	document.cookie = n+"="+val+e+"; path=/";
}

function welive_getCookie(n){
	var a = document.cookie.match(new RegExp("(^| )" + n + "=([^;]*)(;|$)"));
	if (a != null) return a[2];
	return "";
}


//访客id
var welive_gid = welive_getCookie("welive_user");

//访客用户名
var welive_fn = welive_getCookie("welive_fn");

//为解决第三方cookie被禁止或跨域问题, 此处用于welive回调当前页面, 并使用hash保存访客id
if(window.top != window.self){
	try{
		var gid = location.hash.substring(1);
		if(!welive_gid && gid != "") welive_setCookie("welive_user", gid, 365);
		window.stop ? window.stop() : document.execCommand("Stop");
	}catch(e){}

}else if(welive_actived){//是否对外服务

	function $_$(id){return document.getElementById(id);}

	function welive_stopflash(){
		try{$_$("welive_iframe").contentWindow.stopFlashTitle();}catch(e){}
	}

	var welive_loaded = 0; //访客面板是否加载过
	var welive_opened = 0; //是否展开了
			
	var welive_panel_color = new Array("#29C7C2", "#676767", "#e89813", "#930093", "#798ddd"); //配色数组
	welive_panel_color = welive_panel_color[welive_color_style - 1];


	var welive_url = document.getElementsByTagName("script");
	welive_url = welive_url[welive_url.length-1].src;
	welive_url = welive_url.substring(0, welive_url.indexOf("welive.js"));

	var welive_chinese = 0;

	if(welive_lang == "Auto"){
		if(navigator.userAgent.toLowerCase().indexOf("msie") != -1){
			welive_lang = navigator.browserLanguage.toLowerCase();
		}else{
			welive_lang = navigator.language.toLowerCase();
		}

		if(welive_lang == 'zh-cn' || welive_lang == 'zh-tw')  welive_chinese = 1;
	}else if(welive_lang == "Chinese"){
		welive_chinese = 1;
	}

	//获取welive安装地址的域名
	var welive_domain = welive_url.toLowerCase().split("//")[1];
	welive_domain = welive_domain.split("/")[0];

	welive_domain = welive_domain.split("\.").reverse();

	var welive_current = document.domain.toLowerCase(); //当前调用页面的域名
	welive_current = welive_current.split("\.").reverse();

	var welive_same = ''; //域名相同部分

	var welive_max = welive_domain.length > welive_current.length ? welive_current.length : welive_domain.length;

	for(var i = 0; i < welive_max; i++){

		if(welive_domain[i] == welive_current[i]){
			welive_same = "." + welive_current[i] + welive_same;
		}else{
			break;
		}
	}

	welive_same = welive_same.substr(1);

	try{document.domain = welive_same;}catch(e){} //设置主域名


	//开始加载窗口
	var welive_is_mobile = navigator.userAgent.match(/(iPhone|Android|iPod|ios|iPad|Windows ce|Windows mobile|Micromessenger|webOS|Ucweb|UCBrowser|BlackBerry|midp|rv:1.2.3.4)/i);

	if(welive_is_mobile){ //mobile

		welive_mobile();

	}else{ //web

		welive_web();
	}


	//mobile移动端浏览器
	function welive_mobile(){

		var welive_css = document.createElement("link");
		welive_css.setAttribute("rel", "stylesheet");
		welive_css.setAttribute("href", welive_url + "mobile/welive.css");
		document.getElementsByTagName("head")[0].appendChild(welive_css);

		var welive_content = '<div id="welive_online" class="welive_style' + welive_color_style + ' welive_animated welive_zoomIn" style="width:80px;height:80px;"><div id="welive_online_tips">0</div></div>'+
			'<div id="welive_wrap" style="display:none;">'+
				'<div id="welive_close"></div>'+
				'<iframe id="welive_iframe" src="" frameborder="0" scrolling="no" allowTransparency="true"></iframe>'+
			'</div>';

		document.write(welive_content);

		welive_online_tips = $_$("welive_online_tips");
		welive_close_btn = $_$("welive_close");

		var welive_ttt = 0,
			welive_ttt2 = 0,
			welive_obj = {drag: '', wrap: '', flag: 0, x: 0, y: 0, dx: 0, dy: 0, w: 0, h: 0, sw: 0, sh: 0};

		welive_obj.drag = $_$("welive_online");
		welive_obj.wrap = $_$("welive_wrap");

		welive_obj.w = welive_obj.drag.offsetWidth;
		welive_obj.h = welive_obj.drag.offsetHeight;

		welive_obj.drag.addEventListener("touchstart", function(e){
			welive_obj.flag = 1;

			welive_obj.sw = document.documentElement.clientWidth; 
			welive_obj.sh = document.documentElement.clientHeight;

			var touch;

			if(e.targetTouches){
				touch = e.targetTouches[0];
			}else {
				touch = e;
			}

			welive_obj.x = touch.clientX;
			welive_obj.y = touch.clientY;
			welive_obj.dx = welive_obj.drag.offsetLeft;
			welive_obj.dy = welive_obj.drag.offsetTop;
		});

		welive_obj.drag.addEventListener("touchmove", function(e){

			if(welive_obj.flag){
				var touch;

				if(e.targetTouches){
					touch = e.targetTouches[0];
				}else {
					touch = e;
				}

				var x = welive_obj.dx + touch.clientX - welive_obj.x;
				var y = welive_obj.dy + touch.clientY - welive_obj.y;

				if(x > 0 && x < (welive_obj.sw - welive_obj.w)){
					welive_obj.drag.style.left = x + "px";
				}

				if(y > 0 && y < (welive_obj.sh - welive_obj.h)){
					welive_obj.drag.style.top = y +"px";
				}

				e.stopPropagation();
				e.preventDefault();
				return false;
			}

		});

		welive_obj.drag.addEventListener("touchend", function(e){
			welive_obj.flag = 0;
		});

		//监听横竖屏切换
		window.addEventListener("orientationchange", function(){

			welive_obj.drag.style.top = "auto";
			welive_obj.drag.style.left = "auto";
			welive_obj.drag.style.right = "20px";
			welive_obj.drag.style.bottom = 0;

			if(welive_opened){
				welive_obj.wrap.style.display = "none";

				if(welive_ttt2) clearTimeout(welive_ttt2);

				welive_ttt2 = setTimeout(function(){
					welive_obj.drag.click();

				}, 300);
			}

		}, false);

		welive_obj.drag.onclick = function(){

			if(welive_ttt) clearTimeout(welive_ttt);

			welive_opened = 1;

			//重新获取屏幕大小, 因为可能横竖屏发生了切换
			var welive_w = document.documentElement.clientWidth;
			var welive_h = document.documentElement.clientHeight;

			if(!welive_loaded) {
				welive_loaded = 1;
				location.hash = "";
				var url = window.btoa(window.location.href);
				$_$("welive_iframe").src = welive_url + "mobile/welive_index.php?a=621256861&gid=" + welive_gid + "&fn=" + welive_fn + "&r=" + Math.random() + "&d=" + welive_same + "&url=" + url;
			}

			//横屏时welive窗口宽度预定为竖屏时窗口的高度
			if(welive_h < 1) welive_h = 1; //防万一除数为0
			if((welive_w / welive_h) > 1){
				welive_w = welive_h;
				if(welive_w < 400) welive_w = 400;
			}

			//适配pad
			if(welive_w > 500) welive_w = 500;
			if(welive_h > 900) welive_h = 900;

			welive_obj.wrap.style.width = welive_w - 20 + "px";
			welive_obj.wrap.style.height = welive_h - 10 + "px";
			welive_obj.wrap.style.display = "block";

			welive_obj.wrap.className = "welive_zoomIn";

			welive_obj.drag.style.display = "none";
			welive_online_tips.style.display = "none";
			welive_online_tips.innerHTML = "0";

			event.stopPropagation();
			event.preventDefault();
			return false;
		};

		welive_close_btn.onclick = function(){
			welive_obj.drag.style.display = "block";
			welive_opened = 0;
			welive_obj.wrap.className = "welive_zoomOut";
			
			setTimeout(function(){welive_obj.wrap.style.display = "none";}, 200);
		}

		//自动弹开
		if(welive_auto) welive_ttt = setTimeout(function(){welive_obj.drag.click();}, welive_auto * 1000);
	}


	//web浏览器
	function welive_web(){

		function welive_drag(wraper){
			var handler = $_$("welive_drag"), tracker = $_$("welive_mouse_tracker"), o = false, c = 0, u = 0;

			function mousexy(e){
				var x, y;
				var e = e||window.event;
				return {
					x:e.clientX+document.body.scrollLeft+document.documentElement.scrollLeft,
					y:e.clientY+document.body.scrollTop+document.documentElement.scrollTop
				};
			}

			function move(dx, dy) {
				var h = wraper.offsetHeight - dy;
				var i = wraper.offsetLeft + dx;
				var mW = document.documentElement.clientWidth - wraper.offsetWidth - 40;
				var mH = document.documentElement.clientHeight - 30;

				if (h <= 360) h = 360;
				if (h >= mH) h = mH;

				if (i <= 30) i = 30;
				if (i >= mW) i = mW;

				wraper.style.height  = h + "px";
				wraper.style.left  = i + "px";
			}

			function f(e) {
				if (!o) return;
				if (c != -1) {
					var x = mousexy(e).x;
					var y = mousexy(e).y;
					move(x - c, y - u);
					c = x;
					u = y;
				}
				e.stopPropagation();
			}

			function h(e) {
				o = false;
				tracker.style.display = "none";
				e.stopPropagation();
			}

			handler.onmousedown = function(e) {
				o = true;
				c = mousexy(e).x;
				u = mousexy(e).y;
				tracker.style.display = "block";
			};

			tracker.onmouseup = function(e){h(e);return false;};
			tracker.onmousemove = function(e){f(e);return false;};
			handler.onmouseup = function(e){h(e);return false;};
			handler.onmousemove = function(e){f(e);return false;};
		}

		var welive_css = document.createElement("link");
		welive_css.setAttribute("rel", "stylesheet");
		welive_css.setAttribute("href", welive_url + "public/welive.css");
		document.getElementsByTagName("head")[0].appendChild(welive_css);

		var welive_c = '<div id="welive_online" style="background-color:' + welive_panel_color + '">'+
				'<div id="welive_info"><img src="' + welive_url + 'public/img/small_icon.gif">' + (welive_chinese? '点击咨询 在线客服 ...' : 'Click for Online Support ...') + '</div>'+
				'<div id="welive_tg"></div>'+
			'</div>'+
			'<div id="welive_wrap" style="background-color:' + welive_panel_color + '">'+
				'<div id="welive_drag"></div>'+
				'<div id="welive_mouse_tracker"></div>'+
				'<div id="welive_close"></div>'+
				'<div id="welive_close_btn"></div>'+
				'<div id="welive_iwrap">'+
					'<div id="welive_iholder"><iframe id="welive_iframe" src="" frameborder="0" scrolling="no" allowTransparency="true"></iframe></div>'+
				'</div>'+
			'</div>';

		document.write(welive_c);

		var welive_ttt = 0;
		welive_online = $_$("welive_online");
		welive_wrap = $_$("welive_wrap");
		welive_close_btn = $_$("welive_close_btn");

		welive_wrap.onmouseover = function(){welive_close_btn.style.display = "block";};
		welive_wrap.onmouseout = function(){welive_close_btn.style.display = "none";};

		welive_online.onclick = function(){
			if(welive_ttt) clearTimeout(welive_ttt);
			welive_opened = 1;
			if(!welive_loaded) {
				welive_loaded = 1;
				welive_drag(welive_wrap);

				location.hash = "";
				var url = window.btoa(window.location.href);
				$_$("welive_iframe").src = welive_url + "welive2618.php?a=621256861&gid=" + welive_gid + "&fn=" + welive_fn + "&r=" + Math.random() + "&d=" + welive_same + "&url=" + url;

				document.addEventListener("mousedown", welive_stopflash);
				document.addEventListener("keydown", welive_stopflash);
			}
			welive_wrap.style.display = "block";
			welive_online.style.display = "none";
		};

		welive_close_btn.onclick = function(){
			welive_opened = 0;
			welive_wrap.style.display = "none";
			welive_online.style.display = "block";
		};

		if(welive_auto) welive_ttt = setTimeout(function(){welive_online.click();}, welive_auto * 1000);
	}
}