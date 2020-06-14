// JavaScript Document
document.writeln("<script src='\/public/script\/ajax.js'><\/script>");
window.onload = function() {
	var pageReadOpt = document.getElementById("pageReadOpt");

	document.addEventListener('click', function(e)
	{
		var ev = e||window.event;
		var touch = ev;
		var clientHeight = document.documentElement.clientHeight;

		if(touch.clientY > clientHeight * 0.35 && touch.clientY < clientHeight * 0.75 )
		{
			if(pageReadOpt.classList.contains("active")) {
				pageReadOpt.classList.remove("active");
			} else {
				pageReadOpt.classList.add("active");
			}
		}
	},false);

	
	var readBtnMode = document.getElementById("readBtnMode");
	readBtnMode.onclick = function() 
	{
		if(readBtnMode.getAttribute('data-mode') == "night")
		{
			document.cookie="r_set=night;path=/";
			readBtnMode.setAttribute("data-mode", "day");
		} else {
			document.cookie="r_set=day;path=/";
			readBtnMode.setAttribute("data-mode", "night");
		}

		var readopt = this.getElementsByClassName("read-opt-footer-h")[0];
		if(readopt.innerText == "日间") 
			readopt.innerText = '夜间';
		else 
			readopt.innerText = '日间';
		getset();

	};

	var readBtnSet = document.getElementById("readBtnSet");
	readBtnSet.onclick = function()
	{
		if(document.getElementById('readOptSize').classList.contains("active"))
		{
			document.getElementById('readOptSize').classList.remove("active");
		}

		var readOptSet = document.getElementById('readOptSet');
		if(readOptSet.classList.contains("active"))
		{
			readOptSet.classList.remove("active");
		} else {
			readOptSet.classList.add('active');
		}		
	}

	var readSkin = document.getElementsByClassName("read-set-cell");
	for(var i = 0; i < readSkin.length; i++)
	{
		readSkin[i].onclick = function()
		{
			for(var y = 0; y < readSkin.length; y++)
			{
				var noxspan = readSkin[y].getElementsByTagName("span");
				noxspan[0].classList.remove("active");
			}
			var span = this.getElementsByTagName("span");
			var read = span[0].getAttribute('class');
			document.cookie="read=" + read + ";path=/";
			getset();
			span[0].classList.add("active");
		}
	};

	var mbFtsz = document.getElementsByClassName("mb-ftsz")[0];
	mbFtsz.onclick = function()
	{
		var readOptSet = document.getElementById('readOptSize');
		if(readOptSet.classList.contains("active"))
		{
			readOptSet.classList.remove("active");
		} else {
			readOptSet.classList.add('active');
		}

		if(document.getElementById('readOptSet').classList.contains("active"))
			document.getElementById('readOptSet').classList.remove("active");
	}
	var readFontDown = document.getElementById("readFontDown");
	readFontDown.onclick = function()
	{
		document.cookie="fonter=big;path=/";
		getset();
	}

	var readFontMiddle = document.getElementById("readFontMiddle");

	readFontMiddle.onclick = function()
	{
		document.cookie = "fonter=middel;path=/";
		getset();
	}

	var readFontUp = document.getElementById("readFontUp");
	readFontUp.onclick = function()
	{
		document.cookie = "fonter=up;path=/";
		getset();
	}

	/*var readJoinSJ = document.getElementById("readJoinSJ");
	readJoinSJ.onclick = function(e) {
		var ev = e||window.event;
		console.log(1111);
		ev.cancelBubble = true;
	}*/

	getset();
}


function getset(){
	var strCookie=document.cookie;
	var arrCookie=strCookie.split("; ");
	var light, read;
	var font;
	var _ht = document.getElementsByTagName("html")[0];
	for(var i=0;i<arrCookie.length;i++){ 
		var arr=arrCookie[i].split("=");
		if("read"==arr[0]){ 
			read=arr[1]; 
			break; 
		}
	};

	if(read == 'read-skin-default') _ht.className = "skin-default";
	if(read == "read-skin-blue") _ht.className = "skin-blue";
	if(read == "read-skin-green") _ht.className = "skin-green";
	if(read == "read-skin-light") _ht.className = "skin-light";

	for(var i=0;i<arrCookie.length;i++){ 
		var arr=arrCookie[i].split("=");
		if("r_set"==arr[0]){ 
			light=arr[1]; 
			break; 
		}
	};

	if(light == 'night') _ht.classList.add("read-night");
	if(light == 'day') _ht.classList.remove("read-night");

	for(var j=0;j<arrCookie.length;j++){ 
		var arr=arrCookie[j].split("="); 
		if("fonter"==arr[0]){ 
			font=arr[1]; 
			break; 
		}
	}
	var jsChapterWrapper = document.getElementsByClassName("jsChapterWrapper")[0];

	if(font == "big") jsChapterWrapper.style.fontSize = '1rem';
	if(font == "middel") jsChapterWrapper.style.fontSize = ".68rem";
	if(font == "up") jsChapterWrapper.style.fontSize = ".55rem";

	
	if(light == "day") {
		var skin= "read-" + _ht.getAttribute("class");
	} else if (light == "night") {
		document.getElementsByClassName('read-opt-footer-h')[3].innerText = "日间";
		document.getElementById("readBtnMode").setAttribute("data-mode", "day");
	};

	document.getElementsByClassName(read)[0].classList.add("active");
}
function setHistoryDiv(){var asideTrigger=document.getElementById('aside-trigger');var aside=document.getElementById('aside');if(asideTrigger){var styles=aside.style.display;if(styles==null||styles=='block'){aside.style.display='none';document.body.style.overflowY=''}else{aside.style.display='block';document.body.style.overflowY='hidden'}}}function showHistoryForDiv(){var obj=document.getElementById('last-read-book');if(obj){var _json=getReadHistory();if(!_json){return}var html='';for(var i=0;i<_json.length;i++){html+='<li class="book-li"><a href="/read/'+_json[i].cid+'/'+_json[i].bid+'/'+_json[i].aid+'.html" class="book-layout"><div class="book-cell"><span class="book-title-r">\u7ee7\u7eed\u9605\u8bfb</span><h4 class="book-title">'+_json[i].name+'</h4></div><div class="book-meta">\u5df2\u8bfb\u672c\u4e66\u5230 '+_json[i].title+'</div></a></li>'}obj.innerHTML=html}}

function shuqian(aid,cid){
	doAjax("/modules/article/addbookcase.php", "bid=" + aid + "&cid=" + cid, "shuqian2", "GET", 0);
};
function shuqian2(t){
	var tips = document.createElement("div");
	tips.className='tips fadeout';
	tips.innerHTML = '书签添加成功';
	document.body.appendChild(tips);
	setTimeout(function(){tips.style.display="none"},2000);
};
function tongji(){
var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");
	document.write(
		unescape("%3Cspan id='cnzz_stat_icon_1274261173'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s13.cnzz.com/z_stat.php%3Fid%3D1274261173' type='text/javascript'%3E%3C/script%3E")
	);}