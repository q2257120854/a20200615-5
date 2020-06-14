$.pt=$.pt||{};(function($){$.pt={init:function(){},addFav:function(){var url=window.location.href;var title=window.document.title;if(confirm("收藏名称："+title+"\n收藏网址："+url+"\n确定添加收藏？")){var ua=navigator.userAgent.toLowerCase();if(ua.indexOf("msie 8")>-1){window.external.addToFavoritesBar(url,title);}else{try{window.external.addFavorite(url,title)}catch(e){try{window.sidebar.addPanel(title,url,"");}catch(e){alert("加入收藏失败，请使用Ctrl+D进行添加")}}}}},setHome1:function(url){if(document.all){document.body.style.behavior='url(#default#homepage)';document.body.setHomePage(url)}else if(window.sidebar){if(window.netscape){try{netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect")}catch(e){alert("该操作被浏览器拒绝")}}var prefs=Components.classes['@mozilla.org/preferences-service;1'].getService(Components.interfaces.nsIPrefBranch);prefs.setCharPref('browser.startup.homepage',url)}},backTop:function(s){$(window).scroll(function(){if($(window).scrollTop()>=200){$(s).fadeIn(500)}else{$(s).fadeOut(500)}});$(s).click(function(){$('body,html').animate({scrollTop:0},500);return false})},tab:function(){$('.pt-tab .pt-tab-nav li').on('mouseover',function(){$(this).addClass('active').siblings().removeClass('active');console.log($(this).index());$(this).parents('.pt-tab').find('.pt-tab-con ul').eq($(this).index()).removeClass('none').siblings().addClass('none')})},gopos:function(s){$('body,html').animate({scrollTop:$(s).offset().top},500)}}})($);$(function(){$.pt.backTop('.gotop');$.pt.tab();$('img').on('error',function(){this.src='/public/image/nocover2.jpg'});$('.dropmenu').hover(function(){$(this).addClass("hover")},function(){$(this).removeClass("hover")});$('.searchbox .dropmenu-item li').on('click',function(){$('[name=searchtype]').val($(this).data('type'));$(this).prependTo($(this).parent());$('.dropmenu').removeClass('hover')})});
function SetHome(obj,url){
  try{
    obj.style.behavior='url(#default#homepage)';
    obj.setHomePage(url);
  }catch(e){
    if(window.netscape){
     try{
       netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
     }catch(e){
       alert("抱歉，此操作被浏览器拒绝！\n\n请在浏览器地址栏输入“about:config”并回车然后将[signed.applets.codebase_principal_support]设置为'true'");
     }
    }else{
    alert("抱歉，您所使用的浏览器无法完成此操作。\n\n您需要手动将【"+url+"】设置为首页。");
    }
 }
}
function AddFavorite(title, url) {
 try {
   window.external.addFavorite(url, title);
 }
catch (e) {
   try {
    window.sidebar.addPanel(title, url, "");
  }
   catch (e) {
     alert("抱歉，您所使用的浏览器无法完成此操作。\n\n加入收藏失败，请进入新网站后使用Ctrl+D进行添加");
   }
 }
}
function tixing(v,n){var q={content:"《"+n+"》貌似有新章节了，赶紧去看看吧【请记得加入收藏,免费小说在线阅读,超快的更新,不要错过精彩内容】",time:GetDateStr(2)+" 20:30",advance:0,url:"https://www.677a.cn/novel/"+v+".html",icon:"1_1"};
show('<a rel=\"nofollow\" id="qqtix" href="http://qzs.qq.com/snsapp/app/bee/widget/open.htm#content='+encodeURIComponent(q.content)+'&time='+encodeURIComponent(q.time)+'&advance='+q.advance+'&url='+encodeURIComponent(q.url)+'" target="_blank">提醒更新</a>');}