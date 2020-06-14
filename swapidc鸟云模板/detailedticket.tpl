{include file="public/head.tpl" hostname='我的工单详情'}

<div class="container-fluid u-pt-medium">
    <div class="page-content col-12">
        <div class="c-card u-mb-medium">
            <div class="c-card__head">
                 <h5 class="c-card__title">我的工单详情<br/>{$tempsz['工单界面公告']}</h5>

            </div>
            <div class="table-container clearfix">
                <div id="tableTicketsList_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                    <div class="listtable">
  
                        <table id="tableTicketsList" class="table table-list dataTable no-footer dtr-inline" aria-describedby="tableTicketsList_info" role="grid" style="width: 0px;">
                            <thead>
                                <tr role="row">
                                    <th style="text-align: left; padding-left: 30px; width: 0px;" class="sorting">{$lang['提交时间']}</th>
                                    
                                    <th class="sorting"  style="width: 0px;">主题</th>
                                    <th class="sorting"  style="width: 0px;">状态</th>
                                    <th class="sorting_desc" style="width: 0px;">最后回复时间</th>
                                </tr>
                            </thead>
                            <tbody>
                                    
                    				<tr class="odd">
                                      <td><i class="fa fa-calendar"></i>&nbsp;<a href="{$ROOT}/ticket/detailed/{$ticket['id']}/">{$t['提交时间']}</a></td>
                                       <td><a href="{$ROOT}/ticket/detailed/{$ticket['id']}/">{$t['主题']} </a></td>
                                      <td><a href="{$ROOT}/ticket/detailed/{$ticket['id']}/">{$lang[$t['状态']]}</a></td>
                                      <td><i class="fa fa-calendar"></i>&nbsp;<a href="{$ROOT}/ticket/detailed/{$ticket['id']}/">{$t['最后时间']}</a></td>
                                    </tr>
                    				
                    				
                            </tbody>
                        </table>
                    </div>
                    
                </div>
                <div class="text-center hidden" id="tableLoading">
                    <p><i class="fa fa-spinner fa-spin"></i> 加载中...</p>
                </div>
            </div>
        </div>
    </div>
</div>





<div class="container-fluid u-pt-medium">
    {foreach from=$tks item=tk}
    <div class="page-content col-12">
        <div class="c-card u-mb-medium">
            <div class="c-card__head">
                <h5 class="c-card__title">
                    {if $tk['回复类型']=='1'}用户:<font color="#04B4AE">{$tk['名字']}</font><br/> (ID: {$tk['用户id']}){/if}
                    {if $tk['回复类型']=='2'}客服:<b id="nr">{$tk['名字']}</b><br/>  (ID: {$tk['客服id']}){/if}
                </h5>
                <p>时间：{$tk['时间']}</p>
            </div>
            <div class="table-container clearfix">
            <div class="dataTables_length" style="margin: 10px 0px;">
                <p style="padding-left:30px">{$tk['信息']}</p>
            </div>
        </div>
        </div>
        
    </div>
    {/foreach}
</div>



<div class="container-fluid">
    <form action="" method="post" id="commentform" class="comment-form">
    <p class="comment-form-comment"><label for="comment">{$lang['工单回复']}</label>  <textarea id="comment" class="form-control" name="reply" cols="45" rows="8"></textarea></p>
    <br>
    <p class="form-submit"><input name="submit" type="submit" id="submit" class="c-btn c-btn--small c-btn--info" value="{$lang['回复']}"></p>
    </form>
</div>
<br/>





<style>
#nr{
    font-size:18px;
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

