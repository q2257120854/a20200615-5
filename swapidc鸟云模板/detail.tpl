{include file="public/head.tpl" hostname='产品详情管理'}
<style>
    .cpclud{
        margin-bottom: 10px;
        width: 100%;
        padding:10px 5px;
        background-color: #FFF;
        border: 1px solid #e6eaee;
    }
    .cpclud span{
        font-weight: 600;
        margin-right: 5px;
    }
    .cpclud>p{
        border-bottom: 1px solid #e6eaee;
        line-height: 35px;
        padding: 5px;
    }
    .cpbtn{
        margin: 10px;
    }
    .cpbtn .btn{
        margin-bottom: 5px;
    }
</style>


<script language="javascript" type="text/javascript">
    ;(function($) {
        $(function() {
            $('#anpass').bind('click', function(e) {
                if(confirm("{$mlang['重置密码提示']}")){
				$('#formrepass').submit();
				}
            });
        });
		/**{if $goods['允许用户自己停止']}**/
        $(function() {
            $('#anstop').bind('click', function(e) {
                if(confirm("{$lang['如果您的产品出现问题,或者不想使用服务了,可以选择停止产品并取消服务,但是这个操作不能逆转,并且将不返还任何预存款!!']}")){
				$('#formrestop').submit();
				}
            });
        });/**{/if}**/

	})(jQuery);
</script>

<div class="container-fluid u-pt-medium">
    <form action="repass/" id="formrepass" method="post"></form>  		  
{if $goods['允许用户自己停止']}<form action="stop/" id="formrestop" method="post"></form>{/if}
    <div class="row">
        <!-- Container for main page display content -->
        <div class="page-content col-12">
            <div class="c-card u-mb-medium">
                <div class="c-card__head">
                     <h5 class="c-card__title">产品详情单</h5>

                </div>
                <div class="u-p-medium">
                    <div class="row">
                        
                        
                        <div class="col-sm-8">
                                <label for="paymentmethod" class="control-label">详情信息:</label>
                                <div class="cpclud">
                                    {if $server['密码']!=''}
                                    <p>&nbsp;<span>{$lang['用户名']}:</span>{$server['用户名']}</p>
                                    <p>&nbsp;<span>{$lang['密码']}:</span>{$server['密码']}</p>
                                    {/if}
                                    
                                    <p>&nbsp;<span>{$lang['产品名称']}:</span>{$goods['名称']}</p>

                                    {if $server['ip地址']!=''}
                                    <p>&nbsp;<span>{$lang['IP解析']}:</span>{$server['ip地址']}</p>
                                    {/if}
                                    
                                    {if $server['专用IP']!=''}
                                    <p>&nbsp;<span>{$lang['专用IP']}:</span>{$server['专用IP']}</p>
                                    {/if}
                                    
                                    {if $server['指定IP']!=''}
                                    <p>&nbsp;<span>{$lang['指定IP']}:</span>{$server['指定IP']}</p>
                                    {/if}
                                    
                                    
                                    {if $server['DNS服务器1']!='' or $server['DNS服务器2']!='' or $server['DNS服务器3']!='' or $server['DNS服务器4']!='' or $server['DNS服务器5']!=''}
                                    <p>&nbsp;<span>{$lang['DNS解析(NS)']}:</span>
                                    {if $server['DNS服务器1']!=''}{$server['DNS服务器1']}{/if}
                        			{if $server['DNS服务器2']!=''}<br>{$server['DNS服务器2']}{/if}
                        			{if $server['DNS服务器3']!=''}<br>{$server['DNS服务器3']}{/if}
                        			{if $server['DNS服务器4']!=''}<br>{$server['DNS服务器4']}{/if}
                        			{if $server['DNS服务器5']!=''}<br>{$server['DNS服务器5']}{/if}
                                    </p>
                                    {/if}
                                    
                                    <p>&nbsp;<span>{$lang['价格 / 周期']}:</span>
                                    {if is_array($server['周期'])}
                        			{$server['周期']['名称']} {$server['周期']['价格']}{$c['交易币名称']}/{$server['周期']['时间']}天
                        			{else}
                        				{$goods['价格']}{if $goods['价格']!='免费'} {$c['交易币名称']}{/if} / {$server['周期']}
                        			{/if}
                                    </p>
                                    
                                    {if $server['开通时间']!=''}
                                    <p>&nbsp;<span>{$lang['开通时间']}:</span>{$server['开通时间']}</p>
                                    {/if}
                                    
                                    {if $server['到期时间']!=''}
                                    <p>&nbsp;<span>{$lang['到期时间']}:</span>{$server['到期时间']}</p>
                                    {/if}
                                    
                                    {foreach from=$options item=option}
                                    <p>&nbsp;<span>$option['名称']}:</span>{$option['值']}</p>
                                    {/foreach}
                                    
                                    {foreach from=$configs item=config}
                                    <p>&nbsp;<span>{$config['名字']}:</span>{$config['内容']}</p>
                                    {/foreach}
                                    
                                    <p>&nbsp;<span>{$lang['续期产品']}:</span>
                                    {if !$goods['禁止续费'] && $server['周期']!='一次性'}
                                    
                                    {if !is_array($goods['周期'])}
                                    {if $goods['价格']!='免费'}{$lang['您目前拥有预存款']} {$s['登陆预存款']} {$c['交易币名称']}{$lang['，最多可以激活该产品']} {$payday} /{$goods['周期']}{else}{$lang['免费产品会自动帮你续期到目前最大的时间!!']}{if $goods['周期']=='日付'}{$lang['30日']}{elseif $goods['周期']=='月付'}{$lang['1月']}{elseif $goods['周期']=='年付'}{$lang['1年']}{/if}{/if}{else}{$lang['您目前拥有预存款']} {$s['登陆预存款']} {$c['交易币名称']}{/if}
                                    
                                    {else}
                        			{$mlang['该产品禁止续费']}
                        		    {/if}
                            		
                                    </p>
                                    
                                    <p>&nbsp;<span>{$lang['状态']}:</span>
                                    <!-- {if $server['状态']=='激活'} -->
                					<a class="btn btn-success btn-xs">{$lang['激活']}</a>
                					<!-- {elseif $server['状态']=='等待审核'} -->
                					<a class="btn btn-info btn-xs">{$lang['等待审核']}</a>
                					<!-- {elseif $server['状态']=='暂停'} -->
                					<a class="btn btn-warning btn-xs">{$lang['暂停']}</a>
                					<!-- {elseif $server['状态']=='停止'} -->
                					<a class="btn btn-info btn-xs" style="background-color: #b94a48;color: #FFF;">{$lang['停止']}</a>
                					<!-- {elseif $server['状态']=='驳回'} -->
                					<a class="btn btn-info btn-xs" style="background-color: #333333;color: #FFF;">{$lang['驳回']}</a>
                					<!-- {elseif $server['状态']=='等待付款'} -->
                					<a class="btn btn-default btn-xs">{$lang['等待付款']}</a>
                					<!-- {else} -->
                					<a class="btn btn-info btn-xs">{$server['状态']}</a>
                			        <!-- {/if} -->
                                    </p>
                                    
                                    
                                    
                                    
                                </div>
   
                        </div>
                        
                        
                        
        <div class="col-sm-4">
            <label for="paymentmethod" class="control-label">产品操作</label>
            
            <div menuitemname="Add Funds" class="panel panel-sidebar panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="fa fa-calendar-o"></i>&nbsp;订单备注
                        <i class="fa fa-chevron-up panel-minimise pull-right minimised"></i>
                    </h3>
                </div>
                <div class="panel-body" style="display: block;">{$server['注释']}</div>
            </div>
                        <div menuitemname="Add Funds" class="panel panel-sidebar panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="fa fa-bell"></i>&nbsp;插件公告
                        <i class="fa fa-chevron-up panel-minimise pull-right minimised"></i>
                    </h3>
                </div>
                <div class="panel-body" style="display: block;"><p id="nr">{$tempsz['产品详请页面公告']}</p></div>
            </div>
            <div class="panel">
                <div class="cpbtn">
                    {if $goods['开启升级选项'] && $server['周期']!='一次性'}<a href="{$ROOT}/control/package/{$server['id']}/" class="btn btn-warning btn-block">{$lang['升级/降级产品']}</a>
                    {/if}
                    
                    
                    {if $goods['允许用户自己停止']}<input type="submit"  class="btn btn-danger btn-block" id="anstop" value="{$lang['停止/取消服务']}">{/if}
                    
                    <input type="submit"  class="btn btn-warning btn-block" value="{$lang['重置产品密码']}"  id="anpass">
                    

                    {if !$goods['禁止续费'] && $server['周期']!='一次性'}
                    
                        <form action="pay/" method="post">
                            {if is_array($goods['周期'])}
                				<select name="cycleid">
                				{foreach $goods['可续期周期'] as $num=>$row nocache}
                					<option value="{$num}">{$row['名称']} {$row['价格']}{$c['交易币名称']}/{$row['时间']}天</option>
                				{foreachelse}
                					无法续费
                				{/foreach}
                				</select>
                            {else}
                            
                            
                            {if $goods['价格']!='免费'}
            	            {$mlang['续费时长']}:<input name="day" value="1" type="text"  id="inputDay" onkeyup="this.value=this.value.replace(/\D|^0/g,'')" />
            			    {if $goods['周期']=='日付'}/{$mlang['日']}
            				{elseif $goods['周期']=='月付'}/{$mlang['月']}
            				{elseif $goods['周期']=='年付'}/{$mlang['年']}{/if}
            			    {/if}
            			
            			    {/if}
            			    <input type="submit"  class="btn btn-success btn-block"  value="{$lang['续期']}">

                        </form>    
			         
		            {/if}
		            
		            
		            <button data-toggle="dropdown" class="btn dropdown-toggle btn-block" style="background: #4B77BE;color: #FFF;">{$lang['前往控制面板']}  <a class="caret"></a></button>
	                <ul class="dropdown-menu" style="width:230px">
                    {foreach from=$logins item=login}
                        <li style="">{$login}</li>
                    {/foreach}
                    </ul>
                    {foreach from=$barray key=bname item=bfunction}
                    	<a href="action/{$bfunction}/" class="btn">{$bname}</a>
                    {/foreach}
                    
                    
                    
                </div>                
            </div>
                            
                            
                            
                            
                            
                            
            
            
        </div>
                        
                        
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- /.main-content -->
        
    </div>
</div>
<style>
#nr{
    font-size:15px;
    margin: 0;
    background: -webkit-linear-gradient(left,
        #ffffff,
        #ff0000 6.25%,
        #ff7d00 12.5%,
        #ffff00 18.75%,
        #00ff00 25%,
        #00ffff 31.25%,
        #0000ff 37.5%,
        #ff00ff 43.75%,
        #ffff00 50%,
        #ff0000 56.25%,
        #ff7d00 62.5%,
        #ffff00 68.75%,
        #00ff00 75%,
        #00ffff 81.25%,
        #0000ff 87.5%,
        #ff00ff 93.75%,
        #ffff00 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-size: 200% 100%;
    animation: masked-animation 3s infinite linear;
}
@keyframes masked-animation {
    0% {
        background-position: 0 0;
    }
    100% {
        background-position: -100%, 0;
    }
}
</style>
{include file="public/foot.tpl"}