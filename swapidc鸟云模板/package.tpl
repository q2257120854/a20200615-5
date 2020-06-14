{include file="header.tpl" navxz='5' title=$lang['升级/降级产品'] hostname=$c['网站名称']}{include file="alert.tpl"}
  <!-- Breadcrumps -->
  <div class="breadcrumbs">
    <div class="row">
      <div class="col-sm-6">
        <h1>{$lang['升级/降级产品']}</h1>
      </div>
    </div>
  </div>

  <!-- End of Breadcrumps -->
	
<div class="servers-table">
    <div class="row">
      <div class="col-sm-12">

	<a href="{$ROOT}/control/index/" class="btn btn-primary">{$mlang['返回到我的订单']}</a>

	  <br>
	  <br>
	  <form action="submit/" class="form-horizontal" method="post">

        <table  class="products-table responsive wow fadeInUp tablesaw tablesaw-stack" >

		
			 <thead>
	    <tr>
	      <td>
		  {foreach from=$packages item=package}
								
								<p>  <input type="radio" name="upid" value="{$package['id']}" checked />
								  <b style="font-size: 17px;color: #5a5a5a;font-family: 'montserrat', Optima, Segoe, 'Segoe UI', Candara, Calibri, Arial, sans-serif;font-weight: 700;line-height: 1.1;margin-bottom: 12px;margin-top: 12px;text-rendering: optimizelegibility;">{$package['名称']}</b> <a>{$package['价格']} {$c['交易币名称']} / {$package['周期']}</a>
								({$lang['升级为该产品，您将消耗预存款']} {$package['消耗预存款']} {$c['交易币名称']}{$lang['。您共有']}{$s['登陆预存款']} {$c['交易币名称']}{$lang['，还差']}{$package['不足预存款']} {$c['交易币名称']})</p>
{/foreach}
		  
		  
		  </td>
	    </tr>
		<tr>
	      <td>
		  
		  <button type="submit" data-loading-text="{$lang['提交中...']}" class="btn btn-primary">{$lang['提交']}</button>
		  
		  </td>
	    </tr>

	  
	  </thead>
        </table></form>
      </div>
			


	
	
    </div>
  </div>

 
{include file="footer.tpl"}