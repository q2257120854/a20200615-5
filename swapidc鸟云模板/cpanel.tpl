{include file="public/head.tpl" hostname='服务管理'}

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
</style>




<div class="container-fluid u-pt-medium">

<div class="row">
    
    {foreach from=$servers item=server}
    <div class="col-ms-3 col-md-4">
        <div class="cpclud">
            <p>&nbsp;<span>域名:</span><a href="{$ROOT}/control/invoice/{$server['id']}/" class="btn btn-link">{if $server['域名']=='无需主域名'}{$server['用户名']}{else}{$server['域名']}{/if}</a></p>
            
            <p>&nbsp;<span>类型:</span>{$server['产品类型']}</p>
            
            <p>&nbsp;<span>状态:</span>
            <!-- {if $server['状态']=='激活'} -->
					<a class="btn btn-success btn-sm">{$lang['激活']}</a>
					<!-- {elseif $server['状态']=='等待审核'} -->
					<a class="btn btn-info btn-sm">{$lang['等待审核']}</a>
					<!-- {elseif $server['状态']=='暂停'} -->
					<a class="btn btn-warning btn-sm">{$lang['暂停']}</a>
					<!-- {elseif $server['状态']=='停止'} -->
					<a class="btn btn-info btn-sm" style="background-color: #b94a48;color: #FFF;">{$lang['停止']}</a>
					<!-- {elseif $server['状态']=='驳回'} -->
					<a class="btn btn-info btn-sm" style="background-color: #333333;color: #FFF;">{$lang['驳回']}</a>
					<!-- {elseif $server['状态']=='等待付款'} -->
					<a class="btn btn-default btn-sm">{$lang['等待付款']}</a>
					<!-- {else} -->
					<a class="btn btn-info btn-sm">{$server['状态']}</a>
			<!-- {/if} -->
            </p>
            
            <p>&nbsp;<span>开通时间:</span>{$server['开通时间']}</p>
            
            <p>&nbsp;<span>到期时间:</span>
            {$server['到期时间']}({if is_array($server['周期'])}{$server['周期']['名称']}{else}{$server['周期']}{/if})
            </p>
            
            
            
            <p>&nbsp;<span>备注:</span>{$server['注释']}</p>
            
            <div style="margin-top:10px"> 
						{if $server['状态']=='等待付款'}
						  <a href="{$ROOT}/control/invoice/{$server['id']}/" class="btn btn-primary btn-block">{$lang['订单']}</a>
						{else} 
			              <a href="{$ROOT}/control/detail/{$server['id']}/" class="btn btn-{if $server['状态']!='激活' and $server['状态']!='暂停'}primary{else}success{/if} btn-block">{$lang['管理']}</a>
						{/if}
			</div>
        </div>
    </div>
    {/foreach}
    
    
    

    
</div>    
    
    
    
    
</div>
{include file="public/foot.tpl"}