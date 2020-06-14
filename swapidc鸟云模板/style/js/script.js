var isChrome = navigator.userAgent.toLowerCase().match(/chrome/) != null; 

$(function() {
    bindCloseBtn('#service_bar_close'); //为ID为close的DIV添加点击事件
    bindMiniBtn('#online_service_minibar', '#online_service_fullbar'); //绑定Mini按钮事件
    bindGroupBtn('.service_menu li dl dt'); //光标经过显示分组
    showDefaultView(default_view); //展开方式
    $('.service_menu li.hover dl dd').show();
    scrollAd('#online_service_bar');
    //当页面大小改变时
    $(window).scroll(function() {
        scrollAd('#online_service_bar');
    });
});

//显示展开或收缩状态
function showDefaultView(status) {
    var cookieValue = getCookie('online_service_status');
    if (cookieValue != "") {
        status = cookieValue;
    }
    if (status == 1) {
        $('#online_service_minibar').hide();
        $('#online_service_fullbar').show();
    } else {
        $('#online_service_fullbar').hide();
        $('#online_service_minibar').show();
    }
    addCookie('online_service_status', status, 720);
}

//为ID为close的DIV添加点击事件
function bindCloseBtn(obj) {
    $(obj).click(function() {
        $('#online_service_fullbar').hide(1000, function() {
            if (isChrome) {
                $('#online_service_minibar').show();
            }
            else {
                $('#online_service_minibar').show(500);
            }
            addCookie('online_service_status', 0, 720);
        });
    });
}

//绑定Mini按钮事件
function bindMiniBtn(hideObj, showObj) {
    $(hideObj).bind('mouseover', function() {
        showMiniBar(hideObj, showObj);
        addCookie('online_service_status', 1, 720);
    });
}

//光标经过显示分组
function bindGroupBtn(obj) {
    $(obj).hover(function() {
        var pobj = $(this).parent().parent();
        $(pobj).stop();
        $(pobj).siblings(".hover").removeClass('hover');
        showServiceMenu(pobj);
    }, function() {
        $(this).parent().parent().stop();
    });
}

//显示Mini样式
function showMiniBar(hideObj, showObj) {
    $(hideObj).hide(500, function() {
        if (isChrome) {
            $(showObj).show();
        }
        else {
            $(showObj).show(500);
        }
    });
}

//显示当前菜单
function showServiceMenu(obj, speed) {
    speed = speed || 500;
    $(obj).addClass('hover').children('dl').children('dd').slideDown(speed);
    $(obj).siblings().children('dl').children('dd').slideUp(speed);
}

//定义一个名字为scrollAD的函数
function scrollAd(obj) {
    //定义位移为floatdiv的高度加上滚动条的顶部距离
    var offset = $(obj).height() + $(document).scrollTop() - 30;
    //为floatdiv添加动画为TOP位移offset的高度，持续0.8秒。
    $(obj).stop().animate({ top: offset }, 1000);
}

//写Cookie
function addCookie(objName, objValue, objHours) {
    var str = objName + "=" + escape(objValue);
    if (objHours > 0) {//为0时不设定过期时间，浏览器关闭时cookie自动消失
        var date = new Date();
        var ms = objHours * 3600 * 1000;
        date.setTime(date.getTime() + ms);
        str += "; expires=" + date.toGMTString();
    }
    document.cookie = str;
}

//读Cookie
function getCookie(objName) {//获取指定名称的cookie的值
    var arrStr = document.cookie.split("; ");
    for (var i = 0; i < arrStr.length; i++) {
        var temp = arrStr[i].split("=");
        if (temp[0] == objName) return unescape(temp[1]);
    }
    return "";
}