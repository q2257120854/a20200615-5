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

<div class="container-fluid u-pt-medium">

<div class="row">
    
    <div class="col-ms-6 col-md-6">
        <div class="cpclud">
            <p>&nbsp;<span>{$mlang['产品名称']}:</span>{$cart['名称']}</p>
            
            <p>&nbsp;<span>{$mlang['产品库存']}:</span>{$lang['剩余']} {$cart['库存']} {$lang['个']}</p>
            
            <p>&nbsp;<span>{$mlang['产品价格']}::</span>{if $cart['价格']=='免费'}{$lang[$cart['价格']]}{else}{$cart['价格']} {$c['交易币名称']}{/if}</p>
            
            <p>&nbsp;<span>{$mlang['开通方式']}:</span>{$lang[$cart['开通方式']]}</p>
            
            <p>&nbsp;<span>{$mlang['产品描述']}:</span><br/>{$cart['描述']}</p>
            

        </div>
    </div>
    
    <div class="col-ms-6 col-md-6">
    
    
                             <div menuitemname="Add Funds" class="panel panel-sidebar panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="fa fa-bell"></i>&nbsp;页面公告
                        <i class="fa fa-chevron-up panel-minimise pull-right minimised"></i>
                    </h3>
                </div>
                <div class="panel-body" style="display: block;"><p id="nr">{$tempsz['产品订购页面公告']}</p></div>
            </div>
    
    
    
    
<div class="cpzf"> 
 <!--防止错了----> 
<form method="post" action="submit/"> 
 
 {if $cart['隐藏域名配置']!='1'} 
 
{if $cart['关闭自主域名']=='yes'}
<input type="hidden" name="domainoption" value="freedomain" id="seldomain" />
 <div class="accordion-example"><div id="example-tabs">
<div id="tab1" style="display:block;"><p><div id="freedomain" align="center">www. <input type="text" name="freedomain" size="40" value=""/> .<select name="freedomainhz" style="width:150px;">{foreach from=$freedomains item=freedomain}<option value="{$freedomain}">{$freedomain}</option>{/foreach}</select></div> </p></div>
                    </div>
                </div>

{else}<input type="hidden" name="domainoption" value="domain" id="seldomain" /> 

                <div class="accordion-example">
                    <div id="example-tabs">
                        <ul>
                            <li style="text-align: center; margin: 10px; color: #939393;"><b>请填写您的域名（后续可修改）</b></li>
                        {if $cart['显示域名选项']=='开'}
                            <li><a href="#tab2"  onclick="document.getElementById('seldomain').value='freedomain';">{$lang['您选择的产品/服务需要域名，请将域名填写在下面']}</a>
                            </li>{/if}
                           
                        
                        </ul>

                        <!-- 1st tab  -->
                        <div id="tab1">

                            <p><div id="domain" align="center">www.
				<input type="text" name="domain" size="40" value="" style="width:180px;height: 30px;display: inline-block;"  onclick="document.getElementById('seldomain').value='domain';" class="form-control"/>
				.
				<input type="text" name="domainhz" size="7" value="" style="width:40px;height: 30px;display: inline-block;"  onclick="document.getElementById('seldomain').value='domain';" class="form-control"/>
				</div> </p>

                        </div>
{if $cart['显示域名选项']=='开'}<div style="margin-top:10px; margin-bottom:10px"><p><div id="freedomain" align="center">www. <input type="text" name="freedomain" size="40" value=""   onclick="document.getElementById('seldomain').value='freedomain';"/> .<select name="freedomainhz" style="width:150px;">{foreach from=$freedomains item=freedomain}<option value="{$freedomain}">{$freedomain}</option>{/foreach}</select></div> </p></div>{/if}
                    </div>
                </div>
				{/if}
{/if}




<div class="spacing-20"></div>

<div class="row">
<div class="col-sm-7 center-block">
<ul class="display-list">
{foreach from=$buyoptions item=option}
	{if $option['Type']=='yesno'}
		<li>{$option['Name']} : <input name="buyoptions[{$option['Name']}]" type="radio" value="on" />{$mlang['开']} <input name="buyoptions[{$option['Name']}]" type="radio" value="0" checked />{$mlang['关']}</li>
	{elseif $option['Type']=='text'}
		<li>{$option['Name']} : <input type="text" name="buyoptions[{$option['Name']}]" size="{$option['Size']}"></li>
	{elseif $option['Type']=='dropdown'}
		<li>{$option['Name']} :<select name="buyoptions[{$option['Name']}]">{foreach from=$option['Options'] item=optsub}<option value="{$optsub}">{$optsub}</option>{/foreach}
				</select> </li>
	{/if}
{/foreach}
{foreach from=$options item=option}
	<li>{$option['名称']} :<select name="config[{$option['id']}]">{foreach from=$option['选项'] item=optsub}<option value="{$optsub['id']}">{$optsub['名称']}</option>{/foreach}</select></li>
{/foreach}
</ul>
</div>
</div>
<style>
    .display-list>li{
        margin: 10px 0;
    }
</style>
 

<div class="row">
<div class="col-sm-7 center-block">
<ul class="display-list" style="text-align: center;">
<li>{$lang['优惠码']}: <input class="choosecat form-control" style="height:30px;" type="text" name="promocode"  id="promocode" /><a class="btn btn-primary btn-sm" id="validatepromo">{$lang['验证 >>']}</a></li>

<li>{$lang['购买时间']}: {if is_array($cart['周期'])}
					<select name="cycleid" class="choosecat">
						{foreach $cart['周期'] as $num=>$row nocache}
							<option value="{$num}">{$row['名称']} {$row['价格']}{$c['交易币名称']}/{$row['时间']}天 {if $row['自动']}{$lang['自动开通']}{else}{$lang['审核开通']}{/if}</option>
						{foreachelse}
							无法购买
						{/foreach}
					</select>
{else}
					{if $cart['周期']!='一次性'}<input type="text" class="form-control" name="days" id="days" value="1" style="height:30px;"/> /{/if}{if $cart['价格']=='免费'}{$lang['免费']}{else}{$cart['价格']} {$c['交易币名称']}{/if}{$lang[$cart['周期']]} {$lang[$cart['开通方式']]}
{/if}</li>


<li>{$lang['预存款']}: <b>{$s['登陆预存款']} {$c['交易币名称']}</b></li>
<li>{$lang['总计']}: <b><a id="payall">{if $cart['价格']=='免费'}0{else}{$cart['价格']}{/if}</a> {$c['交易币名称']}</b></li>
<li>{$lang['备注/额外信息']}: <textarea name="notes" class="form-control" rows="2"  onFocus="if(this.value=='订单备注：...'){ this.value=''; }" onBlur="if (this.value==''){ this.value='订单备注：...'; }" placeholder="请输入订单备注（不能修改）">订单备注：...</textarea></a></li>
</ul>
</div>
</div>


<script language="javascript" type="text/javascript">

$("#validatepromo").click(function () {
$("#validatepromo").attr('class','btn  btn-default');
$("#validatepromo").html('{$lang['请稍后……']}');
$.ajax({
type:　"post",
url:　"/index.php/buy/promo/",
data:　"swap="+$("#promocode").val(),
success:　function (msg){
if(msg==='ok'){
$("#validatepromo").html('{$lang['优惠码有效']}');
$("#validatepromo").attr('class','btn  btn-default');
}else{
$("#validatepromo").html(msg);
$("#validatepromo").attr('class','btn  btn-primary');
}
},
error:　function (mag){
$("#validatepromo").html('{$lang['网络错误,重试']}');
$("#validatepromo").attr('class','btn  btn-primary');
},
});
});
</script>
 
<div class="bt-box">
	<a href="#" class="xiaoA bg-2" align="center"><input type="submit" class="btn btn-success"></a>


	<p class="top bt-box-p">站长技术交流学习</p>
	<p class="bottom bt-box-p">QQ群：878853008</p>
</div>
 
</form> 
</div><!--防止错了-->

    
    </div> 
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