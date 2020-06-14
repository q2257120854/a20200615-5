var userAgent = navigator.userAgent.toLowerCase();
var isIE = window.ActiveXObject && userAgent.indexOf('msie') != -1 && userAgent.substr(userAgent.indexOf('msie') + 5, 3);

function $$(id) {return typeof id == "string" ? document.getElementById(id) : id;}

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


//插入表情符号
function insertSmilie(code, towhere) {
	code = '[:' + code + ':]';

	var obj = $("#" + towhere)[0];

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

//JQ闪动特效  ele: JQ要闪动的对象; cls: 闪动的类(className); times: 闪动次数
function shake(ele, cls, times){
	var i = 0, t = false, o = ele.attr("class")+" ", c = "", times = times||2;
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

//显示提示信息 callback表示对话框关闭时执行的函数; success表示是成功信息还是错误信息; time是自动关闭时间(秒)
function showInfo(info, title, callback, time, success){
	var ti = time? time * 1000 : 0;

	if(success){
		var title = "<font color=#33CC00>" + (title? title : "系统信息") + "</font>";
		var content = "<font color=blue>" + info + "</font>";
	}else{
		var title = "<font color=red>" + (title? title : "系统信息") + "</font>";
		var content = "<font color=#FF9900>" + info + "</font>";
	}

	easyDialog.open({
		container:{
			header: title,
			content: content,
			yesFn:function(){},
			yesText: '确定'
		},
		autoClose:ti,
		callback: callback
	});

	$("#easyDialogYesBtn").focus(); //确定按钮获得焦点
}

//显示确认操作对话框 callback表示按确定时执行的函数; time是自动关闭时间;
function showDialog(info, title, callback, time){
	var ti = time? time * 1000 : 0;

	easyDialog.open({
		container:{
			header: "<font color=red>" + (title? title : "系统信息") + "</font>",
			content: "<font color=#FF9900>" + info + "</font>",
			yesFn: callback,
			yesText: '确定',
			noFn:true,
			noText: '取消'
		},
		autoClose:ti
	});

	$("#easyDialogYesBtn").focus(); //确定按钮获得焦点
}


//显示大图片
function show_big_img(me, width, height){

	if(width/height >= 1200/700){
		var d_w = width;
		if(d_w > 1200) d_w = 1200;
		if(width < 1) width = 1;
		var d_h = height * d_w / width;
	}else{
		var d_h = height;
		if(d_h > 700) d_h = 700;
		if(height < 1) height = 1;
		var d_w = width * d_h / height;
	}


	easyDialog.open({
		container:{
			header: "图片",
			content: '<img src="' + me.src + '" style="width: ' + d_w + 'px;height: ' + d_h + 'px;" onclick="easyDialog.close();return false;">',
		},
		width: d_w + 20,
		height: d_h + 20,
		//lock: true, //禁用ESC键关闭, 因为ESC已经用于关闭客人小窗口
	});
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
		beforeSend: function(){ajax_isOk = 0;$("#ajax-loader").addClass('loading');},
		complete: function(){ajax_isOk = 1;$("#ajax-loader").removeClass('loading');},
		success: function(data){
			if(data.s == 0){
				showInfo(data.i, 'Ajax操作失败');
				return false;
			}
			if(callback){
				callback(data);
			}else{
				showInfo(data.i? data.i : 'Ajax操作成功!', '', '', 1, 1);
			}
		},
		error: function(XHR, Status, Error) {
			showInfo("数据: " + XHR.responseText + "<br>状态: " + Status + "<br>错误: " + Error + "<br>", 'Ajax错误');
		}
	});
}

//顶部下拉菜单 b为参数对象, c为下拉菜单显示后的事件函数
(function(a) {
	a.fn.Jdropdown = function(b, c) {
		if (this.length) {
			"function" == typeof b && (c = b, b = {});
			var d = a.extend({
					event: "mouseover",
					current: "hover",
					delay: 0
				}, b || {}),
				e = "mouseover" == d.event ? "mouseout" : "mouseleave";
			a.each(this, function() {
				var b = null,f = null,g = !1;
				a(this).bind(d.event, function() {
					if (g) clearTimeout(f);
					else {
						var e = a(this);
						b = setTimeout(function() {
							e.addClass(d.current), g = !0, c && c(e)
						}, d.delay);
					}
				}).bind(e, function() {
					if (g) {
						var c = a(this);
						f = setTimeout(function() {
							c.removeClass(d.current), g = !1
						}, 0)
					} else clearTimeout(b);
				});
			});
		}
	}
})(jQuery);

//选中顶部菜单
function SelectMenu(){
	if(!this_uri || this_uri == 'index.php'){
		$("dl.home").addClass("active");
		return;
	}
	var linkfound = false;
	var toplinks = $("#topmenu > dl > dt > a");
	toplinks.each(function(){
		if(this_uri.indexOf($(this).attr('href')) >= 0){
			$(this).parent().parent().addClass("active");
			linkfound = true;
			return false;
		}
	});

	if(!linkfound){
		toplinks = $("#topmenu > dl > dd > div > li > a");
		toplinks.each(function(){
			if(this_uri.indexOf($(this).attr('href')) >= 0){
				$(this).parent().parent().parent().parent().addClass("active");
				return false;
			}
		});
	}
}

$(function(){
	$("#topbar dl").Jdropdown({delay: 50}, function(a){});

	SelectMenu(); //顶部菜单选中状态

	//退出登录
	$(".logout").click(function(e) {
		showDialog('确定退出 WeLive 在线客服系统吗?', '', function(){
			document.location = 'index.php?a=logout';
		});

		e.preventDefault();
	});

	//全选checkbox
	$("#checkAll, #checkAll2").click(function(e){
		$("input[name=\'" + $(this).attr("for") + "\']").prop("checked", $(this).prop("checked"));
	});

});
