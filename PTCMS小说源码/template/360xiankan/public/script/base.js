// JavaScript Document
document.writeln("<script src='\/public/script\/ajax.js'><\/script>");
function tongji(){
	var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");
	document.write(
		unescape("%3Cspan id='cnzz_stat_icon_1274261173'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s13.cnzz.com/z_stat.php%3Fid%3D1274261173' type='text/javascript'%3E%3C/script%3E")
	);}

window.onload = function() {
	var openGuide = document.getElementById('openGuide');
	var openSearchPopup = document.getElementById('openSearchPopup');
	if(openGuide) {
		openGuide.onclick = function() {
			var search = document.getElementsByClassName('search')[0];
			var header = document.getElementById("header");
			if(search.classList.contains("active")){
				search.classList.remove("active");
				search.classList.add("hide");
				header.removeAttribute("style");
			}

			var guide = document.getElementById("guide");
			var heade = document.getElementById("header");
			if(this.classList.contains("active")) {
				this.classList.remove("active");
				guide.classList.remove("active");
				heade.removeAttribute("open");
			} else {
				this.classList.add("active");
				guide.classList.add("active");
				heade.setAttribute("open",'');
			}
		}
	}

	if(openSearchPopup) {
		openSearchPopup.onclick = function() {
			var guide = document.getElementById("guide");
			var heade = document.getElementById("header");
			if(guide.classList.contains("active"))
			{
				openGuide.classList.remove("active");
				guide.classList.remove("active");
				heade.removeAttribute("open");
			}
			var search = document.getElementsByClassName('search')[0];
			var header = document.getElementById("header");
			if(search.classList.contains("hide")) {
				search.classList.add("active");
				search.classList.remove("hide");
				header.style = "background:#fff";
			} else {
				search.classList.remove("active");
				search.classList.add("hide");
				header.removeAttribute("style");
			}
		}
	}
	
	window.onscroll = function(e) {
		var jsBackToTop = document.getElementsByClassName('jsBackToTop')[0];
		var scroll =  document.body.scrollTop|| document.documentElement.scrollTop;
		if(scroll < 270) {
			jsBackToTop.style.opacity = 0;
			jsBackToTop.style.visibility = 'hidden'; 
		} else {
			jsBackToTop.style.opacity = 1;
			jsBackToTop.style.visibility = 'visible'; 
		}
	};
	if(document.getElementsByClassName('jsBackToTop')[0])
	{
		document.getElementsByClassName('jsBackToTop')[0].onclick = function () {
			document.body.scrollTop = document.documentElement.scrollTop = 0;
		}
	}
	

	if(document.getElementById("aUserCenter")){
		doAjax("/modules/article/wapajax.php", "showlogin=1", "showlogin2", "GET", 0);
	}


	var bookSummary = document.getElementById("bookSummary");
	var content = document.getElementsByTagName("content")[0];

	if(bookSummary &&content) {
		if(bookSummary.offsetHeight < content.offsetHeight) {

			bookSummary.classList.add("enabled");
		}

		if(bookSummary.classList.contains("enabled"))
		{
			bookSummary.onclick = function()
			{
				var textarea = document.getElementsByTagName("textarea")[0].innerText;
				var contenttext = content.innerText;
				var BookSummaryMore = document.getElementsByClassName('book-summary-more')[0];

				if(!bookSummary.hasAttribute("style"))
				{
					content.innerHTML = textarea;
					bookSummary.style.height = 'auto';
					bookSummary.style.fontSize = ".55rem";
					BookSummaryMore.style.opacity = 0;
				} else {
					content.innerHTML = contenttext;
					bookSummary.removeAttribute("style");
					BookSummaryMore.removeAttribute("style");
				}
			}
		}
	}
};
function shujia(aid){
	doAjax("/modules/article/addbookcase.php", "bid=" + aid, "shujia2", "GET", 0);
}
function shujia2(t){
	var tips = document.createElement("div");
	tips.className='tips fadeout';
	tips.innerHTML = '已加入书架';
	document.body.appendChild(tips);
	setTimeout(function(){tips.style.display="none"},2000);
}

function showlogin2(t){	//查看是否登录
	var avatar = document.getElementById("avatar");
	if(t != "nologin"){
		document.getElementsByClassName('jsGuestWrapper')[0].style.display = 'none';
		var aUserCenter = document.getElementById("aUserCenter");
		avatar.removeAttribute("hidden");
		avatar.src = "/public/image/noavatar_middle.gif";
		aUserCenter.href = "/user/index/index.html";
	}
}

function gao(){
	var xmlhttp = new XMLHttpRequest();//公告
	xmlhttp.open('GET','/gao/gonggao.txt',false);
	xmlhttp.send();
	var GaoText=xmlhttp.responseText;
	if(GaoText.length>0){
		document.writeln("<div class='note-error'><a href='javascript:;' class='close'></a><h5>"+GaoText+"</h5></div>");	
		close();
	}
};
function show_search(){
	var type = document.getElementById("type");
	type.innerHTML == "书名"?type.innerHTML = "作者":type.innerHTML = "书名";
	document.getElementById('searchType').value !== 'author'? document.getElementsByTagName("option")[1].selected = true:document.getElementsByTagName("option")[1].selected = false;
}
function key(e){
	if(e.keyCode == 13){
		check();
	}
}
function check(){
	var $s = document.getElementById('searchType').value;
	var $q = document.getElementById("bdcs-search-form-input").value;
	var $url = "/search.html?";
	var $open = $url +"searchkey=" +$q + '&searchtype=' + $s;
	window.location.href = $open;
};
function case_del(k)
{
	doAjax("/modules/article/wapajax.php", "aid=" + k +"&case_del=1", "case_del2", "POST", 0);
}
function case_del2(t){
	var tips = document.createElement("div");
	tips.className='tips fadeout';
	tips.innerHTML = '已从书架删除';
	document.body.appendChild(tips);
	setTimeout(function(){tips.style.display="none"},2000);

	var li = document.getElementById("booklist-" + t);
	var listsplit = document.getElementsByClassName("list-split-1")[0];
	listsplit.removeChild(li);
}

