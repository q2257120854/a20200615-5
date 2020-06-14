{include file="public/head.tpl" hostname='用户后台'}

          
<div class="container-fluid u-pt-medium">
    
<div class="c-card c-overview-card u-p-medium u-mb-medium">
    <div class="row">
        <div class="col-6 col-md-3 u-border-right">
            <div class="c-overview-card__section u-text-center">
                <a style="width: 70px;margin: 0 auto;" class="c-avatar u-mb-small" href="clientarea.php?action=details">
					<img class="c-avatar__img" src="//q1.qlogo.cn/g?b=qq&nk={$s['登陆邮编']}@qq.com&s=100" alt="" />
				</a>
				<div class="user-name u-mb-small">
				                        <span class="text-primary">UID:{$s['登陆UID']}</span>
									</div>
				<div class="row">
					<div class="col-12">
						<a href="{$ROOT}/user/info/" class="btn btn-sm btn-qqbinds"><i class="fa fa-user"></i>&nbsp;修改资料</a>
					</div>
				</div>
            </div>
        </div>
		
        <div class="col-6 col-md-3 u-border-right">
            <div class="c-overview-card__section">
                <p class="u-text-mute u-nospace u-mb-small">可用余额</p>
                <h3 class="u-nospace u-mb-medium">{$s['登陆预存款']}&nbsp;{$c['交易币名称']}</h3>
									<a class="c-btn c-btn--small c-btn--success" href="{$ROOT}/user/pay/">账户充值</a>
								<!--<a class="c-btn c-btn--small c-btn--info" href="充值异常">充值异常</a>-->
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="c-overview-card__section">
                <p class="u-text-mute u-nospace u-mb-small">我的订单服务</p>
                <h3 class="u-nospace u-mb-medium" id="userfw">共有0个服务</h3>

                <a href="{$ROOT}/buy" target="_blank">继续购买</a>
&nbsp;&nbsp;
		<span class="user-opt-gap"></span>
				<a href="clientarea.php?action=domains">订单管理</a>
			</div>
        </div>

        <div class="col-6 col-md-3 u-border-left">
            <div class="c-overview-card__section">
	{include file="public/index.tpl" hostname='用户后台'}
	
	
                <p class="u-text-mute u-nospace u-mb-small">技术支持</p>
                <h3 class="u-nospace u-mb-medium"><p id="nr">QQ:11467102</p></h3>
	{include file="public/kf.tpl"}
                <a class="c-btn c-btn--small c-btn--info" href="{$ROOT}/ticket/submit/">提交工单</a>
<br/><br/>
	        <a class="c-btn c-btn--small c-btn--info" href="{$ROOT}/ticket/index/">我的工单</a>
            </div>
        </div>
    </div>

</div>

<div class="client-home-panels">
	
	<div class="row">
	    
		<div class="col-lg-6">
			<div class="u-flex u-justify-between">
    <h5 class="u-mb-small">我的服务</h5>
</div>

<div class="panel-cards panel-products c-card u-mb-medium cards-carousel">
            <ul class="cards">
            <li id="usercps">
               {foreach from=$items item=new}
                    <a class="card-row" href="{$ROOT}/control/invoice/{$new['id']}/">
	                    <span class="cell-title">{$new['用户名']}</span>
                        <span class="cell-cycle">
                        	<span class="text-muted"></span>
                        	
                        </span>
                                                <span class="cell-license">
                        	<span class="text-muted">到期: {$new['到期时间']}</span>
                        	
                        </span>
	                </a>
	           {/foreach}
	           
            </li>
            </ul>
        
    </div>
		</div>
	    
<div class="col-lg-6">
	<div class="u-flex u-justify-between">
        <h5 class="u-mb-small">站务公告</h5>
    </div>

<div class="panel-cards c-card u-mb-medium cards-carousel">
            <ul class="cards">
            <li>
                {foreach from=$news item=new}
                    <a class="card-row" href="{$ROOT}/index/announcement/{$new['公告ID']}/" target="_blank">
	                    <span class="cell-title">{$new['公告标题']}</span>
	                    <span class="cell-cycle pull-left">
	                    	<span class="text-muted">发布日期: </span>
	                    	{$new['公告时间']}
	                    </span>
	                </a>
	           {/foreach}
	           
            </li>
        </ul>
    </div>
	</div>
  </div>
</div>


</div>



<script>
            window.onload = function () {
            var usercps = document.getElementById("usercps");
            var usercps_s = usercps.getElementsByTagName("a");
            var usercpsl = usercps_s.length;
            var usercps = document.getElementById("userfw").innerHTML ='共有'+ usercpsl + "个服务";
            }
</script>
<style>
#nr{
    font-size:20px;
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









