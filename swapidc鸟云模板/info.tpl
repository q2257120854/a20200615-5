{include file="public/head.tpl" hostname='修改资料'}
{include file="alert.tpl"}
<div class="container-fluid u-pt-medium">
    <div class="row">
        <!-- Container for main page display content -->
        <div class="page-content col-12">
            <div class="c-card u-mb-medium">
                <div class="c-card__head">
                     <h5 class="c-card__title">修改个人资料</h5>

                </div>
        
        <style>
            .bdys{
                padding: 10px;
            }
        </style>
        <form  method="post">
        <div class="bdys">
        <tr>
			<th>{$lang['姓名']}</th>
			<td><input class="form-control" name="name" type="text" value="{$s['登陆姓名']}"/></td>
		</tr>
		<tr>
			<th>{$lang['国家']}</th>
			<td><select class="form-control" name="country" id="country">
			  {foreach from=$countrys item=country}
			  <option value="{$country}"{if $s['登陆国家']==$country} selected="selected"{/if}>{$country}</option>
{/foreach}</select></td>
		</tr>
		<tr>
			<th>{$lang['地址']}</th>
			<td> <input class="form-control" name="address" type="text" value="{$s['登陆地址']}"/></td>
		</tr>
		<tr>
			<th>{$lang['邮编']}</th>
			<td><input class="form-control" name="zip" type="text" value="{$s['登陆邮编']}"/></td>
		</tr>
        <br>
		<tr>
			<td><button class="btn btn-primary">{$lang['修改个人信息']}</button></td>
		</tr>
        </div>
        </form>
                
                
        </div>
        </div>
        <!-- /.main-content -->
        
    </div>
</div>
{include file="public/foot.tpl"}


