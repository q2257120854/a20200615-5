<?php if (!function_exists('plug_eva_temp')) {
    function plug_eva_temp($OSWAP_d31f3cf3157b915958d1242316285b07, $nr)
    {
        $OSWAP_a1fc2e1d149988ced1e149ea3f6681cf = plug_eva('template_gbldly', $OSWAP_d31f3cf3157b915958d1242316285b07);
        if ($OSWAP_a1fc2e1d149988ced1e149ea3f6681cf == "") {
            $nr = str_replace('{templatedir}', TEMPLATE::assign('templatedir'), $nr);
            plug_eva('template_gbldly', $OSWAP_d31f3cf3157b915958d1242316285b07, $nr);
            $OSWAP_a1fc2e1d149988ced1e149ea3f6681cf = plug_eva('template_gbldly', $OSWAP_d31f3cf3157b915958d1242316285b07);
        }
        $OSWAP_a1fc2e1d149988ced1e149ea3f6681cf = str_replace('/templates/gbldly', TEMPLATE::assign('templatedir'), $OSWAP_a1fc2e1d149988ced1e149ea3f6681cf);
        return $OSWAP_a1fc2e1d149988ced1e149ea3f6681cf;
    }
}
SMACSQL()->select('产品分类', '*', "隐藏<>1 ORDER BY 顺序 DESC");
$OSWAP_05a677503cb8d24853b62c235de56ef3array = array();
$i = 0;
while ($OSWAP_af531cbb173e6eceb39d5e148d935b94 = SMACSQL()->fetch_assoc()) {
    $OSWAP_af531cbb173e6eceb39d5e148d935b94['选中'] = "";
    if (mac_url_get(1) == $OSWAP_af531cbb173e6eceb39d5e148d935b94['id'] || ($i == 0 && mac_url_get(1) == "")) {
        $i++;
        $OSWAP_af531cbb173e6eceb39d5e148d935b94['选中'] = "1";
    }
    $OSWAP_05a677503cb8d24853b62c235de56ef3array[] = $OSWAP_af531cbb173e6eceb39d5e148d935b94;
}

SMACSQL()->select('公告', '*', "`公告ID`<>0");
$gonggao = array();
$i = 0;
while ($OSWAP_af531cbb173e6eceb39d5e148d935b94 = SMACSQL()->fetch_assoc()) {
    
    $gonggao[] = $OSWAP_af531cbb173e6eceb39d5e148d935b94;
}
 
if($_SESSION["uid"]!==null){
  
SMACSQL()->select('`服务`', '*', "`帐号id` =  ".$_SESSION["uid"]);
$items = array();
$i = 0;
while ($OSWAP_af531cbb173e6eceb39d5e148d935b94 = SMACSQL()->fetch_assoc()) {
    
    $items[] = $OSWAP_af531cbb173e6eceb39d5e148d935b94;
}
}



$i = 0;
if (file_exists(SWAP_TEMPLATES_ROOT . '/lib/setting_config.php') == false) {
    die('缺少模板配置文件');
}
require(SWAP_TEMPLATES_ROOT . '/lib/setting_config.php');
foreach ($template_config as $OSWAP_af531cbb173e6eceb39d5e148d935b94) {
    $OSWAP_a0010af60c5bd5251d1c5a83a1ea4ab2[$OSWAP_af531cbb173e6eceb39d5e148d935b94['name']] = plug_eva_temp($OSWAP_af531cbb173e6eceb39d5e148d935b94['name'], $OSWAP_af531cbb173e6eceb39d5e148d935b94['default']);
}

$XQY['登录注册logo']=plug_eva_temp("登录注册logo",'https://yangbaimg.syoogame.com/tmp/000/00/00/00/5e33a23b6045c.jpg');
$XQY['QQ群']=plug_eva_temp("QQ群",'831733573');
$XQY['站长QQ']=plug_eva_temp("站长QQ",'1282127298');

$XQY['产品服务']=plug_eva_temp("产品服务",'<li><a href="/index.php/buy/index/17/#">活动虚拟空间</a></li>
                                           <li><a href="/index.php/buy/index/2/#">公益扶持空间</a></li>');

$XQY['首页SEO']=plug_eva_temp("首页SEO标题",'高防高速免备案海外空间提供商');
$XQY['首页SEO关键字']=plug_eva_temp("SEO关键字",'公益空间,橙子,公益主机,高速免备案,橙子互联');
$XQY['首页SEO描述']=plug_eva_temp("SEO描述",'橙子互联提供高防高速计算服务，橙子科技旗下站点。');

$XQY['侧边导航栏logo']=plug_eva_temp("侧边导航栏logo",'https://yangbaimg.syoogame.com/tmp/000/00/00/00/5e3399c3ecf98.jpg');
$XQY['全局小logo']=plug_eva_temp("全局小logo",'https://yangbaimg.syoogame.com/tmp/000/00/00/00/5e33b1c9ce963.jpg');
$XQY['PC端幻灯片1标题']=plug_eva_temp("PC端幻灯片1标题",'性价比推荐美国100G高防高速节点');
$XQY['PC端幻灯片1文字']=plug_eva_temp("PC端幻灯片1文字",'美国节点100GDDos防护 中国电信cn2回程优化 延迟低至150ms');
$XQY['PC端幻灯片1按钮显示文字']=plug_eva_temp("PC端幻灯片1按钮显示文字",'立即抢购');
$XQY['PC端幻灯片1按钮跳转链接']=plug_eva_temp("PC端幻灯片1按钮跳转链接",'/index.php/buy/');
$XQY['PC端幻灯片2标题']=plug_eva_temp("PC端幻灯片2标题",'三年同行,质造未来');
$XQY['PC端幻灯片2文字']=plug_eva_temp("PC端幻灯片2文字",'以品质为核心打造高性价比产品与服务');
$XQY['PC端幻灯片2按钮显示文字']=plug_eva_temp("PC端幻灯片2按钮显示文字",'了解更多');
$XQY['PC端幻灯片2按钮跳转链接']=plug_eva_temp("PC端幻灯片2按钮跳转链接",'/index.php/buy/');
$XQY['PC端幻灯片3标题']=plug_eva_temp("PC端幻灯片3标题",'喜迎新年 站群8IP空间/CDN');
$XQY['PC端幻灯片3文字']=plug_eva_temp("PC端幻灯片3文字",'爆款空间 使用优惠码低至2元');
$XQY['PC端幻灯片3按钮显示文字']=plug_eva_temp("PC端幻灯片3按钮显示文字",'查看详情');
$XQY['PC端幻灯片3按钮跳转链接']=plug_eva_temp("PC端幻灯片3按钮跳转链接",'/index.php/buy/index/17');
$XQY['PC端幻灯片1图片路径']=plug_eva_temp("PC端幻灯片1图片路径",'https://yangbaimg.syoogame.com/tmp/000/00/00/00/5e39722111801.jpg');
$XQY['PC端幻灯片2图片路径']=plug_eva_temp("PC端幻灯片2图片路径",'https://yangbaimg.syoogame.com/tmp/000/00/00/00/5e38c854c314e.jpg');
$XQY['PC端幻灯片3图片路径']=plug_eva_temp("PC端幻灯片3图片路径",'https://yangbaimg.syoogame.com/tmp/000/00/00/00/5e3971dca46e0.jpg');
$XQY['网站统计ID']=plug_eva_temp("网站统计ID",'cnzz_stat_icon_1277820025');
$XQY['网站统计域名']=plug_eva_temp("网站统计域名",'s96.cnzz.com');
$XQY['站长邮箱']=plug_eva_temp("邮箱",'暂未开放');
$XQY['站长QQ']=plug_eva_temp("QQ",'暂未开放');
$XQY['网站运行时间']=plug_eva_temp("网站运行时间",'2020-1-28');
$XQY['工单界面公告']=plug_eva_temp("工单界面公告",'(工单已接入邮箱通知，提交内容时请耐心等待，请勿提交多次，否则拉黑用户IP处理)');
$XQY['产品详请页面公告']=plug_eva_temp("产品详请页面公告",'请勿重置密码，插件存在问题<br/>请等待修复，具体请等待公告通知');
$XQY['服务条款链接']=plug_eva_temp("服务条款链接(注册页面)",'/index.php/index/announcement/6/');
$XQY['服务支持']=plug_eva_temp("服务支持",'<li><a href="#">帮助中心</a></li>
                                           <li><a href="#">资源下载</a></li>');
$XQY['条款政策']=plug_eva_temp("条款政策",'<li><a href="#">服务条款</a></li>
                                           <li><a href="#">合理使用政策</a></li>');

TEMPLATE::assign('tempsz', $OSWAP_a0010af60c5bd5251d1c5a83a1ea4ab2);
TEMPLATE::assign('farray', $OSWAP_05a677503cb8d24853b62c235de56ef3array);
TEMPLATE::assign('navxz', "");
TEMPLATE::assign('news', $gonggao);
TEMPLATE::assign('items', $items);
TEMPLATE::assign('tempsz',$XQY);

do_temp_plug('导航用户中心下拉列表', $OSWAP_63c9fe9b16764330d4105191e2548492);
TEMPLATE::assign('usernavlist', $OSWAP_63c9fe9b16764330d4105191e2548492);






