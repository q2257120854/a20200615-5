<?php
return array (
  'sitename' => '耽美小说网',
  'siteurl' => 'http://danmeixsw.cn',
  'beian' => '',
  'email' => '36711293@qq.com',
  'qq' => '36711293',
  'admin_pagesie' => '20',
  'allow_module' => 'admin,index,friendlink,ad,page,novelsearch,rule,attachment,user,cron,sitemap,install,author,api,update,wapsitemap,ruled',
  'config_group' => 
  array (
    0 => '不分组',
    1 => '基本',
    2 => '数据库',
    3 => '显示',
    4 => '功能',
    5 => '开放登录',
    -1 => 'TKD',
    -2 => 'URL',
    -3 => '采集',
  ),
  'tpl_theme' => 'pcmbv4.5',
  'addir' => 'ptcms',
  'runinfo' => 'Processed in {time}(s), Memory: {mem}MB, Sqls: {sql}, cacheread: {cacheread}, cachewrite: {cachewrite}, net:{net}.',
  'mysql_driver' => 'pdo',
  'mysql_prefix' => 'ptcms_',
  'mysql_master_host' => 'localhost',
  'mysql_master_port' => '3306',
  'mysql_master_name' => 'ptxsok_hui11',
  'mysql_master_user' => 'ptxsok_hui11',
  'mysql_master_pwd' => '7CZmRT44cSh6kmik',
  'app_status' => '1',
  'app_closemsg' => '网站升级中，请稍后访问！',
  'default_module' => 'novelsearch',
  'plugin' => 
  array (
    'template_compile_end' => 
    array (
      0 => 'cleartitle',
    ),
  ),
  'upload_path' => 'uploads',
  'water_type' => '0',
  'water_image' => '/uploads/',
  'water_text' => '图片上传于www.677a.cn',
  'water_font' => 'ptcms.otf',
  'water_position' => '9',
  'water_alpha' => '60',
  'water_fontsize' => '20',
  'water_color' => '#666666',
  'logo' => '/uploads/',
  'pagesize_chapterlist' => '30',
  'pagesize_categorylist' => '10',
  'pagesize_toplist' => '20',
  'pagesize_search' => '100',
  'cache_driver' => 'memcache',
  'visit_day' => '20200422',
  'visit_num' => '1',
  'visit_update' => '7',
  'pagesign' => 
  array (
    'novelsearch.index.index' => 'index',
    'novelsearch.novel.down' => 'down',
    'novelsearch.list.top' => 'top',
    'novelsearch.list.category' => 'category',
    'novelsearch.novel.index' => 'info',
    'novelsearch.novel.author' => 'author',
    'novelsearch.novel.dir' => 'dir',
    'novelsearch.chapter.list' => 'chapterlist',
    'novelsearch.chapter.frame' => 'frame',
    'novelsearch.chapter.go' => 'go',
    'novelsearch.chapter.green' => 'green',
    'novelsearch.chapter.read' => 'read',
    'novelsearch.search.result' => 'search',
    'page.index.detail' => 'page',
    'sitemap.index.index' => 'sitemapindex',
    'sitemap.index.info' => 'sitemapinfo',
    'novelsearch.list.over' => 'over',
    'novelsearch.novel.readend' => 'readend',
    'novelsearch.index.top' => 'topindex',
    'novelsearch.index.category' => 'categoryindex',
    'novelsearch.search.index' => 'searchindex',
    'wapsitemap.index.index' => 'wapsitemapindex',
    'wapsitemap.index.info' => 'wapsitemapinfo',
  ),
  'url_rules' => 
  array (
    'novelsearch.index.index' => '/',
    'novelsearch.novel.index' => '/{novelid}/',
    'novelsearch.novel.down' => '/txt/{novelid}',
    'novelsearch.chapter.list' => '/list/{novelid}[_{sitekey}][_{page}].html',
    'novelsearch.novel.dir' => '/mulu/{novelid}/[{sitekey}/]',
    'novelsearch.novel.author' => '/author/{authorid}',
    'novelsearch.chapter.read' => '/{novelid}_R{chapterid}.html',
    'novelsearch.chapter.frame' => '/{novelid}_K{chapterid}.html',
    'novelsearch.chapter.go' => '/novel/{novelkey}/go_{chapterid}.html',
    'novelsearch.novel.readend' => '/novel/{novelkey}/readend.html',
    'novelsearch.list.over' => '/over/[{page}.html]',
    'novelsearch.index.category' => '/shuku/',
    'novelsearch.index.top' => '/top/',
    'novelsearch.search.index' => '/search/',
    'novelsearch.chapter.green' => '/{novelid}_L{chapterid}.html',
    'novelsearch.list.category' => '/sort/{key}_{chapternum}_{isover}_{order}_{page}.html',
    'novelsearch.list.top' => '/top[/{type}][/{page}].html',
    'page.index.detail' => '/{key}.html',
    'novelsearch.search.result' => '/so/search.html',
    'sitemap.index.index' => '/sitemap.xml',
    'sitemap.index.info' => '/sitemap/{page}.xml',
    'wapsitemap.index.index' => '/wap/sitemap.xml',
    'wapsitemap.index.info' => '/wap/sitemap/{page}.xml',
  ),
  'url_router' => 
  array (
    '^(\\d+)(\\?(.*))*$' => 'novelsearch/novel/index?novelid',
    '^txt/(\\d+)(\\?(.*))*$' => 'novelsearch/novel/down?novelid',
    '^list/(\\d+)_([a-zA-Z0-9_\\-]+)_(\\d+).html(\\?(.*))*$' => 'novelsearch/chapter/list?novelid&sitekey&page',
    '^list/(\\d+)_(\\d+).html(\\?(.*))*$' => 'novelsearch/chapter/list?novelid&page',
    '^list/(\\d+)_([a-zA-Z0-9_\\-]+).html(\\?(.*))*$' => 'novelsearch/chapter/list?novelid&sitekey',
    '^list/(\\d+).html(\\?(.*))*$' => 'novelsearch/chapter/list?novelid',
    '^mulu/(\\d+)/([a-zA-Z0-9_\\-]+)(\\?(.*))*$' => 'novelsearch/novel/dir?novelid&sitekey',
    '^mulu/(\\d+)(\\?(.*))*$' => 'novelsearch/novel/dir?novelid',
    '^author/(\\d+)(\\?(.*))*$' => 'novelsearch/novel/author?authorid',
    '^(\\d+)_R(\\d+).html(\\?(.*))*$' => 'novelsearch/chapter/read?novelid&chapterid',
    '^(\\d+)_K(\\d+).html(\\?(.*))*$' => 'novelsearch/chapter/frame?novelid&chapterid',
    '^novel/([a-zA-Z0-9_\\-]+)/go_(\\d+).html(\\?(.*))*$' => 'novelsearch/chapter/go?novelkey&chapterid',
    '^novel/([a-zA-Z0-9_\\-]+)/readend.html(\\?(.*))*$' => 'novelsearch/novel/readend?novelkey',
    '^over/(\\d+).html(\\?(.*))*$' => 'novelsearch/list/over?page',
    '^over(\\?(.*))*$' => 'novelsearch/list/over?',
    '^shuku(\\?(.*))*$' => 'novelsearch/index/category?',
    '^top(\\?(.*))*$' => 'novelsearch/index/top?',
    '^search(\\?(.*))*$' => 'novelsearch/search/index?',
    '^(\\d+)_L(\\d+).html(\\?(.*))*$' => 'novelsearch/chapter/green?novelid&chapterid',
    '^sort/([a-zA-Z0-9]+)_([a-zA-Z0-9]+)_([a-zA-Z0-9]+)_([a-zA-Z0-9]+)_(\\d+).html(\\?(.*))*$' => 'novelsearch/list/category?key&chapternum&isover&order&page',
    '^top/([a-zA-Z0-9]+)/(\\d+).html(\\?(.*))*$' => 'novelsearch/list/top?type&page',
    '^top/(\\d+).html(\\?(.*))*$' => 'novelsearch/list/top?page',
    '^top/([a-zA-Z0-9]+).html(\\?(.*))*$' => 'novelsearch/list/top?type',
    '^top.html(\\?(.*))*$' => 'novelsearch/list/top?',
    '^([a-zA-Z0-9]+).html(\\?(.*))*$' => 'page/index/detail?key',
    '^so/search.html(\\?(.*))*$' => 'novelsearch/search/result?',
    '^sitemap.xml(\\?(.*))*$' => 'sitemap/index/index?',
    '^sitemap/(\\d+).xml(\\?(.*))*$' => 'sitemap/index/info?page',
    '^wap/sitemap.xml(\\?(.*))*$' => 'wapsitemap/index/index?',
    '^wap/sitemap/(\\d+).xml(\\?(.*))*$' => 'wapsitemap/index/info?page',
  ),
  'collect_cover_check' => '1',
  'collect_category_default' => '14',
  'collect_category_rule' => '1|奇幻=
2|玄幻魔法=玄幻|东方|异界|远古|神话|异世|上古|王朝|争霸|变身|奇幻|西方|领主贵族|亡灵骷髅|异类兽族|魔法校园|吸血传奇|异世争霸|异术超能
3|武侠=
4|武侠修真=武侠|异侠|国术|武技|仙侠|修真|古典仙侠|奇幻修真|现代修真|洪荒封神|国术古武|江湖情仇
5|都市言情=都市|屌丝|校园小说|生活|言情|商|职场|官场|明星|现实|乡土|宦海|重生|异能|青春|乡村|风云|大亨
6|历史穿越=历史|架空|秦|汉|三国|两晋|隋|唐|五代|十国|宋|元|明|清|民国|传记|穿越|传奇|二次元
7|军事科幻=军事|战争|抗战|烽火|军|间谍|暗战|谍战|科幻|未来|星际|古武机甲|数字生命|科技|时空|进化|变异|末世
8|游戏竞技=游戏|网游|竞技|体育|篮球|足球|弈林|棋牌|桌游|电子竞技
9|竞技=
10|科幻=
11|恐怖悬疑=灵异|恐怖|惊悚|推理|侦探|悬疑|探险|悬念|神怪|探险|异闻|神秘|湘西|鬼
12|同人=
13|女生专区=女生|女|现言|情缘|古言|动漫|爱情|豪门|王爷|合租|情缘|恩怨|情仇|校园|情感|总裁|娇花|女频|甜心|妃|耽美|散文|诗词|职场|丽人|动漫|种田重生
14|其他类型=其他|同人|综合',
  'httpmethod' => 'curl',
  'timeout' => '10',
  'user_agent' => 'Mozilla/5.0 (compatible; Baiduspider/2.0; https://www.baidu.com/search/spider.html)',
  'oauth_power' => '0',
  'oauth_qq_appid' => '',
  'oauth_qq_appsecret' => '',
  'oauth_qq_check' => '',
  'oauth_weibo_check' => '',
  'oauth_weibo_appid' => '',
  'oauth_weibo_appsecret' => '',
  'read_type' => 'green',
  'caption_allcateogry' => '全部小说',
  'caption_top' => 
  array (
    'postdate' => '入库时间',
    'lastupdate' => '最新更新',
    'dayvisit' => '日点击',
    'weekvisit' => '周点击',
    'monthvisit' => '月点击',
    'allvisit' => '总点击',
    'marknum' => '收藏数',
    'votenum' => '推荐数',
    'downnum' => '下载数',
  ),
  'cron_power' => '1',
  'tkd_index' => 
  array (
    'title' => '高质量小说在线免费阅读及TXT下载 - 在线听书 - {$pt.config.sitename}',
    'keywords' => '{$pt.config.sitename},在线听书,阅读搜索网,txt全集下载,小说下载',
    'description' => '{$pt.config.sitename}专注于网络各类型小说搜索,在线阅读,在线免费听书,txt小说下载,提供最全的网络小说并保持最快的更新和txt全集下载、zip打包全集下载,方便大家愉快地阅读和听书。',
  ),
  'tkd_category' => 
  array (
    'title' => '{$category.name}小说_小说分类_{$pt.config.sitename}',
    'keywords' => '{$category.name},{$pt.config.sitename}',
    'description' => '{$pt.config.sitename}专注于{$category.name}小说搜索,在线阅读,提供最全的小说保持最快的更新,方便大家愉快地阅读{$category.name}小说',
  ),
  'tkd_top' => 
  array (
    'title' => '小说{$top.name}榜_{$pt.config.sitename}',
    'keywords' => '{$top.name},小说排行榜,{$pt.config.sitename},{$pt.config.sitename}',
    'description' => '{$pt.config.sitename}小说排行榜提供最新、流行、经典、精品原创小说排行榜，包括：奇幻小说排行榜,武侠小说排行榜,言情小说排行榜,都市小说排行榜,历史小说排行榜,军事小说排行榜,科幻小说排行榜,网游小说排行榜,灵异小说排行榜,竞技小说排行榜,同人小说排行榜，全本小说排行榜',
  ),
  'tkd_info' => 
  array (
    'title' => '{$novel.name}章节_{$novel.name}TXT下载_{$author.name}作品_{$category.name}小说_{$pt.config.sitename}',
    'keywords' => '{$novel.name}最新章节列表,{$novel.name}TXT下载,{$novel.name}章节目录,{$author.name}作品,{$category.name},{$pt.config.sitename}',
    'description' => '{$pt.config.sitename}提供{$category.name}小说《{$novel.name}》最新章节阅读和{$novel.name}TXT下载及zip打包下载，更新超级快，无病毒无木马，页面干净清爽，希望大家收藏!',
  ),
  'tkd_dir' => 
  array (
    'title' => '{$novel.name}最新章节目录 - {$novel.name} {$sitename} - {$pt.config.sitename}',
    'keywords' => '{$novel.name}最新章节,{$novel.name} {$sitename}',
    'description' => '{$pt.config.sitename}提供《{$novel.name}》在“{$sitename}”的最新章节目录的索引，更新超级快，无病毒无木马，页面干净清爽，希望大家收藏!',
  ),
  'tkd_author' => 
  array (
    'title' => '{$author.name}作品集_{$author.name}作品下载_{$pt.config.sitename}',
    'keywords' => '{$author.name},{$author.name}作品集,{$author.name}作品下载,{$pt.config.sitename}',
    'description' => '{$pt.config.sitename}专注于{$author.name}作品在线阅读,提供最全的{$author.name}小说作品并保持最快的更新,方便大家愉快地阅读{$author.name}小说作品！',
  ),
  'tkd_chapterlist' => 
  array (
    'title' => '{$novel.name}最新章节_{$novel.name}最新来源{$sitename}_{$author.name}作品_{$category.name}小说_{$pt.config.sitename}',
    'keywords' => '{$novel.name}最新章节,{$novel.name} {$sitename} ,{$pt.config.sitename},{$novel.name}在线阅读',
    'description' => '{$pt.config.sitename}提供《{$novel.name}》最新章节的搜索和阅读，更新超级快，无病毒无木马，页面干净清爽，希望大家收藏!',
  ),
  'tkd_frame' => 
  array (
    'title' => '{$novel.name}_{$chapter.name}_{$author.name}作品_{$category.name}小说_{$pt.config.sitename}',
    'keywords' => '{$novel.name},{$novel.name}最新章节,{$chapter.name},{$author.name},{$pt.config.sitename}',
    'description' => '{$pt.config.sitename}提供《{$novel.name}》最新章节《{$chapter.name}》在线阅读！',
  ),
  'tkd_page' => 
  array (
    'title' => '{$name}_{$pt.config.sitename}',
    'keywords' => '{$name},{$pt.config.sitename}',
    'description' => '{$pt.config.sitename}专注于最新各类网络小说搜索,在线阅读,提供最全的小说保持最快的更新,方便大家愉快地阅读各类网络小说',
  ),
  'tkd_search' => 
  array (
    'title' => '搜索“{$searchkey}”的结果_{$pt.config.sitename}',
    'keywords' => '{$searchkey}搜索,搜小说,搜作者,小说搜索,{$pt.config.sitename}',
    'description' => '搜索最新最快原创小说,搜索您最喜爱的小说,尽在{$pt.config.sitename}！',
  ),
  'tkd_go' => 
  array (
    'title' => '{$chapter.name}',
    'keywords' => '',
    'description' => '',
  ),
  'rewritepower' => '1',
  'db_type' => 'mysql',
  'read_type2' => 'frame',
  'tkd_green' => 
  array (
    'title' => '{$novel.name}_{$chapter.name}_{$author.name}作品_{$category.name}小说_ {$pt.config.sitename}',
    'keywords' => '{$novel.name},{$novel.name}最新章节,{$chapter.name},{$author.name},{$pt.config.sitename}',
    'description' => '{$pt.config.sitename}提供《{$novel.name}》最新章节《{$chapter.name}》在线阅读！',
  ),
  'wap_theme' => '360xiankan',
  'wap_domain' => 'http://m.danmeixsw.cn',
  'wap_type' => '2',
  'tpl_protect' => 'gook',
  'tkd_read' => 
  array (
    'title' => '{$novel.name}_{$chapter.name}_{$author.name}作品_{$category.name}小说_在线听{$novel.name}_在线听书_{$pt.config.sitename}',
    'keywords' => '在线听{$novel.name},在线听{$novel.name}最新章节,{$chapter.name},{$author.name},{$pt.config.sitename}',
    'description' => '{$pt.config.sitename}提供《{$novel.name}》最新章节《{$chapter.name}》在线阅读及在线听书！',
  ),
  'resurl' => '',
  'cronurl' => 'http://danmeixsw.cn',
  'collect_cover_save' => '1',
  'greenread_showtype' => '1',
  'chapter_path' => '@/data/',
  'chapter_cache_power' => '0',
  'chapter_show_type' => '0',
  'greenread_errormsg' => '转码失败！请您使用右上换源切换源站阅读或者直接前往源网站进行阅读！',
  'collect_skip_novel' => '',
  'content_replace' => '',
  'collect_over_caption' => '完结|结束|完本|完成|已完成|已完结|1',
  'pagesize_over' => '30',
  'readend_type' => '1',
  'apiurl' => '',
  'tkd_over' => 
  array (
    'title' => '全本小说_完结小说_完结小说排行榜_{$pt.config.sitename}',
    'keywords' => '完结小说,全本小说,完结小说下载,完结小说排行榜,{$pt.config.sitename}',
    'description' => '{$pt.config.sitename}提供全本完结玄幻小说，全本完结修真小说，全本完结网游小说等，为读者打造全本完结小说排行榜，推荐好看的全本小说。更新快，无广告。',
  ),
  'tkd_readend' => 
  array (
    'title' => '{$novel.name}最新章节_{$category.name}{$novel.name}在线阅读_{$author.name}作品_{$category.name}小说_{$pt.config.sitename}',
    'keywords' => '{$novel.name}最新章节列表,{$novel.name},{$category.name},{$pt.config.sitename}',
    'description' => '{$pt.config.sitename}提供{$category.name}小说《{$novel.name}》最新章节的搜索，更新超级快，无病毒无木马，页面干净清爽，希望大家收藏!',
  ),
  'pagesize_dir_wap' => '50',
  'pinyin_uc_first' => '0',
  'tkd_categoryindex' => 
  array (
    'title' => '小说分类_{$pt.config.sitename}',
    'keywords' => '小说分类,{$pt.config.sitename}',
    'description' => '{$pt.config.sitename}专注于小说搜索及提供TXT下载,提供最全的小说保持最快的更新,方便大家愉快地阅读',
  ),
  'tkd_topindex' => 
  array (
    'title' => '小说排行榜_{$pt.config.sitename}',
    'keywords' => '小说排行榜,网络小说排行榜,{$pt.config.sitename}',
    'description' => '{$pt.config.sitename}小说排行榜提供最新、流行、经典、精品原创小说排行榜，包括：奇幻小说排行榜,武侠小说排行榜,言情小说排行榜,都市小说排行榜,历史小说排行榜,军事小说排行榜,科幻小说排行榜,网游小说排行榜,灵异小说排行榜,竞技小说排行榜,同人小说排行榜，全本小说排行榜',
  ),
  'tkd_searchindex' => 
  array (
    'title' => '搜索 - {$pt.config.sitename}',
    'keywords' => '搜索,{$pt.config.sitename}',
    'description' => '{$pt.config.sitename}专注于玄幻小说搜索,提供最全的小说保持最快的更新,方便大家愉快地阅读玄幻小说',
  ),
  'wap_tc2read' => '1',
  'collect_reorder' => '0',
  'url_down' => '/txt/{novelid}',
  'tkd_down' => 
  array (
    'title' => '{$novel.name}TXT下载_{$novel.name}ZIP打包下载_TXT全本下载_免费下载_{$pt.config.sitename}',
    'keywords' => '{$novel.name}TXT下载,{$novel.name}zip下载,在线阅读,{$pt.config.sitename}',
    'description' => '{$pt.config.sitename}提供{$category.name}小说《{$novel.name}》最新章节的搜索，更新超级快，无病毒无木马，页面干净清爽，希望大家收藏!',
  ),
);