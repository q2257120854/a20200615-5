{include file="header.tpl" navxz='' title=$lang['网络故障'] hostname=$c['网站名称']}{include file="alert.tpl"}
     <!-- Breadcrumps -->
    <div class="breadcrumbs">
        <div class="row">
            <div class="col-sm-6">
                <h1>{$lang['网络故障']}</h1>
            </div>

        </div>
    </div>
    <!-- End of Breadcrumps -->

    <section class="faq">


        <div class="row spacing-40">
            <div class="col-sm-12">
                <div class="faq-questions">
                  <!-- <h3>有什么问题么?</h3> -->
<style type="text/css">
#badgea a:hover, #badgea a:active, #badgea a:focus {
outline: 0;
text-decoration: none;
color: #F2F2F2;
}
#badgea a{ color: #FFFFFF;
outline: 0;
text-decoration: none;}

</style>
			<h3 align="center" class="badge" id="badgea" style="background-color: #72AE95;">
		  <a href="{$ROOT}/networkissues/index/1/"><span class="badge" style="background: #DE6262;">{$e['开放的数量']}</span>{$lang['开放']}</a>  | 
		  <a href="{$ROOT}/networkissues/index/2/"><span class="badge" style="background: #000000;">{$e['计划中的数量']}</span>{$lang['计划中']}</a> | 
		  <a href="{$ROOT}/networkissues/index/3/"><span class="badge" style="background: #5CB85C;">{$e['已解决的数量']}</span>{$lang['已解决']}</a>
          </h3>

                    <div id="accordion" class="panel-group spacing-40">
{foreach from=$net item=n}
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse{$n['id']}">{$n['标题']}({$n['状态']})</a></h4>
                                
                            </div>

                            <div id="collapse{$n['id']}" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <p><h6>{$lang['影响的服务']} - {$n['受到影响的服务']} | {$lang['优先级']} -{$n['优先级']}</h6></p>
                                    <p><h6>{$lang['日期']} - {$n['时间']}</h6></p>
                                    <p><h6>{$lang['最近更新']} - {$n['最近更新']}</h6></p>
									<hr>
                                    <p>{$n['内容']}</p>
                                </div>
                            </div>
                        </div>
{/foreach}
               
			   
                    </div>

                </div>
				
				
				<div class="col-sm-12 wow fadeInRight r-tabs">
<br><br>				
          <ul class="r-tabs-nav">

<li class="r-tabs-tab r-tabs-state-{if $t['当前页数']=='1'}default{else}active{/if}" style="padding: 0 0 0 0;"><a href="{$t['上一页连接']}" class="r-tabs-anchor">{$lang['上一页']}</a></li>
<li class="r-tabs-tab r-tabs-state-default" style="padding: 0 0 0 0;"><a  class="r-tabs-anchor">{$lang['总共']}:{$t['总页数']}{$lang['页']} {$lang['当前']}:{$t['当前页数']}{$lang['页']}</a></li>
<li class="r-tabs-tab r-tabs-state-{if $t['当前页数']==$t['总页数']}default{else}active{/if}" style="padding: 0 0 0 0;"><a href="{$t['下一页连接']}" class="r-tabs-anchor">{$lang['下一页']}</a></li>
          </ul><br><br>
    </div>
				
				
            </div>

        </div>
    </section>


   


{include file="footer.tpl"}