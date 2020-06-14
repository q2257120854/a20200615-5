{if $s['是否已经登陆']=='是'}

			
 <div class="col-sm-4">
                <div class="sidebar">

                    <div class="widget">
                        <h3 class="badge">{$lang['UID']}:{$s['登陆UID']} - {$title}</h3>
                        <ul>
                            <li><a href="{$ROOT}/user/index/">{$lang['个人信息']}</a></li>
                            <li><a href="{$ROOT}/user/pay/">{$lang['账户充值']}</a></li>
                            <li><a href="{$ROOT}/user/password/">{$lang['修改密码']}</a></li>
                            <li><a href="{$ROOT}/control/index/">{$mlang['我的订单']}</a></li>
                            <li><a href="{$ROOT}/ticket/index/">{$mlang['工单系统']}</a></li>
                            {$plug['用户页面列表']}
                        </ul>
                    </div>




                   <!--  <div class="widget">
                        <h3 class="badge">ADVERTISEMENT</h3>
                        <a href=""><img src="images/theme_forest_300x250.jpg" alt="" />
                        </a>
                    </div> -->

                    <div class="widget">
                        <h3 class="badge">{$lang['快速导航']}</h3>
                        <ul>
                            <li><a href="{$ROOT}/index/index/">{$lang['客户中心']}</a></li>
                            <li><a href="{$ROOT}/control/index/"> {$lang['控制面板']}</a></li>
                            <li><a href="{$ROOT}/index/announcements/">{$lang['公告信息']}</a></li>
                            <li><a href="{$ROOT}/ticket/submit/">{$lang['提交服务单']}</a></li>
                            <li><a href="{$ROOT}/buy/index/"> {$lang['订购产品']}</a></li>
                        </ul>
                    </div>

                </div>

            </div>
{/if}