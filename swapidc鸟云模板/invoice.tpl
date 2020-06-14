{include file="public/head.tpl" hostname='订单管理'}

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
    .cpzf{
        border-bottom: 1px solid #e6eaee;
        background: #FFF;
        padding: 10px;
    }
</style>

<script language="javascript" type="text/javascript">
function daydd() {
$("#daysst").attr('class','btn btn-default btn-xs');
$("#daysst").html('{$lang['请稍后……']}');
$.ajax({
type:　"post",
url:　"/index.php/buy/rate/",
data:　"cartid={$goods['id']}&days="+$("#days").val(),
success:　function (msg){
$("#payall").html(msg);
$("#daysst").html('{$lang['计算价格 >>']}');
$("#daysst").attr('class','btn btn-primary btn-xs');
},
error:　function (mag){
$("#daysst").html('{$lang['网络错误,重试']}');
$("#daysst").attr('class','btn btn-primary btn-xs');
},
});
};
</script>


<div class="container-fluid u-pt-medium">

<div class="row">
    
    <div class="col-ms-6 col-md-6">
        <div class="cpclud">
            <p>&nbsp;<span>{$lang['已创建您的账单 编号']}：{$server['id']}</span></p>
            
            <p>&nbsp;<span>{$lang['账单日期']}:</span>{$server['申请时间']}</p>
            
            <p>&nbsp;<span>{$lang['产品类型']}	:</span>{$goods['名称']}</p>
            
            <p>&nbsp;<span>{$lang['产品价格']}:</span>{$goods['价格']}{if $goods['价格']!='免费'} {$c['交易币名称']}{/if}</p>
            
            <p>&nbsp;<span>{$lang['付款周期']}:</span>{$goods['周期']}</p>
        </div>
    </div>
    
    <div class="col-ms-6 col-md-6">
    
    <div class="cpzf">   
    <form name="pay" method="post" action="{$ROOT}/control/pay/{$server['id']}/">    
        <div>
                {if is_array($goods['周期'])}
					<select name="cycleid" class="choosecat">
						{foreach $goods['周期'] as $num=>$row nocache}
							<option value="{$num}">{$row['名称']} {$row['价格']}{$c['交易币名称']}/{$row['时间']}天 {if $row['自动']}{$lang['自动开通']}{else}{$lang['审核开通']}{/if}</option>
						{foreachelse}
							无法购买
						{/foreach}
					</select>
                {else} 
					{if $goods['周期']!='一次性'}<input type="text" name="days" id="days" value="1" class="form-control" /> 
					<br/><b>开通方式：</b>{/if}{if $goods['价格']=='免费'}{$lang['免费']}{else}{$goods['价格']} {$c['交易币名称']}{/if}{$lang[$goods['周期']]} {$lang[$goods['开通方式']]}
                {/if}
        </div>
        <div style="margin:10px 0">
            <b>{$lang['当前预存款']}:</b>&nbsp;<b style="color:#09F">{$s['登陆预存款']}</b>&nbsp;<b>{$c['交易币名称']}</b>
        </div>
        
        <div>
            <b>{$lang['金额总计']}:</b> <b>&nbsp;<a id="payall">{if $goods['价格']=='免费'}0{else}{$goods['价格']}{/if}</a> {$c['交易币名称']}<div onclick="daydd()" id="daysst" align="center" valign="middle"  class="btn btn-primary btn-xs" style="margin-left:10px">{$lang['计算价格']}
        </div>
        
        <br/>
        <p align="center"><input type="submit" class="btn btn-success btn-block" value="{$lang['支付']}" onclick="this.value='{$lang['请稍后……']}'" style="margin-top:10px"></p>
        
    </div>
    </form>
    
    </div> 
</div>    
    
    
    
    
</div>
{include file="public/foot.tpl"}