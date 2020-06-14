$(function(){
    var winr=$(window); 
    var surl = location.href;
    var surl2 = $(".place a:eq(1)").attr("href");
    
    $(".nav li a").each(function() {
        if ($(this).attr("href")==surl || $(this).attr("href")==surl2) $(this).parent().addClass("on");
    });
    
    $(".nav-on").click(function () {
        $(".wap-nav-box").animate({left: "0",});
        $(".wap-nav").fadeIn();
    });
    $(".nav-off,.nav-off1").click(function () {
        $(".wap-nav-box").animate({left: "-220",});
        $(".wap-nav").fadeOut();
    });
    
    $(".user-on").click(function () {
        $(".login-head").slideToggle();
    });
    
    
    if(winr.width()>=800){
        if($('div').hasClass('info-fixed')){
            var fixedh = $(".info-fixed").offset().top;
        }
        var dv = $(".info-fixed"),st;
        $(window).scroll(function () {
            st = Math.max(document.body.scrollTop || document.documentElement.scrollTop);
            if(st > fixedh){
                dv.addClass("info-fixed1");
            }else{
                dv.removeClass("info-fixed1");
            } 
        });
    }
    
    $(".zp-on").click(function () {
        $('html,body').animate({scrollTop:$("#zpjj").offset().top}, 800);
    });

    $(".info-down").click(function () {
        $('html,body').animate({scrollTop:($(".info-dw").offset().top - 200)}, 800);
    });
});


function tabs(tabTit,on,tabCon){
    $(tabTit).children().click(function(){
        $(this).addClass(on).siblings().removeClass(on);
        var index = $(tabTit).children().index(this);
        $(tabCon).children().eq(index).show().siblings().hide();
    });
};
tabs(".tab-hd","active",".tab-bd");



zbp.plugin.unbind("comment.reply", "system");
zbp.plugin.on("comment.reply", "txtsj", function(id) {
    var i = id;
    $("#inpRevID").val(i);
    var frm = $('#divCommentPost'),
        cancel = $("#cancel-reply");

    frm.before($("<div id='temp-frm' style='display:none'>")).addClass("reply-frm");
    $('#AjaxComment' + i).before(frm);

    cancel.show().click(function() {
        var temp = $('#temp-frm');
        $("#inpRevID").val(0);
        if (!temp.length || !frm.length) return;
        temp.before(frm);
        temp.remove();
        $(this).hide();
        frm.removeClass("reply-frm");
        return false;
    });
    try {
        $('#txaArticle').focus();
    } catch (e) {}
    return false;
});

zbp.plugin.on("comment.get", "txtsj", function (logid, page) {
    $('span.commentspage').html("提交中...");
});
zbp.plugin.on("comment.got", "txtsj", function (logid, page) {
    $("#cancel-reply").click();
});
zbp.plugin.on("comment.postsuccess", "txtsj", function () {
    $("#cancel-reply").click();
});