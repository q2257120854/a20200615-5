{include file="public/head.tpl" hostname='服务器状态'}
{include file="alert.tpl"}
<script>
function stats(num) {
    jQuery.post('stats/'+num,'/', function(data) {
        jQuery("#mysqlver_"+num).html(data.mysqlver);
		jQuery("#load_"+num).html(data.load);
        jQuery("#uptime_"+num).html(data.uptime);
		jQuery("#zendver_"+num).html(data.zendver);
		jQuery("#phpver_"+num).html(data.phpver);
    },'json');
}
function port(num,port) {
    jQuery.post('port/'+num+'/'+port+'/','', function(data) {
        jQuery("#port_"+port+"_"+num).html(data);
    });
}
</script>
  <!-- Breadcrumps -->
  <div class="breadcrumbs">
    <div class="row">
      <div class="col-sm-6">
       <h5 class="c-card__title"></h5>
      </div>
    </div>
  </div>

  <!-- End of Breadcrumps -->
	
<div class="container-fluid u-pt-medium">
    <div class="page-content col-12">
        <div class="c-card u-mb-medium">
            <div class="c-card__head">
                 <h5 class="c-card__title">服务器实时状态</h5>

            </div>
            <div class="table-container clearfix">
                <div id="tableTicketsList_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                    <div class="listtable">
  
                        <table id="tableTicketsList" class="table table-list dataTable no-footer dtr-inline" aria-describedby="tableTicketsList_info" role="grid" style="width: 0px;">
                            <thead>
                                <tr role="row">
<tr class="odd">
				<th style="text-align: left; padding-left: 30px; width: 0px;" class="sorting">{$lang['服务器']}</th>
				<th>HTTP</th>
				<th>FTP</th>
				<th>PHP {$lang['版本']}</th>

				<th class="sorting_desc" style="width: 0px;">运行状态</th>
            </tr>
          </thead>
          <tbody>
            {foreach from=$servers item=server}
			<tr>
				<td>{$server['名称']}</td>
			        <td id="port_80_{$server['id']}"><img src="{$templatedir}/loadingsml.gif" alt="{$lang['加载中...']}" /></td>
			        <td id="port_21_{$server['id']}"><img src="{$templatedir}/loadingsml.gif" alt="{$lang['加载中...']}" /></td>
			   <td><a href="{if $server['服务器状态地址']!=''}{$server['服务器状态地址']}?action=phpinfo{else}javascript:;{/if}" target="_blank">推荐5.6</a></td>
					<td><a href="{if $server['服务器状态地址']!=''}{$server['服务器状态地址']}?action=phpinfo{else}javascript:;{/if}" target="_blank">运行中</a></td>
					<script>port({$server['id']},80);port({$server['id']},21);stats({$server['id']});</script>
		        </tr>
{/foreach}
            
          </tbody>
        </table>
 <div class="text-center hidden" id="tableLoading">
                    <p><i class="fa fa-spinner fa-spin"></i> 加载中...</p>
                </div>
      </div>
	
    </div>
  </div>

{include file="public/foot.tpl"}
 