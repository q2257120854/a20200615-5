<?php defined('PT_ROOT') || exit('Permission denied');?><!DOCTYPE html>
<html lang="zh-CN">
    
    <head>
        <meta charset="gbk">
        <meta content="telephone=no,email=no" name="format-detection">
        <title>
            <?php if ($_parsetplfile=parseTpl($tkd['title'])){include $_parsetplfile;}?>手机版
        </title>
        <meta name="keywords" content="<?php if ($_parsetplfile=parseTpl($tkd['keywords'])){include $_parsetplfile;}?>">
        <meta name="description" content="<?php if ($_parsetplfile=parseTpl($tkd['description'])){include $_parsetplfile;}?>">
        <script type="text/javascript" src="<?php echo $this->pt->config->get("resurl");?><?php echo __TMPL__;?>/script/flexible.0.3.4.js"></script>
        <link rel="stylesheet" href="<?php echo $this->pt->config->get("resurl");?><?php echo __TMPL__;?>/v<?php echo $this->pt->config->get("tplconfig.demo");?>/css/read.css?v=5" type="text/css">
        <script>
      	        $(function(){ 
		        $(".ul-odr").load("/novel/<?php echo $novel['pinyin'];?>/readend.html .ul-odr"); 
            }) 
	        $(function(){ 
		        $(".ul-rvt").load("/novel/<?php echo $novel['pinyin'];?>/readend.html .ul-rvt"); 
            })
      </script>
    </head>
    
    <body ontouchstart class=" bg-2 fstep-3 page-ud ">
	    <a class="tab-item external" href="javascript:bofang('6','<?php echo $this->pt->config->get("tplconfig.spd");?>');" id="langdu"></a>
        <?php include_once( "baidu_js_push.php") ?>
            <script>
                (function() {
                    var src = (document.location.protocol == "http:") ? "//js.passport.qihucdn.com/11.0.1.js?a60a920548450ac2b99352eec02c7d5c": "//jspassport.ssl.qhimg.com/11.0.1.js?a60a920548450ac2b99352eec02c7d5c";
                    document.write('<script src="' + src + '" id="sozz"><\/script>');
                })();
            </script>
            <div class="rd-cnt">
                <div class="rd-top" id="rd-top">
                    <span class="fl">
                        《<?php echo $novel['name'];?>》 <?php echo $chapter['name'];?>
                    </span>
                    <span class="fr page-nav" id="page-nav">
                    </span>
                </div>
                <div class="rd-txt" id="rd-txt">
                    <?php echo br2p($chapter['content']);?>
                    <div class="ud-link" style="position:relative; z-index:38">
                        <a href="<?php echo $chapter['nextinfo']['url'];?>" title="<?php echo $chapter['nextinfo']['name'];?>">
                            <?php echo truncate($chapter['nextinfo']['name'],19,'...');?>
                        </a>
                    </div>
                  <li class="ud-link"><?php echo $this->pt->config->get("tplconfig.footlink");?></li>
                </div>
            </div>
            <div class="fn-cnt">
                <div class="fn-top" id="fn-top">
                    <a href="javascript:history.go(-1)" class="fl">
                        <i class="icon icon-back">
                            返回
                        </i>
                    </a>
                    <ul class="fr fb-icon">
                        <li>
                            <a href="<?php if(IS_LOGIN):?><?php echo U("user.index.index",array());?><?php else:?><?php echo U("user.public.login",array());?><?php endif;?>" class="icon-c">
                                <i class="icon icon-c" title="个人中心">
                                </i>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo U("user.history.index",array());?>" class="icon-shujia">
                                <i class="icon icon-shujia" title="书架">
                                </i>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $url['down'];?>" class="icon-d">
                                <i class="icon icon-d" title="下载">
                                </i>
                            </a>
                        </li>
                        <li>
                            <a href="/" class="icon-home">
                                <i class="icon icon-home" title="主页">
                                </i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="fn-btm fb-icon" id="fn-btm">
                    <ul>
                        <li onclick="$('#changsource > div ').show();">
                            <div>
                                <i class="icon icon-qiehuan">
                                </i>
                                <span>
                                    换源
                                </span>
                            </div>
                        </li>
                        <li class="night">
                            <div>
                                <i class="icon icon-moon">
                                </i>
                                <span>
                                    关灯
                                </span>
                            </div>
                        </li>
                        <li class="day">
                            <div>
                                <i class="icon icon-sun">
                                </i>
                                <span>
                                    开灯
                                </span>
                            </div>
                        </li>
                        <li class="li-cfg">
                            <div>
                                <i class="icon icon-cfg">
                                </i>
                                <span>
                                    设置
                                </span>
                            </div>
                        </li>
                       <?php if($marked):?>
                        <li class="li-fav1">
                            <a href="<?php echo $url['addmark'];?>" title="收藏<?php echo $novel['name'];?>">
                                <div class="add-fav">
                                    <i class="icon icon-fav1">
                                    </i>
                                    <span>
                                       已收藏
                                    </span>
                                </div>
                            </a>
                        </li>
                        <?php else:?>
                        <li class="li-fav">
                            <a href="<?php echo $url['addmark'];?>" title="收藏<?php echo $novel['name'];?>">
                                <div class="add-fav">
                                    <i class="icon icon-fav">
                                    </i>
                                    <span>
                                       收藏
                                    </span>
                                </div>
                            </a>
                        </li>
                       <?php endif;?>
                        <li class="li-shelf">
                            <a href="<?php echo $url['info'];?>" title="回<?php echo $novel['name'];?>书页">
                                <div class="go-shelf">
                                    <i class="icon icon-shelf">
                                    </i>
                                    <span>
                                        回书页
                                    </span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="cfg-pnl" id="cfg-pnl">
                    <ul>
                        <li class="cfg-font" id="cfg-font">
                            <label>
                                字体
                            </label>
                            <div>
                                <menu>
                                    <menuitem class="fs-add">
                                        A
                                        <em>
                                            +
                                        </em>
                                    </menuitem>
                                    <menuitem class="fs-rdu">
                                        A
                                        <em>
                                            -
                                        </em>
                                    </menuitem>
                                    <menuitem class="fs-dft">
                                        默认
                                    </menuitem>
                                </menu>
                            </div>
                        </li>
                        <li class="cfg-mode" id="cfg-mode">
                            <label>
                                模式
                            </label>
                            <div>
                                <menu>
                                    <menuitem class="mode-ud">
                                        上下滑动
                                    </menuitem>
                                    <menuitem class="mode-lr">
                                        左右滑动
                                    </menuitem>
                                </menu>
                            </div>
                        </li>
                        <li class="cfg-bg" id='cfg-bg'>
                            <label>
                                背景
                            </label>
                            <div>
                                <menu>
                                    <menuitem data-cls="bg-1" class="bg-1">
                                    </menuitem>
                                    <menuitem data-cls="bg-2" class="bg-2">
                                    </menuitem>
                                    <menuitem data-cls="bg-3" class="bg-3">
                                    </menuitem>
                                    <menuitem data-cls="bg-4" class="bg-4">
                                    </menuitem>
                                    <menuitem data-cls="bg-5" class="bg-5">
                                    </menuitem>
                                </menu>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="tap-hdl" id="tap-hdl">
                <div class="pg-up">
                    <p>
                        上一页
                    </p>
                </div>
                <div class="pg-up-1">
                </div>
                <div class="fn-div">
                    <div>
                        <i class="bg-hand">
                        </i>
                        <span>
                            点击功能呼出
                        </span>
                    </div>
                </div>
                <div class="pg-dn">
                    <p>
                        下一页
                    </p>
                </div>
                <div class="pg-dn-1">
                </div>
                <div class="pg-lft">
                    <p>
                        上一页
                    </p>
                </div>
                <div class="pg-rit">
                    <p>
                        下一页
                    </p>
                </div>
                <input type="hidden" name="chpt-prev" id="prev-url" value="<?php echo $chapter['preinfo']['url'];?>">
                <input type="hidden" name="next-prev" id="next-url" value="<?php echo $chapter['nextinfo']['url'];?>">
            </div>
            <div class="idx-bg">
            </div>
	       <!--end of .tap-hdl-->
	       <div class="idx-bg"></div>
	       <div class="idx-cnt" id="idx-cnt">
               <div class="idx-div">
                   <h2>
                       <span><?php echo $novel['name'];?></span>
				       <i class="icon icon-rvt">倒序</i>
				       <i class="icon icon-odr">正序</i>
			      </h2>
                  <ul class="ul-rvt"></ul>
			      <ul class="ul-odr"></ul>
             </div>
             <div class="idx-hdl" id="idx-hdl"></div>
	     </div>
	     <!--end of idx-cnt -->
            <div id="msg-cnt" class="msg-cnt">
                <span>
                </span>
            </div>
            <div id="changsource" class="changsource ">
                <div class="over s_event">
                </div>
                <div class="ptm-card d_list s_event">
                    <div class="ptm-card-header ptm-clearfix">
                        <div class="ptm-pull-left" style="color:GhostWhite">
                            《<?php echo $novel['name'];?>》本章换源阅读
                        </div>
                        <div class="close ptm-pull-right" onclick="$('#changsource > div ').hide();">
                            X
                        </div>
                    </div>
                    <div class="ptm-card-content">
                        <ul class="pt-card pt-card-6">
                            <?php if(is_array($chapter['samelist'])): foreach($chapter['samelist'] as $key =>$loop):?>
                            <li>
                                <div class="pt-novel">
                                    <div class="pt-num ptm-pull-right">
                                        <a rel="nofollow" href="<?php echo $loop['url'];?>" title="<?php echo $novel['name'];?> <?php echo $loop['name'];?>"
                                        style="color:GhostWhite">
                                            <?php echo $loop['name'];?>
                                        </a>
                                    </div>
                                    <span class="pt-name">
                                        <a rel="nofollow" href="<?php echo $loop['url'];?>" class="ptm-text-grey" target="_self"
                                        title="<?php echo $novel['name'];?> <?php echo $chapter['name'];?>" style="color:GhostWhite">
                                            <?php echo truncate($chapter['name'],15,'');?>
                                        </a>
                                    </span>
                                </div>
                                <li>
                                    <?php endforeach; endif;?>
                        </ul>
                    </div>
                </div>
            </div>
			<a onClick="toshare()" class="backtop-circle" value="听书"><i class="icon icon-ts">听</i></a>
<div class="am-share">
  <h3 class="am-share-title"><div id="audioBox"></div></h3>
  <ul class="am-share-sns">
    <li><a href="javascript:dusu('4');"> <i class="share-icon-tingshu"></i> <span>丫丫</span> </a> </li>
	<li><a href="javascript:dusu('11');"> <i class="share-icon-tingshu"></i> <span>骚男</span> </a> </li>
    <li><a href="javascript:dusu('5');"> <i class="share-icon-tingshu"></i> <span>暖女</span> </a> </li>
    <li><a href="javascript:dusu('6');"> <i class="share-icon-tingshu"></i> <span>评书</span> </a> </li>
    <li><a href="javascript:dusu('9');"> <i class="share-icon-tingshu"></i> <span>主持</span> </a> </li>
  </ul>
  <div class="am-share-footer"><button class="share_btn"><a href="">停止</a></button></div>
</div>
<script type="text/javascript" src="<?php echo $this->pt->config->get("resurl");?><?php echo __TMPL__;?>/script/wap.js"></script>
<script type="text/javascript">
	function toshare(){
		$(".am-share").addClass("am-modal-active");	
		if($(".sharebg").length>0){
			$(".sharebg").addClass("sharebg-active");
		}else{
			$("body").append('<div class="sharebg"></div>');
			$(".sharebg").addClass("sharebg-active");
		}
		$(".sharebg-active,.share_btn").click(function(){
			$(".am-share").removeClass("am-modal-active");	
			setTimeout(function(){
				$(".sharebg-active").removeClass("sharebg-active");	
				$(".sharebg").remove();	
			},300);
		})
	}	
</script>
<script>
    var cnzz_s_tag = document.createElement('script');
    cnzz_s_tag.type = 'text/javascript';
    cnzz_s_tag.async = true;
    cnzz_s_tag.charset = 'utf-8';
    cnzz_s_tag.src = '//w.cnzz.com/c.php?id=<?php echo $this->pt->config->get("tplconfig.tongji");?>&async=1';
    var root_s = document.getElementsByTagName('script')[0];
    root_s.parentNode.insertBefore(cnzz_s_tag, root_s);
</script>
    </body>